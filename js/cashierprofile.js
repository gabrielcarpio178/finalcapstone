$(document).ready(function(){
    $("#nav").load("cashiernav.php");

    $("#change_pass").click(function(){
        $(".change-password").slideToggle("slow");
    });

    $("#cashier_info_form").on("submit", function(e){
        e.preventDefault();
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var gender = $("#gender").val();
        var phone_number = $("#phone_number").val();
        var email = $("#email").val();
        var address = $("#address").val();
        if(firstname==""||lastname==""||phone_number==""||email==""||address==""){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Empty Input!',
                showConfirmButton: false,
                timer: 1000
            });
        }else{
            $.ajax({
                url: '../../controller/DbcashierUpdateProfile.php',
                type: 'POST',
                data: {
                    firstname : firstname,
                    lastname : lastname,
                    gender : gender,
                    phone_number : phone_number,
                    email : email,
                    address : address
                },
                cache: false,
                success: function(res){
                    if(res=="success"){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Update success',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function(){
                            location.reload();
                        });
                    }
                }
            })
        }
    });

    getlength();

    $("#change_password").on("submit", function(e){
        e.preventDefault();
        var old_password = $("#old_password").val();
        var new_password = $("#new_password").val();
        var confirm_password = $("#confirm_password").val();
        if(old_password==""||new_password==""||confirm_password==""){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Empty Input!',
                showConfirmButton: false,
                timer: 1000
            });
        }else if(new_password!=confirm_password){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Password not Match!',
                showConfirmButton: false,
                timer: 1000
            });
        }else{
            $.ajax({
                url: '../../controller/DbcashierUpdatepassword.php',
                type: 'POST',
                data: {
                    old_password : old_password,
                    new_password : new_password
                },
                cache: false,
                success: function(res){
                    if(res=="success"){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Update success',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function(){
                            location.reload();
                        });
                    }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Wrong Old Password',
                            showConfirmButton: false,
                            timer: 1000
                        });
                    }
                }
            })
        }
    })

    getdatacashier();
});

function getdatacashier(){
    $.ajax({
        url: '../../controller/Dbgetcashieruser.php',
        type: 'POST',
        data: {cashier:'cashier'},
        cache: false,
        success: function(res){
            var result = JSON.parse(res);
            $(".cashier-name").text(`${result.firstname_cashier} ${result.lastname_cashier}`);
            if(result.gender=='male'||result.gender=='MALE'){   
                $("#male").attr("selected",'selected');
            }else{   
                $("#female").attr("selected",'selected');
            }
            $("#phone_number").prop('placeholder', `0${result.phonenumber}`);
            $("#email").prop('placeholder', result.email);
            $("#address").prop('placeholder', result.address);
            $("#edit_icon").on('click', function(){
                $(".cashier-name").html('<input id="firstname" class="form-control w-50 text-center fw-bold" type="text"><input id="lastname" class="form-control w-50 text-center fw-bold" type="text">');
                $("#gender").removeAttr("disabled");
                $("#phone_number").removeAttr("disabled");
                $("#email").removeAttr("disabled");
                $("#address").removeAttr("disabled");
                $("#edit_icon").html('<i class="fas fa-save" id="save_data" onclick="saveEdit()"></i>');
                editinfoallow(result);
            });
        }
    })
}

function editinfoallow(info){
    $("#firstname").val(info.firstname_cashier);
    $("#lastname").val(info.lastname_cashier);
    if(info.gender=='male'||info.gender=='MALE'){   
        $("#male").attr("selected",'selected');
    }else{   
        $("#female").attr("selected",'selected');
    }
    $("#phone_number").val(`0${info.phonenumber}`);
    $("#email").val(info.email);
    $("#address").val(info.address);
}

function saveEdit(){
    $("#btn_save").click();
}

function getlength(){
    let newPass = "";
    $("#new_password").keyup(function(){
        var length_newPass = this.value.length;
        if(length_newPass==0){
            $(".message-length .message-p").text("");
        }
        else if(length_newPass<6){
            $(".message-length .message-p").html("<div class='message-weak'>Weak Password</div>");
        }
        else if(length_newPass>=6){
            $(".message-length .message-p").html("<div class='message-strong'>Strong Password</div>");
        }
    });

}