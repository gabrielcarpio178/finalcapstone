$(document).ready(function () {
    $("#navbar").load("usernav.php");
    getdate();
});

function getdate(){
    var user_id = $("#user_id").val();
    $.ajax({
        url: '../../controller/DbuserGetaccount_balance.php',
        type: 'POST',
        data: {user_id : user_id},
        cache: false,
        success: function(res){
            var result = JSON.parse(res);
            $(".name-stundet_id").html(`<b>${result.lastname}, ${result.firstname}</b> | ${result.studentID_number}`);
            $(".course-year").text(`${result.course} | ${result.program_description} | ${result.year}-${parseInt(result.year)+1}`);
            $(".address").text(`${result.complete_address}`);
            $(".school-year").text(`A.Y. ${result.year}-${parseInt(result.year)+1} - ${result.semester}`);

            var amount_payment = `${result.amount_payment}.00`;
            var parts = amount_payment.toString().split(".");
            var amount_payment_num = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (parts[1] ? "." + parts[1] : "");
            $(".amount-non-bago").text(`₱${amount_payment_num}`);

            var non_bago_payment_num = `${result.non_bago_payment}.00`;
            var non_bago_payment_part = non_bago_payment_num.toString().split(".");
            var non_bago_payment = non_bago_payment_part[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",") + (non_bago_payment_part[1] ? "." + non_bago_payment_part[1] : "");
            $(".amount-non-bago-total").text(`₱${non_bago_payment}`);
        }
    });
}