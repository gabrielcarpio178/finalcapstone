let balance = '';
$(document).ready(function(){
    $("#navbar").load("usernav.php");
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
            <div class="form-label">
                Send to:
            </div>
            <input type="text" id="search_input" placeholder="Enter Name Or User ID" class="mt-2 form-control">
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
                            tbody += `
                            <tr onclick="getuser('${(data[i]).user_id}', '${(data[i]).name}', '${(data[i]).department}', '${(data[i]).phonenumber}', '${(data[i]).address}', '${(data[i]).id}', '${(data[i]).usertype}')">
                                <td>${(data[i]).name}</td>
                                <td>${(data[i]).department}</td>
                                <td>${(data[i]).id}</td>
                            <tr>`;
                        }
                        table_result = `
                        <div class="table-responsive-sm">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Department</th>
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
                console.log(res);
            }
        })
    })

    $("#btn_cancel").on("click",function(){
        searchForm();
        $(".search-result").show();
        $("#containner_content").removeClass("col-8").addClass("col-12");
        $(".profile-content").hide();
    })

}

function getuser(user_id, name, department, phonenumber, address, id, usertype){
    $("#search_input").val("");
    $(".search-result").hide();
    $("#containner_content").removeClass("col-12").addClass("col-8");
    $(".profile-content").show();
    $(".user-name").text(name);
    $(".user-id").text(id);
    $(".user_type").text(usertype);
    $("#department").text(department);
    $("#pnumber").text('0'+phonenumber);
    $("#address").text(address);
    forms = `   
    <form id="input_amount" class="insert-forms">
        <div class="d-flex flex-column search-content">
            <div class="form-label">
                Amount:
            </div>
            <div class="input-piso">
                <input type="number" id="input_balance" placeholder="Enter Amount" class="mt-2 form-control text-center" min="0">
                <div class="piso-sign">₱</div>
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary w-100">Okay</button>
    </form>`; 
    $(".form-input").html(forms);

    $("#input_amount").on("submit",function(e){
        e.preventDefault();
        var send_amount = $("#input_balance").val();
        if(send_amount.length!=0&&parseInt(balance)>parseInt(send_amount)){
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
                    Swal.fire({
                        html: `<div class="swal_content">
                                    <p class="inputpass-label">Please enter your password</p>
                                    <div class="insert_form">
                                        <input type="password" id="insert_password" class="form-control">
                                        <i class="fa-solid fa-eye-slash"></i>
                                    </div>
                            </div>`,
                        background: 'rgb(150, 150, 236)',
                        cancelButtonColor: '#5cb85c',
                        confirmButtonText: 'Okay'
                    })
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
        }else if(send_amount.length==0){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Please Insert Amount!',
                showConfirmButton: false,
                timer: 1000
            })
        }
        
    })

}