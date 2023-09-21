$(document).ready(function () {
  $(".student").on("click", function () {
    $(".contents").load("usertype_student_form.php");
  });

  $(".personnel").on("click", function () {
    $(".contents").load("usertype_personnel_form.php");
  });
});
