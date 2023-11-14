let type = "all";
let date = "0000-00-00";
$(document).ready(function(){
    $("#navbar").load("usernav.php");
    $("#date_div, #trans_div").prop("style", "display: none !important");

    $("input[name='flexRadioDefault']").change(function() {
            var date_current = new Date();
            var mounth_current = date_current.getMonth() + 1;
            var day_current = date_current.getDate();
            var year_current = date_current.getFullYear();
            var hour_current = date_current.getHours();
            var min_current = date_current.getMinutes();
            if (day_current < 10) {
                day_current = '0' + dd;
            }
            
            if (mounth_current < 10) {
                mounth_current = '0' + mounth_current;
            } 
            var date_max = `${year_current}-${mounth_current}-${day_current}`;
            $("#date_filter").prop("max", date_max);
        if ($(this).val() === 'Request Payment') {
            $('#payment').prop('disabled',false);
        } else {
            type = $(this).val();
            $('#payment').prop('disabled',true);
            $(".selected-filter").html(`<div class="d-flex flex-row align-items-center gap-1"><i class="fa-solid fa-x" onclick="cancelFilter();"></i><div>${$(this).val()}</div></div>`);
            $(".selected-filter").show();
            $("#date_filter").show();
            $(".btn-close").click();
            if($(this).val()!=="Transfers Funds"){
                $("#date_div").prop("style", "");
                $("#trans_div").prop("style", "display: none !important");
            }else{
                $("#date_div, #trans_div").prop("style", "");
            }
            $("#date_filter").val("");
            getHistoryByDate(type,"0000-00-00","all");
            
        }
    });

    $(".txt, #date_filter, .checkbox").each(function() {
        $(this).change(function(){
            date = $(this).val();
            getHistoryByDate(type, date, 'all');
            if(date==''){
                getHistoryByDate(type, "0000-00-00", 'all');
            }
        }); 
    });

    $(".txt, #category_transfers, .checkbox").each(function() {
        $(this).change(function(){
            trans = $(this).val();
            getHistoryByDate(type, date, trans);

        }); 
    });

    $(".txt, #payment, .checkbox").each(function() {
        $(this).change(function(){
            type = $(this).val();
            $(".selected-filter").html(`<div class="d-flex flex-row align-items-center gap-1"><i class="fa-solid fa-x" onclick="cancelFilter();"></i><div>Request Payment, ${type}</div></div>`);
            $(".selected-filter").show();
            $("#date_filter").show();
            $(".btn-close").click();
            $("#date_div").prop("style", "");
            getHistoryByDate(type, date, 'all');
        }); 
    });

    getRequestPayment();
    getHistoryByDate(type,date,"all");
});

function cancelFilter(){
    $(".selected-filter").hide();
    $("#trans_div, #date_div").prop("style", "display: none !important");
    getHistoryByDate('all','0000-00-00',"all");
}

function getRequestPayment(){
    $.ajax({
        url: '../../controller/DbuserGetRequestPayment.php',
        type: 'POST',
        data: {user : 'user'},
        cache: false,
        success: function(res){
            var payment_type = JSON.parse(res);
            option = '';
            for(let i = 0; i<payment_type.length; i++){
                option += `<option value='${payment_type[i]}'>${payment_type[i]}</option>`;
            }
            $("#payment").html(option);
        }
    });
}

