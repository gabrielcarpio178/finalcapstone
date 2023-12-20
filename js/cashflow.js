$(document).ready(function(){
    $("#nav").load("adminnav.php");
    cashflowcati();
    current_date();
    data_table();
    getdatagraph();
});

function current_date(){
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
        "May",
        "June.",
        "July",
        "Aug.",
        "Sept.",
        "Oct.",
        "Nov.",
        "Dec.",
    ];
    $(".current_date").text(monthFull[mounth]+" "+day+" - "+year);
}

function cashflowcati(){
    $.ajax({
        url: '../../controller/Dbadmincashflowdatecati_info.php',
        type: 'POST',
        data: {user:'admin'},
        cache: false,
        success: function(res){
            var data_result = JSON.parse(res);
            //daily_cashi
            var daily_cashin = `${data_result.total_cashin}.00`;
            var cashin_parts = daily_cashin.toString().split(".");
            var daily_cashin_num = cashin_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (cashin_parts[1] ? "." + cashin_parts[1] : "");
            $("#cashin_daily").html(`₱${daily_cashin_num}`);
            //daily_cashout
            var daily_cashout = `${data_result.total_cashout}.00`;
            var daily_cashout_parts = daily_cashout.toString().split(".");
            var daily_cashout_num = daily_cashout_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (daily_cashout_parts[1] ? "." + daily_cashout_parts[1] : "");
            $("#cashout_daily").html(`₱${daily_cashout_num}`);
            //collection_cashin
            var collection_cashin = `${data_result.cashin_collection}.00`;
            var collection_cashin_parts = collection_cashin.toString().split(".");
            var collection_cashin_num = collection_cashin_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (collection_cashin_parts[1] ? "." + collection_cashin_parts[1] : "");
            $("#collection_cashin").html(`₱${collection_cashin_num}`);
        }
    });
}

function data_table(){
    $.ajax({
        url: '../../controller/Dbadmincashflowdata_table.php',
        type: 'POST',
        data: {user:'admin'},
        cache: false,
        success: function(res){
            var result_content = JSON.parse(res);
            result_content.sort(function(a, b){
            let d1 = new Date(a.date), d2 = new Date(b.date);
                return d2 - d1;
            });
            if(result_content[0].type!='no_record'){
                html_table = '';
                for(let i = 0; i<result_content.length; i++){
                    type = ((result_content[i]).type=='cashin')?"CASH IN":"CASH OUT";
                    var date = new Date((result_content[i]).date);
                    var mounth = date.getMonth();
                    var day = date.getDate();
                    var year = date.getFullYear();
                    var hour = date.getHours();
                    var min = date.getMinutes();
                    var monthFull = [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "June",
                    "July",
                    "Aug",
                    "Sept",
                    "Oct",
                    "Nov",
                    "Dec",
                    ];
                    var ampm = hour >= 12 ? 'pm' : 'am';
                    hour = hour % 12;
                    hour = hour ? hour : 12;
                    min = min < 10 ? '0'+min : min;
                    var strTime = hour + ':' + min + ampm;
                    var insert_date = `${monthFull[mounth]}-${day}-${year} ${strTime}`;
                    html_table += `
                        <div class="line mb-2"></div>
                        <div class="d-flex flex-row align-items-center justify-content-between w-100" id="content_data" style="cursor: pointer" onclick="displayinfo_modal('${(result_content[i]).name}', '${(result_content[i]).amount}', '${insert_date}', '${(result_content[i]).ref_num}', '${type}')">
                            <div class="d-flex flex-column">
                                <div class="label-info fw-bold">${type}</div>
                                <div class="date-info">${insert_date}</div>
                            </div>
                            <div class="amount-info">
                                ₱${(result_content[i]).amount}
                            </div>
                        </div>
                    `;
                }
                $("#info_content").html(html_table);
            }
        }
    })
}

function displayinfo_modal(name, amount, date_info, ref_num, type){
    $("#info_btn").click();
    $("#payment_for").text(type);
    $("#name").text(name);
    $("#datetime").text(date_info);
    $("#amount_data").text(`₱${amount}`);
    $("#ref_no").text(ref_num);
}

function getdatagraph(){
    $.ajax({
        url: '../../controller/Dbcashflowgetdata_graph.php',
        type: 'POST',
        data: {
            user:'admin'
        },
        cache: false,
        success: function(res){
            var result_data_db = JSON.parse(res);
            console.log(result_data_db);
        }
    })
    graph();
}

function graph(){

    const ctx = $('#myChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'Cash in',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            },{
                label: 'Cash out',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
            }]
        },
        plugins: [ChartDataLabels],
        options: {
            scales: {
                y: {
                beginAtZero: true
                }
            },
        }
    });
}