$(document).ready(function () {
  $("#nav").load("adminnav.php");
  getdatauser();
  getdatagraph();
});

function getdatauser(){

  var date = new Date();
  var month = date.getMonth();
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
  $(".date").text(monthFull[month]+" "+year);
  $(".year #year").text(year);
  

  $.ajax({
    url: '../../controller/Dbadmindashboard.php',
    type: 'POST',
    data: {admin: 'admin'},
    cache: false,
    success: function(res){
      var data = JSON.parse(res);
      $("#new_user").text(data.all_week);
      $("#active_user").text(data.all_active);
      $("#total_user").text(data.all_user);
    }
    
  });

}

function getdatagraph(){

  $.ajax({
    url: '../../controller/Dbadmindashboardgraph.php',
    type: 'POST',
    data: {admin: 'admin'},
    cache: false,
    success: function(res){
      var data = JSON.parse(res);
      graph(data[0], data[1], data[2], data[3]);
      // console.log(data);
      
    }
    
  });

}

function graph(month,datas, course, department){


  function removeDuplicates(arr) {
      return arr.filter((item,
          index) => arr.indexOf(item) === index);
  }
  
  var mon = removeDuplicates(month);
  var colors_course = [];
  for(let i = 0; i < course['course'].length; i++){
    if(course['course'][i]=="BSCrim"){
      colors_course.push('#c2552e');
    }else if(course['course'][i]=="BSED"){
      colors_course.push('#1f7387');
    }else if(course['course'][i]=="BSIS"){
      colors_course.push('#49785f');
    }else if(course['course'][i]=="BSOA"){
      colors_course.push('#f5f4c3');
    }else if(course['course'][i]=="BEED"){
      colors_course.push('#acb6b3');
    }
  }

  var colors_department = [];
  for(let i = 0; i < department['department'].length; i++){
    if(department['department'][i]=="SASO"){
      colors_department.push('#f0daae');
    }else if(department['department'][i]=="Faculty"){
      colors_department.push('#90553c');
    }else if(department['department'][i]=="Guidance"){
      colors_department.push('#b4daa7');
    }else if(department['department'][i]=="Registrar"){
      colors_department.push('#a4c3a2');
    }else if(department['department'][i]=="Admin"){
      colors_department.push('#d68c45');
    }else if(department['department'][i]=="SSG"){
      colors_department.push('#755565');
    }
  }
  
  const data = {
    labels: mon,
    datasets: [{
      label: 'Cashier',
      backgroundColor: '#00AAFF',
      borderColor: 'rgb(255, 99, 132)',
      data: datas['cashier'],
    },{
      label: 'Canteen Staff',
      backgroundColor: '#FF8300',
      borderColor: 'rgb(255, 99, 132)',
      data: datas['teller'],
    },{
      label: 'Students / Personnels',
      backgroundColor: '#9e9e9e',
      borderColor: 'rgb(255, 99, 132)',
      data: datas['user_buyer'],
    }]
  };



  const bar = {
    type: 'bar',
    data: data,
    options: {
      plugins:{
        stacked100: {
          enable: true,
        },
        title: {
          display: true,
          text: 'BCC Digital Payment System User Login Statistics',
        },
        legend: {
          position: 'bottom',
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

  var bars = $("#bar");
  chart = new Chart(bars, bar);

  const donutdata = {
    labels: [...course['course'], ...department['department']],
    datasets: [{
      label: 'Users',
      backgroundColor: [...colors_course, ...colors_department],
      borderColor: '#a3966a',
      data: [...course['num_course'], ...department['num_department']],
    }]
  };

  const donut = {
    type: 'doughnut',
    data: donutdata,
    options: {
      aspectRatio: 1,
      layout: {
          padding: {
              left: 0,
              right: 0,
              top: 0,
              bottom: 0,
          }
        },
        plugins:{
          stacked100: {
            enable: true,
          },
          title: {
            display: true,
            text: 'Total Department Users ',
            font: {
                size: 20
            }
          },
          legend: {
            position: 'bottom',
          },
          datalabels:{
            color: 'black',
            font: {
              weight: 'bold',
              size: 16,
            },
            formatter: (value) => {
              let sum = 0;
              let dataArr = [...course['num_course'], ...department['num_department']];
              dataArr.map(data => {
                  sum = parseInt(sum) + parseInt(data);
              });
              // console.log(sum);
              let percentage = (value*100 / sum).toFixed(0)+"%";
              return percentage;
            },
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

  var doughnut = $("#doughnut");
  chart = new Chart(doughnut, donut);
  

}
