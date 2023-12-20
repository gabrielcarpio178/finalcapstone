//$(".details").load('controller/Dbmenu.php');
product_form();
edit();
delete_item();

$(document).ready(function () {
  let previous_id = 0;
  $(".category-content").click(function () {
    var id = $(this).attr("id");
    $("#" + previous_id).removeClass("classfocus");
    $("#" + id).addClass("classfocus");
    previous_id = id;
  });

  $(".edit-category").on("click", function () {
    var id = $(this).attr("id");
    $.ajax({
      url: "editcategoryform.php",
      type: "POST",
      data: { id: id },
      cache: false,
      success: function (res) {
        $(".add-form").slideDown("slow", function () {
          $(this).show();
        });
        $(".forms").html(res);
      },
    });
  });

  $(".delete-category").on("click", function () {
    var category_id = $(this).attr("id");

    Swal.fire({
      title: "Are you sure?",
      text: "This category deleted and the product belong to this category.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes",
      cancelButtonText: "No",
    }).then((result) => {
      if (result.isConfirmed) {
  
        $.ajax({
          url: "../../controller/Dbdeletecategory.php",
          type: "POST",
          data: {category_id: category_id},
          cache: false,
          beforeSend: function () {
            $(".loader").show();
          },
          success: function(res){
            $(".loader").hide();
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: "Category and product has been deleted!",
              showConfirmButton: false,
              timer: 1000
            }).then(function () {
               window.location = "teller_menu.php";
            });

          }
        });

      }
    });
  })
 
});

function category_menu(menu_id, teller_id) {
  $(document).ready(function () {
    $.ajax({
      url: "../../controller/Dbmenu.php",
      type: "POST",
      data: { menu_id: menu_id, teller_id: teller_id },
      cache: false,
      success: function (res) {
        $(".details").html(res);
        product_form();
        edit();
      },
    });
  });
}

let able = false;
$(".action").click(function () {
  if (able) {
    $(".detail").animate({
      fontSize: "100%",
    });
    able = false;
    $(".detail").css("pointer-events", "none");
    $(".action i").css("color", "#282828de");
    $(".add-prd").show();
    $(".flex-row .delete_product").hide();
  } else {
    $(".detail").animate({
      fontSize: "20px",
    });
    able = true;
    $(".detail").css("pointer-events", "auto");
    $(".action i").css("color", "blue");
    $(".add-prd").hide();
    $(".flex-row .delete_product").show();
  }
});

let category_able = false;
$(".action-category").click(function () {
  if (category_able) {
    $(".category-content").animate({
      fontSize: "100%",
    });
    category_able = false;
    $(".select_category").removeClass("disable-click");

    $(".edit-delete-category").prop("style", "display: none !important;");
  } else {
    $(".category-content").animate({
      fontSize: "20px",
    });
    category_able = true;
    $(".edit-delete-category").prop(
      "style",
      "position:relative; display: block !important; bottom: 1.5vh;"
    );
    $(".select_category").addClass("disable-click");
  }
});

$("#add_category_form").click(function () {
  $("#add_product").hide();
  $(".add-form").slideDown("slow", function () {
    $(this).show();
  });
  $(".forms").load("tellerformcategory.php");
});

function product_form() {
  $("#product_form").click(function () {
    $(".add-form").slideDown("slow", function () {
      $(this).show();
    });

    $(".forms").load("tellerformproduct.php");
  });
}

function close_category() {
  $(".add-form").slideUp("slow", function () {
    $(this).hide();
  });
}

function edit() {
  $(".detail").on("click", function () {
    var product_id = $(this).attr("id");

    $.ajax({
      url: "../../controller/Dbteller_edit.php",
      type: "POST",
      data: { product_id: product_id },
      cache: false,
      success: function (res) {
        $(".add-form").slideDown("slow", function () {
          $(this).show();
        });

        $(".forms").html(res);
      },
    });
  });
}

function delete_item(){
  $(".flex-row .delete_product").on('click', function(){
    var item = $(this).attr('id');

    Swal.fire({
      title: "Are you sure?",
      text: "You want to delete this product?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes",
      cancelButtonText: "No",
    }).then((result)=>{
      if (result.isConfirmed) {

        $.ajax({
          url: "../../controller/Dbtellerdeleteproduct_item.php",
          type: "POST",
          data: {item : item},
          cache: false,
          beforeSend: function () {
            $(".loader").show();
          },
          success: function(res){
            $(".loader").hide();
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: "Product Deleted!",
              showConfirmButton: false,
              timer: 1000
            }).then(function () {
               window.location = "teller_menu.php";
            });
          }
        });

      }
    });



    
  })
}