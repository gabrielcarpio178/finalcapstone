$(document).ready(function () {
  $("#nav").load("cashiernav.php");

  let i;

  $("#non_bago").on("click", function () {
    $(this).addClass("fucos-class");
    $(".focus-" + i).removeClass("fucos-class");
    i = 1;
    console.log(i);
  });

  $("#cash_out").on("click", function () {
    $(this).addClass("fucos-class");
    $(".focus-" + i).removeClass("fucos-class");
    i = 2;
    console.log(i);
  });
});
