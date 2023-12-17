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
        var label = [];
        var total_amount = [];
        for(let x = 0; x<expense_goods.length;x++){
          label.push((expense_goods[x]).label);
          total_amount.push((expense_goods[x]).total_amount);
        }
        graphtry(label, total_amount);
        click();
      }
    });
    
}

function graphtry(labels, datas){
  

  var today = new Date();
  var mm = today.getMonth();
  var yyyy = today.getFullYear();

  var mL = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

  today = mL[mm] + '-' + yyyy; 


  const data = {
    labels: labels,
    datasets: [{
      data: datas,
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)'
      ],
      borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)'
    ],
      borderWidth: 1
    }]
  };

  const bar = {
    type: 'bar',
    data: data,
    options: {
      plugins:{
        legend: {
          display: false,
        },
        stacked100: {
          enable: true,
        },
        title: {
          display: true,
          text: today,
        },

      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    },
    plugins: [ChartDataLabels]
  };

  var ctx = $("#graph");
  chart = new Chart(ctx, bar);
  

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

  // $("#weekly").on('click', function(){
  //     chart.destroy();
  //     var weekly = $(this).attr('id');
  //     graph(weekly);
  //     $(this).addClass('underline');
  //     $('.'+z).removeClass('underline');
  //     $('.1').removeClass('underline');
  //     z = 2;
  // });

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