let balance = '';
$(document).ready(function(){
    $("#navbar").load("usernav.php");
    // console.log(($(window).width()));
    searchForm();
    getbalance();
});

function getbalance(){

    var user_id = $("#user_id").val();
    $.ajax({
        url: '../../controller/Dbgetuserbalance.php',
        type: 'POST',
        data: {user_id:user_id},
        cache: false,
        success: function(res){
            var amount = `${res}.00`;
            var parts = amount.toString().split(".");
            var num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
            $(".balance-amount").html(`₱${num}`);
            balance = res;
        }
    });

}

function searchForm(){

    forms = `   
    <form id="search_user" class="insert-forms">
        <div class="d-flex flex-column search-content">
            <div class="sent-to">
                Send to
            </div>
            <input type="text" id="search_input" placeholder="Enter Name or User ID" class="mt-2 form-control">
            <div class="result" id="result_data"></div>
            <div class="m-2 search-result">

            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Okay</button>
    </form>`; 
    $(".form-input").html(forms);

    $("#search_input").on('keyup',function(){
        var search = $(this).val();
        if(search.length!=0){
            $.ajax({
                url: '../../controller/Dbusersearchreceive.php',
                type: 'POST',
                data: {search:search},
                success: function(res){
                    var data = JSON.parse(res);
                    if(data.length!=0){
                        tbody = ``;
                        for(let i = 0; i<data.length; i++){
                            var image_gender = ((data[i]).gender=="male"||(data[i]).gender=="MALE")?'../../image/avatar.jpg':'../../image/female_avatar.png';
                            var image = ((data[i]).image_profile!=null)? `profile/${(data[i]).image_profile}`: image_gender;
                            tbody += `
                            <tr onclick="getuser('${(data[i]).user_id}', '${(data[i]).name}', '${(data[i]).department}', '${(data[i]).phonenumber}', '${(data[i]).address}', '${(data[i]).id}', '${(data[i]).usertype}', '${data[i].complete_address}', '${image}')">
                                <td class="user_profileInfo"><img src=${image}></td>
                                <td class="text-nowrap"> ${(data[i]).name}</td>
                                <td>${(data[i]).department}</td>
                                <td>${(data[i]).id}</td>
                            <tr>`;
                        }
                        table_result = `
                        <div class="table-responsive-sm">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Profile</th>
                                        <th>Name</th>
                                        <th>Dept.</th>
                                        <th>User ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${tbody}
                                </tbody>
                            </table>
                        </div>`;
                        $(".search-result").html(table_result);
                    }else{
                        $(".search-result").text("No result");
                    }
                }
            })
        }else{
            $(".search-result").html("");
            $("#result_data").text("");
        }
        
    });

    $("#search_user").on("submit",function(e){
        e.preventDefault();
        var search = $("#search_input").val();
        $.ajax({
            url: '../../controller/Dbusergetreceive.php',
            type: 'POST',
            data: {search:search},
            success: function(res){
                if(parseInt(res)!=0){
                    $("#result_data").text(`Result count: ${res}`);
                }
            }
        })
    })

}

function getuser(user_id, name, department, phonenumber, address, id, usertype, complete_address, image){
    html_getuser_data =`
    <div class="d-flex flex-column p-4 user-profile">
        <p>Profile</p>
        <div class="d-flex flex-column align-items-center profile-name">
            <img src=${image} alt="" id="user_profile" style="border-radius: 50%">
            <h2 class="user-name text-center mt-4"></h2>
            <div class="d-flex flex-row user-info">
                <div class="user-info-label">
                    STUDENT ID:
                </div>
                <div class="user-id">
                    
                </div>
            </div>
            <div class="user_type">
                
            </div>
        </div>
        <div class="d-flex flex-column data-info">
            <div class="label-content">
                Department
            </div>
            <div class="label-data" id="department"></div>
        </div>
        <div class="d-flex flex-column data-info">
            <div class="label-content">
                Phone Number
            </div>
            <div class="label-data" id="pnumber"></div>
        </div>
        <div class="d-flex flex-column data-info">
            <div class="label-content">
                Address
            </div>
            <div class="label-data" id="complete_address"></div>
        </div>
        <div class="d-flex flex-row justify-content-center gap-2 mt-3">
            <button class="btn btn-primary w-25 btn_ok" onclick="btn_ok()">OK</button>
            <button class="btn btn-danger" id="btn_cancel" onclick="cancel_okay();">Cancel</button>
        </div>
    </div>
    `;

    $(".profile-content").html(html_getuser_data);

    $("#search_input").val("");
    $(".search-result").hide();
    $("#containner_content").removeClass("col-lg-12").addClass("col-lg-8");
    $(".profile-content").show();
    $(".user-name").text(name);
    $(".user-id").text(id);
    $(".user_type").text(usertype);
    $("#department").text(department);
    $("#pnumber").text('0'+phonenumber);
    $("#address").text(address);
    $("#complete_address").text(complete_address);
    forms = `   
    <form id="input_amount" class="insert-forms">
        <div class="d-flex flex-column gap-2 search-content">
            <div id="mobile_view">

            </div>
            <div class="form-label">
                Amount
            </div>
            <div class="input-piso">
                <input type="number" id="input_balance" placeholder="Enter Amount" class="mt-2 form-control text-center" min="1">
                <div class="piso-sign">₱</div>
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary w-100" id="send_btn">Okay</button>
    </form>`; 
    $(".form-input").html(forms);

    var screen_size = $(window).width();
    var mobile_view = "";
    if(screen_size>=320||screen_size!=1020){
        mobile_view = `
        <div class="d-flex flex-column">
            <div>
                Send to
            </div>
            <div class="d-flex flex-row justify-content-between align-items-center sender_info">
                <div class="sender_name">
                    ${name}
                </div>
                <img src=${image} class="sender_image rounded-circle" onclick="send_rev()">
            </div>
        </div>`;
    }else{
        mobile_view = `
        <div>

        </div>`;
    }
    $("#mobile_view").html(mobile_view);

    $("#input_amount").on("submit",function(e){
        e.preventDefault();
        var send_amount = $("#input_balance").val();
        if(send_amount.length!=0&&parseInt(balance)>=parseInt(send_amount)){
            Swal.fire({
                html: `<div class="swal_content">
                            <p class="swal-label">Review</p>
                            <div class="swal-review-amount">
                                <div class="swal-label-amount">Amount</div>
                                <div class="amount-info" id="inserted_amount">₱ ${send_amount}.00</div>
                                <div>To</div>
                                <div class="swal-name-user">
                                    <img src="../../image/avatar.jpg" class="swal-image">
                                    <div class="swal-name-course">
                                        <div class="send-name">${name}</div>
                                        <div class="send-course">${usertype}|${department}</div>
                                    </div>
                                </div>
                            </div>
                    </div>`,
                background: 'rgb(150, 150, 236)',
                cancelButtonColor: '#5cb85c',
                confirmButtonText: 'Send now'
            }).then(function(result){
                if (result.isConfirmed) {
                    getbalanceinputed(parseInt($("#input_balance").val()), user_id);
                }
            })
        }else if(parseInt(balance)<parseInt(send_amount)){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Not enough balance!',
                showConfirmButton: false,
                timer: 1000
            })
        }
        
    })

}

