$(document).ready(function(){
    $("#nav").load("cashiernav.php");
    graph();
    getdate();
    displaydata();
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
    $(".collection-date").text(monthFull[mounth]+" "+day+" - "+year);
    $(".today").text(monthFull[mounth]+" "+day+" - "+year);
}

function displaydata(){
    $.ajax({
        url: '../../controller/Dbcashiercollection.php',
        type: 'POST',
        data:{cashier: 'cashier'},
        cache: false,
        success: function(res){
            var datas = JSON.parse(res);
            //cashin
            var cashin_amount = `${datas.cashin}.00`;
            var cashin_parts = cashin_amount.toString().split(".");
            var cashin = cashin_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (cashin_parts[1] ? "." + cashin_parts[1] : "");
            $("#cashin").text(`₱ ${cashin}`);
            //school fee
            var payment_amount = `${datas.payment_sum}.00`;
            var payment_parts = payment_amount.toString().split(".");
            var payment = payment_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (payment_parts[1] ? "." + payment_parts[1] : "");
            $("#school_fee").text(`₱ ${payment}`);
        }
    });
}

function graph(){
    const data = {
    labels: ['Non Bago Fee', 'Certificate', 'Cash In'],
    datasets: [{
        data: [2, 3, 4],
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
            text: 'BCC Digital Payment Cashier Daily Collection',
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

    var bars = $("#graph_data");
    chart = new Chart(bars, bar);

}