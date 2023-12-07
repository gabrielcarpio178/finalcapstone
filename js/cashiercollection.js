let categories = 'Non Bago Fee';
$(document).ready(function(){
    $("#nav").load("cashiernav.php");
    $("#sortBy").hide();
    getdate();
    displaydata();
    displaySortBy();
    let i;
    displayTable('all', 'Non Bago Fee', 0);
    $(".btn-category #non_bago").on("click", function () {
        $("#sortBy").hide();
        $(this).addClass("fucos-class");
        $(".focus-" + i).removeClass("fucos-class");
        i = 1;
        categories = 'Non Bago Fee';
        displayTable('all', 'Non Bago Fee', 0);
        displaySortBy();
    });

    $("#tor").on("click", function () {
        $("#sortBy").hide();
        $(this).addClass("fucos-class"); 
        $(".focus-1").removeClass("fucos-class");
        $(".focus-" + i).removeClass("fucos-class");
        i = 2;
        categories = 'cash_out';
        displayTable('all', 'tor', 0);
        displaySortBy();
    });

    $("#cash_out").on("click", function () {
        $("#sortBy").hide();
        $(this).addClass("fucos-class"); 
        $(".focus-1").removeClass("fucos-class");
        $(".focus-" + i).removeClass("fucos-class");
        i = 3;
        categories = 'cash_out';
        displayTable('all', 'cash_out', 0);
        displaySortBy();
    });

    $("#cash_in").on("click", function () {
        $("#sortBy").hide();
        $(this).addClass("fucos-class"); 
        $(".focus-1").removeClass("fucos-class");
        $(".focus-" + i).removeClass("fucos-class");
        i = 4;
        categories = 'cash_in';
        displayTable('all', 'cash_in', 0);
        displaySortBy();
    });

    $("#certificate").on("click", function () {
        $("#sortBy").show();
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
        i = 5;
        categories = 'Certificate';
        displayTable('all', 'Certificate', 0);
        displaySortBy();
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
            var cashin_amount = `${parseInt(datas.cashin)}.00`;
            var cashin_parts = cashin_amount.toString().split(".");
            var cashin = cashin_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (cashin_parts[1] ? "." + cashin_parts[1] : "");
            $("#cashin").text(`₱ ${cashin}`);
            //school fee daily
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
            //total_collection daily
            var total_amount = `${((parseInt(datas.cashin)+parseInt(datas.payment_sum))-parseInt(datas.cashout))}.00`;
            var total_parts = total_amount.toString().split(".");
            var total = total_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (total_parts[1] ? "." + total_parts[1] : "");
            $(".total-collection-amount").text(`₱ ${total}`);
            var total_cert = parseInt(datas.cert_t)+parseInt(datas.cert);
            //cash in collection
            var cashIn_collection_amount = `${parseInt(datas.collection_cashin)-parseInt(datas.cashout)}.00`;
            var cashIn_collection_parts = cashIn_collection_amount.toString().split(".");
            var cashIn_collection = cashIn_collection_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (cashIn_collection_parts[1] ? "." + total_parts[1] : "");
            $(".cashIn-collection-amount").text(`₱ ${cashIn_collection}`);
            
        }
    });
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

function displaySortBy(){
    $.ajax({
        url: '../../controller/DbcashiercollectionSortBy.php',
        type: 'POST',
        data: {
            sortBy : 'sortBy',
        },
        cache: false,
        success: function(res){
            var sortData = JSON.parse(res);
            sortHtml = `
            <option disabled selected>Sort By</option>
            <option value="all">All</option>
            `;
            for(let i=0;i<sortData.length;i++){
                sortHtml += `
                <option value="${(sortData[i]).cashierRatesCertificate}">
                    ${(sortData[i]).cashierRatesCertificate}
                </option>`;
            }
            $("#sortBy").html(sortHtml);
        }
    });
}