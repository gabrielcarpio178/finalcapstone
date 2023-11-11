$(document).ready(function(){
    $("#navbar").load("usernav.php");
    getHistoryByDate("all","0000-00-00");
    $(".txt, #payment, .checkbox").each(function() {
        $(this).change(function(){
            payment = $(this).val();
            $(".selected-filter").html(`<div class="d-flex flex-row align-items-center gap-1"><i class="fa-solid fa-x" onclick="cancelFilter();"></i><div>Request Payment, ${payment}</div></div>`);
            $(".selected-filter").show();
            $("#date_filter").show();
            $(".btn-close").click();
        }); 
    });

    $("input[name='flexRadioDefault']").change(function() {
        if ($(this).val() === 'Request Payment') {
            $('#payment').prop('disabled',false);
        } else {
            $('#payment').prop('disabled',true);
            $(".selected-filter").html(`<div class="d-flex flex-row align-items-center gap-1"><i class="fa-solid fa-x" onclick="cancelFilter();"></i><div>${$(this).val()}</div></div>`);
            $(".selected-filter").show();
            $("#date_filter").show();
            $(".btn-close").click();
        }
    });

    getRequestPayment();

});

function cancelFilter(){
    $(".selected-filter").hide();
    $("#date_filter").hide();
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

function getHistoryByDate(type,date){
    $.ajax({
        url: '../../controller/Dbuserhistorydata.php',
        type: 'POST',
        data: {date : date, type: type},
        cache: false,
        success: function(res){
            var data = JSON.parse(res);
            data.sort(function(a, b){
                let d1 = new Date(a.date_info), d2 = new Date(b.date_info);
                return d2 - d1;
            });
            html = '';
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
                    html += `<div class="d-flex flex-row justify-content-between align-items-center w-100 p-3 history-info">
                            <div class="d-flex flex-column gap-2">
                                <b>${(data[i]).store_name}</b>
                                <div class="date">${insert_date}</div>
                            </div>
                            <div class="amount">₱ ${(data[i]).order_amount}.00</div>
                        </div>`
                }else if((data[i]).trans_type=='cashin'){
                    html += `<div class="d-flex flex-row justify-content-between align-items-center w-100 p-3 history-info">
                            <div class="d-flex flex-column gap-2">
                                <b>Cash In</b>
                                <div class="date">${insert_date}</div>
                            </div>
                            <div class="amount">₱ ${(data[i]).cashin_amount}.00</div>
                        </div>`
                }else if((data[i]).trans_type=='sent'){
                    html += `<div class="d-flex flex-row justify-content-between align-items-center w-100 p-3 history-info">
                            <div class="d-flex flex-column gap-2">
                                <b>Sent Funds</b>
                                <div class="date">${insert_date}</div>
                            </div>
                            <div class="amount">₱ ${(data[i]).send_amount}.00</div>
                        </div>`
                }else if((data[i]).trans_type=='receiver'){
                    html += `<div class="d-flex flex-row justify-content-between align-items-center w-100 p-3 history-info">
                            <div class="d-flex flex-column gap-2">
                                <b>Receive Funds</b>
                                <div class="date">${insert_date}</div>
                            </div>
                            <div class="amount">₱ ${(data[i]).send_amount}.00</div>
                        </div>`
                }else if((data[i]).trans_type=='payment'){
                    html += `<div class="d-flex flex-row justify-content-between align-items-center w-100 p-3 history-info">
                            <div class="d-flex flex-column gap-2">
                                <b>${(data[i]).payment_type}</b>
                                <div class="date">${insert_date}</div>
                            </div>
                            <div class="amount">₱ ${(data[i]).payment_amount}.00</div>
                        </div>`
                }
                
            }
            $("#history_info").html(html);
        }
    })
}