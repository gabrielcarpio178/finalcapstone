$(document).ready(function(){

    $("#nav").load("storenav.php");
    getdata();
    graph('daily');
    $("#daily").addClass('underline');
});

let chart;
function getdata(){
  var date = new Date();
  var mounth = date.getMonth();
  var day = date.getDate();
  if(day<10){
    day="0"+day;
  }
  var year = date.getFullYear();
  var monthFull = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];
  $("#year").text("Jan 01 - Dec 31 -"+year)
  $("#date").text(monthFull[mounth]+" "+day+" - "+year);
  $("#month").text(monthFull[mounth]);
  
  var teller_id = $("#teller_id").val();
  $.ajax({
    url: "../../controller/Dbtellergetdataa_amount.php",
    type: "POST",
    data: {teller_id : teller_id},
    cache: false,
    success: function(res){
      var data = JSON.parse(res);
      // console.log(data);
      $(".revenue-number").text("₱"+data.yearly+".00");
      $(".daily-number").text("₱"+data.daily+".00");
      $(".current-month-number").text("₱"+data.weekly+".00");
      $(".num-unpaid").text(data.unpaid);
      $(".num-pending").text(data.pending);
      $(".num-proceed").text(data.proceed);
    }
  });

}
function graph(filter){
    Chart.register(ChartjsPluginStacked100.default);
    var teller_id = $("#teller_id").val();
    $.ajax({
      url: "../../controller/Dbtellergetdatagraph.php",
      type: "POST",
      data: {
        teller_id : teller_id,
        filter : filter,
      },
      cache: false,
      success: function(res){
        var expense_goods = JSON.parse(res);
        // console.log(res);
        // console.log(expense_goods);
        graphtry(expense_goods[0], expense_goods[1]);
        click();
      }
    });
    
}

 function graphtry(labels, datas){
  var dat = [];
  var least = [];
  for(let i = 0; i < labels.length; i++){
    for(let x = 0; x < Object.keys(datas).length; x++){
      if(labels[i]==Object.keys(datas)[x]){
        dat.push(parseInt(Object.values(datas)[x].toString()));
        least.push(100-parseInt(Object.values(datas)[x]));
        break;
      }
    }
  }   

  console.log(dat);

  const label = labels;
  const data = {
    labels: label,
    datasets: [{
      label: 'Most Buy',
      backgroundColor: 'rgb(255, 99, 132)',
      borderColor: 'rgb(255, 99, 132)',
      data: dat,
    },{
      label: 'Least Buy',
      data: least,
    }]
  };


  console.log(dat);


  const config = {
    type: 'bar',
    data: data,
    options: {
      plugins:{
        stacked100: {
          enable: true,
        }
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };

  var ctx = $("#graph");
  chart = new Chart(ctx, config);
  

}
function click(){
  let z = 0;
  $("#daily").on('click', function(){
      chart.destroy();
      var daily = $(this).attr('id');
      graph(daily);
      $(this).addClass('underline');
      $('.'+z).removeClass('underline');
      z = 1;
  });

  $("#weekly").on('click', function(){
      chart.destroy();
      var weekly = $(this).attr('id');
      graph(weekly);
      $(this).addClass('underline');
      $('.'+z).removeClass('underline');
      $('.1').removeClass('underline');
      z = 2;
  });

  $("#monthly").on('click', function(){
      chart.destroy();
      var monthly = $(this).attr('id');
      graph(monthly);
      $(this).addClass('underline');
      $('.'+z).removeClass('underline');
      $('.1').removeClass('underline');
      z = 3;
  });

  $("#yearly").on('click', function(){
      chart.destroy();
      var yearly = $(this).attr('id');
      graph(yearly);
      $(this).addClass('underline');
      $('.'+z).removeClass('underline');
      $('.1').removeClass('underline');
      z = 4;
  });

}