function getHistoryByDate(type,date, trans){
    $.ajax({
        url: '../../controller/Dbuserhistorydata.php',
        type: 'POST',
        data: {date : date, type: type, trans: trans},
        cache: false,
        success: function(res){
            var data = JSON.parse(res);
            data.sort(function(a, b){
                let d1 = new Date(a.date_info), d2 = new Date(b.date_info);
                return d2 - d1;
            });
            html = '';
            if(data.length!=0){
                for(let i = 0; i<data.length; i++){
                    var date = new Date((data[i]).date_info);
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
                    if((data[i]).trans_type=='purchase'){
                        html += `<div class="d-flex flex-row justify-content-between align-items-center w-100 p-3 history-info" onclick="getmodaldata('${(data[i]).trans_type}', '${(data[i]).store_name}', '${insert_date}', '${(data[i]).order_amount}', '${(data[i]).order_num}')">
                                <div class="d-flex flex-column gap-2">
                                    <b>${(data[i]).store_name}</b>
                                    <div class="date">${insert_date}</div>
                                </div>
                                <div class="amount">₱ ${(data[i]).order_amount}.00</div>
                            </div>`
                    }else if((data[i]).trans_type=='cashin'){
                        html += `<div class="d-flex flex-row justify-content-between align-items-center w-100 p-3 history-info" onclick="getmodaldata('${(data[i]).trans_type}', 'Cash In', '${insert_date}', '${(data[i]).cashin_amount}', '${(data[i]).ref_num}')">
                                <div class="d-flex flex-column gap-2">
                                    <b>Cash In</b>
                                    <div class="date">${insert_date}</div>
                                </div>
                                <div class="amount">₱ ${(data[i]).cashin_amount}.00</div>
                            </div>`
                    }else if((data[i]).trans_type=='sent'){
                        html += `<div class="d-flex flex-row justify-content-between align-items-center w-100 p-3 history-info" onclick="getmodaldata('${(data[i]).trans_type}', '${(data[i]).fullname}', '${insert_date}', '${(data[i]).send_amount}', '${(data[i]).sendBalance_ref}')">
                                <div class="d-flex flex-column gap-2">
                                    <b>Sent Funds</b>
                                    <div class="date">${insert_date}</div>
                                </div>
                                <div class="amount">₱ ${(data[i]).send_amount}.00</div>
                            </div>`
                    }else if((data[i]).trans_type=='receiver'){
                        html += `<div class="d-flex flex-row justify-content-between align-items-center w-100 p-3 history-info" onclick="getmodaldata('${(data[i]).trans_type}', '${(data[i]).fullname}', '${insert_date}', '${(data[i]).send_amount}', '${(data[i]).sendBalance_ref}', '${(data[i]).fullname}')">
                                <div class="d-flex flex-column gap-2">
                                    <b>Receive Funds</b>
                                    <div class="date">${insert_date}</div>
                                </div>
                                <div class="amount">₱ ${(data[i]).send_amount}.00</div>
                            </div>`
                    }else if((data[i]).trans_type=='payment'){
                        html += `<div class="d-flex flex-row justify-content-between align-items-center w-100 p-3 history-info" onclick="getmodaldata('${(data[i]).trans_type}', '${(data[i]).payment_type}', '${insert_date}', '${(data[i]).payment_amount}', '${(data[i]).payment_ref}')">
                                <div class="d-flex flex-column gap-2">
                                    <b>${(data[i]).payment_type}</b>
                                    <div class="date">${insert_date}</div>
                                </div>
                                <div class="amount">₱ ${(data[i]).payment_amount}.00</div>
                            </div>`
                    }
                }
                $("#history_info").html(html);
            }else{
                $("#history_info").text("No result");
            }
        }
    })
}

function getmodaldata(type, name, date, amount, ref){
    if(type == 'purchase'){
        var payment_type = `Store name: <b>${name}</b>`;
    }else if(type == 'cashin'){
        var payment_type = `<b>${name}</b>`;
    }else if(type == 'sent'){
        var payment_type = `Sent to <b>${name}</b>`;
    }else if(type == 'receiver'){
        var payment_type = `Receive to <b>${name}</b>`;
    }else if(type == 'payment'){
        var payment_type = `<b>${name}</b>`;
    }
    var payment_html = `
        <div class="d-flex flex-row gap-1 payment_data">
            <p>${payment_type} </p>
        </div>
    `;
    var data_time_html = `
        <div class="d-flex flex-row justify-content-between date_time w-100">
            <p>Date & Time: </p>
            <b>${date}</b>
        </div>
    `;
    var amount_info = `${amount}.00`;
    var parts = amount_info.toString().split(".");
    var num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
    var amount_html = `
    <div class="d-flex flex-row justify-content-between amount_html w-100">
        <p>Amount: </p>
        <b>₱ ${num}</b>
    </div>
    `;
    var ref_html = `
    <div class="d-flex flex-row justify-content-between amount_html w-100">
        <p>Reference No.: </p>
        <b>${ref}</b>
    </div>
    `;

    $("#payment_for").html(payment_html);
    $("#date_and_time").html(data_time_html);
    $("#amount").html(amount_html);
    $("#ref_num").html(ref_html);
    $(".btn-modal").click();
}