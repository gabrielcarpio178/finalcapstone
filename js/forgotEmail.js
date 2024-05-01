$(document).ready(function(){
    $("#form_submit").on('submit', function(e){
        e.preventDefault();
        var email = $("#email").val();
        $.ajax({
            url: 'controller/DbinsertEmailForgot.php',
            type: 'POST',
            data: {email_input : email},
            cache: false,
            success: function(res){
                if(res=="invalid"){
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Invalid',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }else{
                    sendverificationcode(res, email);
                }
            }
        })
    })
});

function sendverificationcode(reset_code, email_user){
    $.ajax({
        url: 'controller/Dbsendreset_code.php',
        type: 'POST',
        data: {
            reset_code : reset_code,
            email_user : email_user
        },
        cache: false,
        beforeSend: function(){
            $(".loader").show();
        },
        success: function(res){
            $(".loader").hide();
            if(res=='send_success'){
                window.location="verificationcode.php";
            }
        }
    });
}