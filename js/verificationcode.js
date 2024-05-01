$(document).ready(function(){
    $("#form_submit").on("submit", function(e){
        e.preventDefault();
        var recode = $("#number_reset").val();
        $.ajax({
            url: 'controller/DbvalidateCode.php',
            type: 'POST',
            data: {recode : recode},
            cache: false,
            beforeSend: function(){
                $(".loader").show();
            },
            success: function(res){
                if(res=="valid"){
                    $(".loader").hide();
                    window.location = "internewpassword.php";
                }else{
                    $(".loader").hide();
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Invalid',
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            }
        })
    })
});