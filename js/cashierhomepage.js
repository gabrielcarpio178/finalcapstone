// import Chart from 'chart.js/auto';
// import { getRelativePosition } from 'chart.js/helpers';
// import {Chart} from 'chart.js';
// import ChartDataLabels from 'chartjs-plugin-datalabels';
$(document).ready(function () {
  $("#nav").load("cashiernav.php");

  $("#collection-div").on('click',function(){
    window.location = "cashiercollection.php";
  });

  $("#cashin").on('click',function(){
    window.location = "cashiercashin.php";
  });
  
  getdataGraph()
  request();
  getTotalCollection();
  requestNotification();
  announcement('Cashier');
  getdate();
});

function getdate(){
  var date = new Date();
  var mounth = date.getMonth();
  var day = date.getDate();
  if(day<10){
      day="0"+day;
  }
  var year = date.getFullYear();
  var monthFull = [
  "Jan.",
  "Feb.",
  "Mar.",
  "Apr.",
  "May.",
  "Jun.",
  "July",
  "Aug.",
  "Sept.",
  "Oct.",
  "Nov.",
  "Dec.",
];
  $(".collection-date").text(monthFull[mounth]+" "+day+" - "+year)
}
function announcement(usertype){

  $.ajax({
    url: '../../controller/Dbannoucement_show.php',
    type: 'POST',
    data: {usertype: usertype},
    cache: false,
    success: function(res){
      $(".welcome").text(res);
    }

  });

}


function getdataGraph(){
  $.ajax({
    url: '../../controller/DbcashierGraph.php',
    type: 'POST',
    data: {cashier : 'cashier'},
    cache: false,
    success: function(res){
      graph(JSON.parse(res));
    }
  });
}
function graph(data_result){
  const data = {
    labels: ['Non Bago Fee', 'Certificate', 'Cash In'],
    datasets: [{
      data: [data_result.total_non_bago, data_result.total_cert, data_result.total_cashin],
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
          text: 'BCC Digital Payment Cashier Yearly Collection',
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

}

function request(){
  $("#request").on("click", function(){
    window.location='cashierrequest.php';
  })
}

function getTotalCollection(){
  $.ajax({
    url: '../../controller/DbgetCashierTotalCollection.php',
    type: 'POST',
    data: {cashier : 'cashier'},
    cache: false,
    success: function(res){
      var amount = `${res}.00`;
      var parts = amount.toString().split(".");
      var num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
      $("#amount_collection").text(`₱${num}`);
    }
  });
}

function requestNotification(){
  $.ajax({
    url: '../../controller/DbcashierNotification.php',
    type: 'POST',
    data: {cashier : 'cashier'},
    cache: false,
    success: function(res){
      $(".request-count").text(res);
    }
  });
}