$(document).ready(function () {
  $("#formsubmitpersonnel").on("submit", function (e) {
    e.preventDefault();
    var id = $("#id_personnel").val();
    var department = $("#department").val();

    $.ajax({
      url: "../../controller/Dbusertypepersonnel.php",
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
            title: 'Hi! Personnel.',
            showConfirmButton: false,
            timer: 1500
          }).then(function () {
            window.location = "userhomepage.php";
          });
        }
      },
    });
  });
});

$("#cancelpersonnel").on("click", function () {
  window.location = "usertype.php";
});
