$(document).ready(function () {
    $("#nav").load("cashiernav.php");
    rfid();
    $(".content_display").on('click',function(){
        $(".search").attr('id', "rfid");
        $(".search").attr('placeholder', 'Scan RFID');
        rfid();
        $("#rfid").focus();
    })
    $(".search").on('click', function(){
        $(this).attr('id', "search");
        $(this).attr('placeholder', 'Search Name OR ID');
        search_user();
    })
});

function search_user(){
    $("#search").on("keyup", function(){
        var search = $(this).val();
        if(search.length!=0){
            $(".logo-id").fadeOut().hide();
            $.ajax({
                url: '../../controller/Dbcashiersearch_cashin.php',
                type: 'POST',
                data: {search: search},
                caches: false,
                success: function(res){
                    var result = JSON.parse(res);
                    html='';
                    // console.log(result);
                    if(result[1].length != 0){
                        $('.search-table').fadeIn().show();
                        for(let i = 0; i<result[1].length; i++){
                            if((result[6])[i]!=undefined){
                                html += `<tr onclick="getuser(${(result[5])[i]})">
                                            <td>${(result[0])[i]} ${(result[1])[i]}</td>
                                            <td>${(result[2])[i]}</td>
                                            <td>0${(result[4])[i]}</td>
                                            <td>${(result[6])[i]}</td>
                                            <td>${(result[3])[i]}</td>
                                        </tr>`;
                            }
                        }
                        $(".table-body").html(html);
                        $(".message").hide();
                    }else{
                        $(".message").text("No Result");
                    }

                }
            });

        }else{
            $('.search-table').fadeOut().hide();
            $(".logo-id").fadeIn().show();
            $(".message").hide();
            $("#rfid").focus();
        }

    });
}

function getuser(user_id){

    $.ajax({
        url: '../../controller/Dbcashiergetuser.php',
        type: 'POST',
        data: {user_id: user_id},
        cache: false,
        success: function(res){
            var data_user = JSON.parse(res);
            $(".content_display").hide();
            $('.search-table').hide();
            $(".user-info").fadeIn().show();
            $("#main_info").removeClass("col-md-12").addClass("col-md-8");
            $(".profile-user").fadeIn().show();
            $(".search-div").hide();
            if(data_user.gender=='male'||data_user.gender=='other'){
                $("#profile_image").attr("src","../../image/avatar.jpg");
            }else if(data_user.gender=='female'){
                $("#profile_image").attr("src","../../image/female_avatar.png");
            }
            $(".name").html(`<b id="user_full_name">${(data_user.firstname).charAt(0).toUpperCase() + (data_user.firstname).slice(1)} ${(data_user.lastname).charAt(0).toUpperCase() + (data_user.lastname).slice(1)}</b>`);
            $("#user_id").text(`STUDENT ID:`);
            if(data_user.usertype=='student'){
                $(".user_id").text(`STUDENT ID: ${data_user.studentID_number}`);
                $(".user-type").text("Student");
                $("#department_year").text("Course: Year");
                $("#department_user").text(`${data_user.course}: ${data_user.year}`);
            }else if(data_user.usertype=='personnel'){
                $(".user_id").text(`PERSONNEL ID: ${data_user.personnelUser_id}`);
                $(".user-type").text("Personnel");
                $("#department_year").text("Department:");
                $("#department_user").text(`${data_user.department}`);
            }

            $("#phonenumber_user").text(`0${data_user.phonenumber}`);
            $("#address_user").text(`${data_user.address}`);
            $(".balance_amount").text(`${data_user.user_balance}.00`);
            
        }
    });
    sumbit_amount(user_id);
}

function cancel(){
    $("#main_info").removeClass("col-md-8").addClass("col-md-12");
    $(".profile-user").fadeOut().hide();
    $(".user-info").fadeOut().hide();
    $(".logo-id").fadeIn().show();
    $(".content_display").show();
    $(".search-div").show();
    $("#rfid").focus();
    $("#rfid").val("");
    $("#input_amount").val("");
    $("#input_amount").removeAttr("disabled");
    $("#sent_message").fadeIn().hide();
    $("#input-sumbit button").removeAttr("disabled");
}

function rfid(){
    $("#rfid").on("keyup",  function(){
        var rfid = $(this).val();
        if(rfid.length==10){
            $.ajax({
                url: '../../controller/Dbrfidscanner.php',
                type: 'POST',
                data: {rfid:rfid},
                cache: false,
                success: function(res){   
                    if(res=="invalid-rfid"){
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Invalid RFID',
                            showConfirmButton: false,
                            timer: 1000
                            })
                            $("#rfid").val("");
                    }else{
                        getuser(res);
                    }
                }
            });
        }
    });
}

function sumbit_amount(user_id){
    $("#input-sumbit").on("submit", function(e){
        e.preventDefault();
        var amount = $("#input_amount").val();
        var name = $("#user_full_name").text();
        var image = $("#profile_image").attr("src");
        var buyer_type = $(".user-type").text();
        var section_course = $("#department_user").text();
        if(amount.length!=0&&amount!=0){
            Swal.fire({
                html: `<div class="swal_content">
                            <p class="swal-label">Review</p>
                            <div class="swal-review-amount">
                                <div class="swal-label-amount">Amount</div>
                                <div class="amount-info" id="inserted_amount">₱ ${amount}.00</div>
                                <div>To</div>
                                <div class="swal-name-user">
                                    <img src="${image}" class="swal-image">
                                    <div class="swal-name-course">
                                        <div class="send-name">${name}</div>
                                        <div class="send-course">${buyer_type}|${section_course}</div>
                                    </div>
                                </div>
                            </div>
                    </div>`,
                background: 'rgb(150, 150, 236)',
                cancelButtonColor: '#5cb85c',
                confirmButtonText: 'Send now'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../controller/Dbcashierinsent_amount.php',
                    type: 'POST',
                    data: {amount: amount, user_id: user_id},
                    cache: false,
                    beforeSend: function(){
                        $(".loader").show();
                    },
                    success: function(res){
                        $(".loader").hide();
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Sent Balance',
                            showConfirmButton: false,
                            timer: 1000
                        });
                        getsuccessmessage(res);
                    
                    }
                });
                }
            });
        }else if(amount==0){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Invalid zero amount',
                showConfirmButton: false,
                timer: 1000
            });
        }else{
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Please Input amount',
                showConfirmButton: false,
                timer: 1000
            });
        }
        
    });
}

function  getsuccessmessage(ref_num){
    $(".profile-user").fadeOut().hide();
    $("#sent_message").fadeIn().show();
    $("#input_amount").attr("disabled","disabled");
    $("#input-sumbit button").attr("disabled", 'disabled');
    $.ajax({
        url: '../../controller/Dbcashiergetref_num.php',
        type: 'POST',
        data: {ref_num: ref_num},
        cache: false,
        success: function(res){
            var info_data = JSON.parse(res);
            
            if(info_data.gender=='male'||info_data=='other'){
                image = "../../image/avatar.jpg";
            }else{
                image = "../../image/female_avatar.png";
            }
            $("#user_sent").text(`${info_data.firstname} ${info_data.lastname}`);
            $("#amount-money").text(info_data.cashin_amount+".00");

            var date = new Date(info_data.cashin_date);
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
            $(".date-info").text(`${monthFull[mounth]}/${day}/${year} ${strTime}`);
            $("#ref_num").text(info_data.ref_num); 
            $(".profile-icon").attr('src', image);
        }
    });

}
