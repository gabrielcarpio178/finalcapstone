$(document).ready(function(){

    let new_show = false;
    $("#new_eye_icon").on('click', function(){
        if(new_show==false){
            $(this).removeClass("fa-eye-slash").addClass("fa-eye");
            $("#new_password").prop("type","text");
            new_show = true;
        }else{
            $(this).removeClass("fa-eye").addClass("fa-eye-slash");
            $("#new_password").prop("type","password");
            new_show = false;
        }
    });

    let con_show = false;
    $("#con_eye_icon").on('click', function(){
        if(con_show==false){
            $(this).removeClass("fa-eye-slash").addClass("fa-eye");
            $("#confirm_password").prop("type","text");
            con_show = true;
        }else{
            $(this).removeClass("fa-eye").addClass("fa-eye-slash");
            $("#confirm_password").prop("type","password");
            con_show = false;
        }
    });

    let newPass = "";

    $("#new_password").on('keyup', function(){
        if(this.value.length==0){
            $(".new_message").css("color","black");
        }else if(this.value.length<10&&this.value.length!=0){
            $(".new_message").css("color","red");
        }else{
            $(".new_message").css("color","green");
        }
    });

    $('#new_password').focusout(function(){
        newPass = $("#new_password").val();
    });

    $("#confirm_password").on('keyup', function(){
        var confirm_password = $(this).val();
        if(this.value.length==0){
            $(".con_message").css("color","black");
        }else if(confirm_password!=newPass){
            $(".con_message").css("color","red");
        }else if(confirm_password==newPass){
            $(".con_message").css("color","green");
        }
    });


    $("#submit_form").on('submit', function(e){
        e.preventDefault();
        var new_password = $('#new_password').val();
        var con_password = $('#confirm_password').val();
        if(new_password!=con_password){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Both password not match',
                showConfirmButton: false,
                timer: 1000
            })
        }else{
            $.ajax({
                url: 'controller/DbEnternewpassword.php',
                type: 'POST',
                data: {
                    new_password : new_password
                },
                cache: false,
                beforeSend: function(){
                    $(".loader").show();
                },
                success: function(res){
                    $(".loader").hide();
                    if(res=='success'){
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Password Change!',
                            showConfirmButton: false,
                            timer: 1000
                        }).then(function(){
                            window.location = "signin.php";
                        })
                    }
                }
            })
        }
        
    })


});