$(document).ready(function () {
    $("#nav").load("cashiernav.php");
    search_user();
    rfid();
    $("#rfid").focus();
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
            $("#view_user").fadeIn().show();
            $("#main_info").removeClass("col-md-12").addClass("col-md-8");
            $("#view_user").show();
            $(".search-div").hide();
            if(data_user.gender=='male'||data_user.gender=='other'){
                $("#profile_image").attr("src","../../image/avatar.jpg");
            }else if(data_user.gender=='female'){
                $("#profile_image").attr("src","../../image/female_avatar.png");
            }
            $(".name").html(`<b>${(data_user.firstname).charAt(0).toUpperCase() + (data_user.firstname).slice(1)} ${(data_user.lastname).charAt(0).toUpperCase() + (data_user.lastname).slice(1)}</b>`);
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
}

function cancel(){
    $("#main_info").removeClass("col-md-8").addClass("col-md-12");
    $("#view_user").fadeOut().hide();
    $(".user-info").fadeOut().hide();
    $(".logo-id").fadeIn().show();
    $(".content_display").show();
    $(".search-div").show();
    $("#rfid").focus();
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
                    getuser(res);
                }
            });
        }
    });
}