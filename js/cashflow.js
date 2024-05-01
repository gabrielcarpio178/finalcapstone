let i = true;
let x = true;
$(document).ready(function(){
    $("#nav").load("adminnav.php");

    $("#category_content").on('click', function(){
        if(i==true){
            $(".dropdown-list").prop('style', "display: block !important");
            i=false;
        }else{
            $(".dropdown-list").prop('style', "display: none !important");
            i=true;
        }
    });

    $("#date_input").on('click', function(){
        if(x==true){
            $(".date-list").prop('style', "display: block !important");
            x=false;
        }else{
            $(".date-list").prop('style', "display: none !important");
            x=true;
        }
    });

    $("#btn_sumbit").on('click', function(){
        $("#btn_sumbit_request").click();
    });

    submitrequestform();
    cashflowcati();
    current_date();
    data_table();
    getdatagraph();
    getdate_request();
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
            var array_month = [];
            for(let i = 0; i<result_data_db.length; i++){
                array_month.push((result_data_db[i]).month);
            }

            var label_month = [...new Set(array_month)];
            var cashin = [];
            var cashout = [];
            for(let y = 0; y<label_month.length;y++){
                var data_cashin = result_data_db.filter(x => x.month === label_month[y]).map(x => x.amount_cashin);
                if(data_cashin.length!=0){
                    cashin.push(data_cashin);
                }else{
                    cashin.push(0);
                }
                var data_cashout = result_data_db.filter(x => x.month === label_month[y]).map(x => x.amount_cashout);
                if(data_cashout.length!=0){
                    cashout.push(data_cashout);
                }
                else{
                    cashout.push(0);
                }
            }
            var cashin_info = [];
            for(var i = 0; i < cashin.length; i++){
                cashin_info.push((cashin[i])[1]);
            }
            var cashout_info = [];
            for(var i = 0; i < cashout.length; i++){
                cashout_info.push((cashout[i])[0]);
            }
            graph(label_month, cashin_info, cashout_info);
        }
    })
}

function graph(label, cashin, cashout){

    const ctx = $('#myChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: label,
            datasets: [{
                label: 'Cash in',
                data: cashin,
                borderWidth: 1
            },{
                label: 'Cash out',
                data: cashout,
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

function getcategory(content) {
    $("#selected_category").text(content);
    $(".dropdown-list").prop('style', "display: none !important");
    $("#category_type").val(content);
    i = true;
}

function getdate_request(){
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $("#start").prop('max', today);
    $("#end").prop('max', today);
    $(".txt, #start, .checkbox").each(function() {
        $(this).change(function(){
            var start = $(this).val();
            $("#end").prop('min', start);
        }); 
    });
}

function submitrequestform(){
    $("#request_form").on('submit', function(e){
        e.preventDefault();
        var category_type = $("#category_type").val();
        var start_date = $("#start").val();
        var end_date = $("#end").val();
        if(category_type.length==0||start_date.length==0||end_date.length==0){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Select Input Data',
                showConfirmButton: false,
                timer: 1000
            })
        }else{
            $("#btn_sign").html(`<button id="account_sign_in" data-toggle="modal" data-target="#sign_in">account_sign_in</button>`);
            $("#account_sign_in").click();
            $("#close_filter").click();
            $("#sign_form_admin").on('submit', function(e){
                e.preventDefault();
                var user_name = $("#user_name").val();
                var password = $("#password").val();
                if(user_name.length==0||password.length==0){
                    Swal.fire({
                        position: 'center',
                        icon: 'warning',
                        title: 'Select Input Data',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }else{
                    $.ajax({
                        url: '../../controller/Dbcashflow_login.php',
                        type: 'POST',
                        data: {
                            user_name : user_name,
                            password : password,
                            category : category_type,
                            start : start_date,
                            end : end_date
                        },
                        cache: false,
                        beforeSend: function () {
                            $(".loader").show();
                        },
                        success: function(res){
                            if(res=='wrong_password'){
                                $(".loader").hide();
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: 'Invalid Credentail',
                                    showConfirmButton: false,
                                    timer: 1000
                                });
                            }else{
                                $(".loader").hide();
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Success',
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(()=>{
                                    printReport();
                                });
                            }
                        }
                    })
                }
            })
        }
    })
}

function printReport(){
    window.location = '../../cashflow_request.php';
}