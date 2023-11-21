$(document).ready(function(){
    $("#navbar").load("usernav.php");
    getdata();

    $(".camera_icon").on('click', function(){
        $("#upload_profile").click();
    });
    submitform();
    reviewprofile();

    $("#show_change_pass").click(function(){
        $("#change_pass").slideToggle("slow");
    });

    $("#change_pass").on("submit", function(e){
        e.preventDefault();
        var old_password = $("#old_password").val();
        var new_password = $("#new_password").val();
        var confirm_password = $("#confirm_password").val();
        $.ajax({
            url: '../../controller/DbuserChangePassword.php',
            type: 'POST',
            data: {
                old_password : old_password,
                new_password : new_password,
                confirm_password : confirm_password
            },
            cache: false,
            success: function(res){
                if(res=='success'){
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title:"Update Password",
                        showConfirmButton: false,
                        timer: 1000
                    }).then(function(){
                        location.reload();
                    });
                }else if(res=='not_match'){
                    Swal.fire({
                        position: "center",
                        icon: "warning",
                        title:"Not Match",
                        showConfirmButton: false,
                        timer: 1000
                    });
                }else if(res=='wrong_old_password'){
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title:"Wrong Old Password",
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            }
        })
    })
})
let x = true;
function getdata(){
    $.ajax({
        url: '../../controller/Dbusergetdata.php',
        type: 'POST',
        data: {user: 'user'},
        cache: false,
        success: function(res){
            var user_data = JSON.parse(res);
            if(user_data.usertype=='student'){
                var profile_pic = (user_data.image_profile!=null)? `profile/${user_data.image_profile}`:'../../image/avatar.jpg';
                $("#profile_img").prop('src', profile_pic);
                $("#profile_name").text(`${user_data.firstname} ${user_data.lastname}`);
                $("#stud_id").prop('placeholder', user_data.studentID_number);
                $("#course").prop('placeholder', user_data.course);
                if(user_data.year=='1st'){
                    $('#1st').attr('selected',"selected");
                }else if(user_data.year=='2nd'){
                    $('#2nd').attr('selected',"selected");
                }else if(user_data.year=='3rd'){
                    $('#3rd').attr('selected',"selected");
                }else if(user_data.year=='4th'){
                    $('#4th').attr('selected',"selected");
                }
                if(user_data.gender=='male'||user_data.gender=='MALE'){   
                    $("#male").attr("selected",'selected');
                }else{   
                    $("#female").attr("selected",'selected');
                }
                $("#email").prop('placeholder', user_data.email);
                $("#p_num").prop('placeholder', `0${user_data.phonenumber}`);
                $("#address").prop('placeholder', user_data.complete_address);
                $("#usertype").prop('placeholder', user_data.usertype);
                $("#edit_icon").on('click', function(){
                    if(x==true){
                        $('.form-control').removeAttr("disabled");
                        editclick(user_data);
                        $("#firstname").show();
                        $("#lastname").show();
                        $("#profile_name").hide();
                        $(".camera_icon").show();
                        $("#stud_id").prop("disabled","disabled");
                        x = false;
                    }else{
                        $('#saveedit').click();
                        x = true;
                    }
                })
            }
            
        }
    });
}

function editclick(data_user){
    $("#firstname").val(data_user.firstname);
    $("#lastname").val(data_user.lastname);
    $("#stud_id").val(data_user.studentID_number);
    $("#course").val(data_user.course);
    $("#email").val(data_user.email);
    $("#p_num").val(`0${data_user.phonenumber}`);
    $("#address").val(data_user.complete_address);
    $("#usertype").val(data_user.usertype);
    $("#edit_icon").html(`<i class="fas fa-save"></i><p>Save</p>`);
}

function reviewprofile(){
    upload_profile.onchange = evt => {
        const [file] = upload_profile.files
        if (file) {
            profile_img.src = URL.createObjectURL(file);
        }
    }
}

function submitform(){
    $("#edit_form").on("submit", function(e){
        e.preventDefault();
        var values=$(this)[0];           
        var formData = new FormData(values);
        $.ajax({
            url: '../../controller/Dbusereditprofile.php',
            type: 'post',
            data: formData,             
            contentType: false,
            processData: false,
            cache: false,
            success: function(res){
                if(res=='success'){
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title:"Profile Update",
                        showConfirmButton: false,
                        timer: 1000
                    }).then(function(){
                        location.reload();
                    });
                }else if(res=='not_image'){
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Invalid Profile",
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
                
            }
        })              
    });
}