let categories = 'Non Bago Fee';
$(document).ready(function(){
    $("#nav").load("cashiernav.php");
    getdate();
    displaydata();
    let i;
    displayTable('all', 'Non Bago Fee', 0);
    $(".btn-category #non_bago").on("click", function () {
        $("#sortBy").attr('disabled', 'disabled');
        $(this).addClass("fucos-class");
        $(".focus-" + i).removeClass("fucos-class");
        i = 1;
        categories = 'Non Bago Fee';
        displayTable('all', 'Non Bago Fee', 0);
    });

    $("#cash_out").on("click", function () {
        $("#sortBy").attr('disabled', 'disabled');
        $(this).addClass("fucos-class"); 
        $(".focus-1").removeClass("fucos-class");
        $(".focus-" + i).removeClass("fucos-class");
        i = 2;
        categories = 'cash_out';
        displayTable('all', 'cash_out', 0);
    });

    $("#cash_in").on("click", function () {
        $("#sortBy").attr('disabled', 'disabled');
        $(this).addClass("fucos-class"); 
        $(".focus-1").removeClass("fucos-class");
        $(".focus-" + i).removeClass("fucos-class");
        i = 3;
        categories = 'cash_in';
        displayTable('all', 'cash_in', 0);
    });

    $("#certificate").on("click", function () {
        $("#sortBy").removeAttr('disabled');
        $(this).addClass("fucos-class"); 
        $(".focus-1").removeClass("fucos-class");
        $(".focus-" + i).removeClass("fucos-class");
        table_head = `
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Reference #</th>
            <th scope="col">Student ID</th>
            <th scope="col">Type of Certificate</th>
            <th scope="col">Amount</th>
        </tr>`;
        i = 4;
        categories = 'Certificate Of Enrollment';
        displayTable('all', 'Certificate Of Enrollment', 0);
    });

    $(".txt, #sortBy, .checkbox").each(function() {
        $(this).change(function(){
            sortBy = $(this).val();
            displayTable(sortBy, categories, 0);
        }); 
    });
    
    
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
            //non-bago
            var nonBago_amount = `${datas.payment_nonBago}.00`;
            var nonBago_parts = nonBago_amount.toString().split(".");
            var nonBago = nonBago_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (nonBago_parts[1] ? "." + nonBago_parts[1] : "");
            $("#non_bago").text(`₱ ${nonBago}`);
            //certificate
            var cert_amount = `${datas.cert}.00`;
            var cert_parts = cert_amount.toString().split(".");
            var cert = cert_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (cert_parts[1] ? "." + cert_parts[1] : "");
            $("#cert").text(`₱ ${cert}`);
            //certificate of enrollment
            var certT_amount = `${datas.cert_t}.00`;
            var certT_parts = certT_amount.toString().split(".");
            var certT = certT_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (certT_parts[1] ? "." + certT_parts[1] : "");
            $("#cert_t").text(`₱ ${certT}`);
            //cash out
            var cashOut_amount = `${datas.cashout}.00`;
            var cashOut_parts = cashOut_amount.toString().split(".");
            var cashOut = cashOut_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (cashOut_parts[1] ? "." + cashOut_parts[1] : "");
            $("#cashOut").text(`₱ ${cashOut}`);
            //total_collection
            var total_amount = `${datas.total_collection}.00`;
            var total_parts = total_amount.toString().split(".");
            var total = total_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (total_parts[1] ? "." + total_parts[1] : "");
            $(".total-collection-amount").text(`₱ ${total}`);
            var total_cert = parseInt(datas.cert_t)+parseInt(datas.cert);
            graph(datas.payment_nonBago, total_cert, datas.cashin);
        }
    });
}

function graph(non_bago, cert, cashin){

    const data = {
    labels: ['Non Bago Fee', 'Certificate', 'Cash In'],
    datasets: [{
        data: [non_bago, cert, cashin],
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

function page(num){
    displayTable('all', categories, num);
}

function displayTable(sortBy, category, num){
    $.ajax({
        url: '../../controller/DbcashiercollectionTable.php',
        type: 'POST',
        data: {
            sortBy : sortBy,
            category : category,
            num_page : num
        },
        cache: false,
        success: function(res){
            $(".table-content").html(res);
        }
    });
}