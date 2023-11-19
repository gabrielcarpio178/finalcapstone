$(document).ready(function(){
    $("#nav").load("adminnav.php");

    let isShow = true;
    $("#show_password").on("click",function(){
        if(isShow==true){
            $("#show_password").removeClass("fa-eye-slash");
            $("#show_password").addClass("fa-eye");
            $("#password").prop("type","text");
            isShow = false;
        }else{
            $("#show_password").addClass("fa-eye-slash");
            $("#show_password").removeClass("fa-eye");
            $("#password").prop("type","password");
            isShow = true;
        }
    })

    $("#sign_in").on("submit", function(e){
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        $.ajax({
            url: '../../controller/DbadminConfirm.php',
            type: 'POST',
            data: {username:username, password:password},
            cache: false, 
            success: function(res){
                if(res=='valid'){
                    modalShow();
                }else{
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Invalid",
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            }
        });
    })

});

function modalShow(){
    btn_modal = `
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: none" id="show_modal">
            Launch demo modal
        </button>`;
    $(".btn-modal").html(btn_modal);
    $("#show_modal").click();
    btn_content = `
        <b>Choose how you want to back up and restore your data:</b>
        <button class="btn btn-primary w-100" onclick="sql()">Export to SQL</button>
        <button class="btn btn-success w-100" onclick="excel()">Export to EXCEL</button>
    `;
    $("#btn_content").html(btn_content);
}

function sql(){
    window.open('../../controller/Dbadminback_upSql.php', '_self'); 
}

function excel(){
    btn_modal_excel = `
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#excelModal" style="display: none" id="show_excel_modal">
            Launch demo modal
        </button>`;
    $(".btn-modal-excel").html(btn_modal_excel);
    $("#show_excel_modal").click();
    $("#close_modal_type").click();
    
}
function selected(table){
    window.open(`../../controller/Dbadmindownload_excel.php?table=${table}`, '_self');
}



