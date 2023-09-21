$("#studentid").on('keyup', function(){
  if (this.value.length == 0) {
    $(this).removeClass("is-invalid");
  }else if(this.value.length < 10){
    $("#message-input").text("Number of digit! "+this.value.length);
    $("#message-input").removeClass("invalid");
  }
  else if(this.value.length > 10){
    $("#message-input").addClass("invalid");
    $("#message-input").text("10 Digit Only!");
  }
});

$("#formsubmitstudent").on("submit", function (e) {
  e.preventDefault();
  var id = $("#id").val();
  var studentid = $("#studentid").val();
  var department_student = $("#department_student").val();
  var year = $("#year").val();
  if (studentid.length == 0) {
    Swal.fire({
      position: 'center',
      icon: 'error',
      title: 'Messing input!',
      showConfirmButton: false,
      timer: 1000
    });
  } else if (studentid.length != 10) {
    Swal.fire({
      position: 'center',
      icon: 'error',
      title: 'ID numbers mas be 10 digit!',
      showConfirmButton: false,
      timer: 1000
    });
  } else {
    $.ajax({
      url: "../../controller/Dbusertypestudent.php",
      type: "POST",
      data: $(this).serialize(),
      cache: false,
      beforeSend: function () {
        $(".loader").show();
      },
      success: function (res) {
        $(".loader").hide();
        if (res == "success") {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Hi! Student.',
            showConfirmButton: false,
            timer: 1500
          }).then(function () {
            window.location = "userhomepage.php";
          });
        } else if (res == "invalid") {
          Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Student ID Number is already used!',
            showConfirmButton: false,
            timer: 1000
          })
        }
      },
    });
  }
});

$("#cancelstudent").on("click", function () {
  window.location = "usertype.php";
});