function cancel_okay(){
    searchForm();
    $(".search-result").show();
    $("#containner_content").removeClass("col-lg-8").addClass("col-lg-12");
    $(".profile-content").hide();
    $("#input_balance").attr("readonly", false);
    $("#send_btn").removeProp("disabled");
    $("#insert_password").val("");
    $("#result_data").text("");
}

function btn_ok(){
    $(".profile-content").hide();
}

function send_rev(){
    $(".profile-content").show();
}

function getbalanceinputed(inputed_balance, sendToId){
    $("#show_modal").click();
    $("#submit_password").on("submit", function(e){
        e.preventDefault();
        $.ajax({
            url: '../../controller/DbuserInsertPass.php',
            type: 'POST',
            data: {password: $("#insert_password").val()},
            cache: false,
            success: function(res){
                if(res=="success"){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Sent!',
                        showConfirmButton: false,
                        timer: 1000
                    }).then(function(){
                        input_amount(inputed_balance, sendToId);
                        getbalance();
                        $("#input_balance").attr("readonly", true);
                        $("#send_btn").prop("disabled", "disabled");
                        $(".modal-body > #close_modal").click();
                        // window.location="usersend_money.php";
                    })
                    
                }else{
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Wrong Password!',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            }
        })
    })
    
}

let x = true;
function showHidePass(){
    if(x==true){
        $("#insert_password").attr("type","text");
        $("#eye-icon").removeClass("fa-eye-slash").addClass("fa-eye");
        x=false;
    }else{
        $("#insert_password").attr("type","password");
        $("#eye-icon").removeClass("fa-eye").addClass("fa-eye-slash");
        x=true;
    }
}

function input_amount(inputed_balance, sendToId){
    
    $.ajax({
        url: '../../controller/DbuserSendAmount.php',
        type: 'POST',
        data:{
            inputed_balance : inputed_balance,
            sendToId : sendToId
        },
        cache: false,
        success: function(res){
            var result = JSON.parse(res);
            var amount = `${result.send_amount}.00`;
            var parts = amount.toString().split(".");
            var num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");

            var date = new Date(result.sendBalance_Date);
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
            html_success = `
            <div class="d-flex flex-column gap-3 success-message p-5">
                <div class="d-flex flex-row justify-content-center align-items-center gap-2 success-icon">
                    <div class="success-text">Success</div>
                    <img src="../../image/succes-icon.png" alt="success image">
                </div>
                <div class="d-flex flex-row justify-content-center image">
                    <img src="../../image/avatar.jpg" alt="avatar">
                </div>
                <div class="d-flex flex-column align-items-center message-name">
                    <div class="message-info">
                        You've successfully sent money to
                    </div>
                    <div class="name-receiver">
                        <h5>${result.firstname} ${result.lastname}</h5>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center amount-sent">
                    <div class="d-flex flex-row peso-sign">
                        <div class="sign">₱</div>
                        <div class="amount-sended">
                            ${num}
                        </div>
                    </div>
                    <div class="total">
                        Total Amount
                    </div>
                </div>
                <div class="d-flex flex-column gap-2 generate-data">
                    <div class="d-flex flex-row justify-content-between generate">
                        <div class="generate-label">Date and Time: </div>
                        <div class="generate-result">${monthFull[mounth]}/${day}/${year} ${strTime}</div>
                    </div>
                    <div class="d-flex flex-row justify-content-between generate">
                        <div class="generate-label">Reference Number:</div>
                        <div class="generate-result">${result.sendBalance_ref}</div>
                    </div>
                </div>
                <div class="btn_okay mt-3">
                    <button class="btn btn-primary w-100" onclick="cancel_okay();">OKAY</button>
                </div>
            </div>
            `;
            $(".profile-content").html(html_success);
            
        }
    })
}