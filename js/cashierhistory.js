let info = 'all';
let department = 'all';
let date = '';
$(document).ready(function(){
    $("#nav").load("cashiernav.php");
    getDataTable('all', 'all', '');
    $(".date-search").prop("style", "display: none !important");
    $("#search_name").on('keyup', function(){
        info = $(this).val();
        getDataTable(info, department, '');
    })

    $(".txt, #category, .checkbox").each(function() {
        $(this).change(function(){
            department = $(this).val();
            getDataTable('all', department, '');
            if(department!='all'){
                $(".date-search").prop("style", "");
            }else{
                $(".date-search").prop("style", "display: none !important");
            }
            
        }); 
    });

    $(".txt, #date_name, .checkbox").each(function() {
        $(this).change(function(){
            date = $(this).val();
            getDataTable(info, department, date);
            
        }); 
    });

});

function getDataTable(info, department, date){
    $.ajax({
        url: '../../controller/Dbcashiergethistorydata.php',
        type: 'POST',
        data: {info:info, department:department, date:date},
        cache: false,
        success: function(res){
            var data = JSON.parse(res);
            data.sort(function(a, b){
                let d1 = new Date(a.date), d2 = new Date(b.date);
                return d2 - d1;
            });
            html = '';
            for(let i = 0; i<data.length; i++){
                var date = new Date((data[i]).date);
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
                if((data[i].type)=='digitalPayment'){
                    html += `
                        <div class='d-flex flex-row w-100 justify-content-between history-data' onclick="getdatamodal('${data[i].type}','${data[i].fullname}','${insert_date}','${data[i].payment_amount}', '${data[i].payment_ref}')">
                            <div class='d-flex flex-column'>
                                <b>${data[i].fullname}</b>
                                <div>Payment</div>
                                <div>${insert_date}</div>
                            </div>
                            <div class='align-self-center'>
                                <div>₱ ${data[i].payment_amount}.00</div>
                            </div>
                        </div>`;
                }else if((data[i].type)=="cashin"){
                    html += `
                        <div class='d-flex flex-row w-100 justify-content-between history-data' onclick="getdatamodal('${data[i].type}','${data[i].fullname}', '${insert_date}', '${data[i].cashin_amount}', '${data[i].ref_num}')">
                            <div class='d-flex flex-column'>
                                <b>${data[i].fullname}</b>
                                <div>Cash In</div>
                                <div>${insert_date}</div>
                            </div>
                            <div class='align-self-center'>
                                <div>₱ ${data[i].cashin_amount}.00</div>
                            </div>
                        </div>`;
                }else if((data[i].type)=="cashout"){
                    html += `
                        <div class='d-flex flex-row w-100 justify-content-between history-data' onclick="getdatamodal('${data[i].type}','${data[i].store_name}', '${insert_date}', '${data[i].cashout_amount}', '${data[i].cashout_refnum}')">
                            <div class='d-flex flex-column'>
                                <b>${data[i].store_name}</b>
                                <div>Cash Out</div>
                                <div>${insert_date}</div>
                            </div>
                            <div class='align-self-center'>
                                <div>₱ ${data[i].cashout_amount}.00</div>
                            </div>
                        </div>`;
                }
            }
            $(".data-info").html(html);
        }
    });
}

function getdatamodal(type ,fullname, date, amount, ref){
    
    if(type == 'digitalPayment'){
        var payment_type = `Payment for <b>${fullname}</b>`;
    }else if(type == 'cashin'){
        var payment_type = `Cash In for <b>${fullname}</b>`;
    }else if(type == 'cashout'){
        var payment_type = `Cash Out for <b>${fullname}</b>`;
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
    $("#btn_showModal").click();
}