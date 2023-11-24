$(document).ready(function(){
    $("#nav").load("cashiernav.php");

    $("#change_pass").click(function(){
        $(".change-password").slideToggle("slow");
    });

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