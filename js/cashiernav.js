$(document).ready(function () {
  $("#home").on("click", function () {
    window.location = "cashierhomepage.php";
  });

  $("#cash_in").on('click', function(){
    window.location = "cashiercashin.php";
  });
  
  $("#logout").on("click", function () {
    // console.log('click');

    $.ajax({
      url: "../../controller/Dblogout.php?logout=click",
      beforeSend: function () {
        $(".loader").show();
      },
      success: function (res) {
        $(".loader").hide();
        Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Goodbye!',
          showConfirmButton: false,
          timer: 1500
        }).then(function () {
          window.location = "../../signin.php";
        });
      },
    });

  }); 
  
});
