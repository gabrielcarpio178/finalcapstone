$(document).read(function(){
    $("#form_submit").on("submit", function(e){
        e.preventDefault();
        var recode = $("#number_reset").val();
        $.ajax({
            url: 'controller/DbvalidateCode.php',
            type: 'POST',
            data: {recode : recode},
            cache: false,
            success: function(res){
                console.log(res);
            }
        })
    })
});