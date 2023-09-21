$(document).ready(function () {
  $("#nav").load("usernav.php");

  $("#cart").on("click", function () {
    $(".orders").slideDown(function () {
      $(this).show();
      $("#cart").hide();
      $(".number-count").hide();
    });
  });

  $("#close").on("click", function () {
    $(".orders").slideUp(function () {
      $(this).hide();
      $("#cart").show();
      $(".number-count").show();
    });
  });
  //function
  focus_category();
  order();
  let prev_id = 1;
  $(".teller").on("click", function () {
    var id = $(this).attr("id");

    $("#" + prev_id).removeClass("fucos-teller");
    $("#" + id).addClass("fucos-teller");
    prev_id = id;
    //get category from database
    $.ajax({
      url: "../../controller/Dbusergetmenu.php",
      type: "POST",
      data: { id: id },
      cache: false,
      success: function (res) {
        $("#category-menu").html(res);
        getproduct(0, id);
        focus_category();
        //submitorder();
      },
    });
  });

  submit();

  $("#user_order").on("click", function () {
    window.location = "userordersummary.php";
  });
});


//fucos category
function focus_category() {
  let prev_category_id = "category0";
  $(".menu-purchase").on("click", function () {
    var next_category_id = $(this).attr("id");
    $("#" + prev_category_id).removeClass("fucos-teller");
    $("#" + next_category_id).addClass("fucos-teller");
    prev_category_id = next_category_id;
  });
}

//get product from database
function getproduct(category_id, teller_id) {
  $.ajax({
    url: "../../controller/Dbusergetproduct.php",
    type: "POST",
    data: {
      category_id: category_id,
      teller_id: teller_id,
    },
    cache: false,
    success: function (res) {
      $("#product-list").html(res);
      order();
      highlight();
    },
  });
}

//get order from database
function order() {
  $(".product-info").on("click", function () {
    var product_id = $(this).attr("id");
    $.ajax({
      url: "../../controller/Dborderuser.php",
      type: "POST",
      data: { product_id: product_id },
      cache: false,
      success: function (res) {
        $(".selected-menu").prepend(res);
        remove_order();
        total_amount();
        //submitorder();
      },
    });
  });
}

//highlingseleted product
const selected_list = [];
function highlight() {
  for (let i = 0; i < selected_list.length; i++) {
    $(".product_select_" + selected_list[i]).addClass("selected-order");
  }

}
//selected order
let number_order = 0;
function add_selectedClass(id) {
  $(".product_select_" + id).addClass("selected-order");
  selected_list.push(id);
  number_order++;
  $(".number-count").text(number_order);
}

//remove item
function remove_order() {
  $("#cancel").on("click", function () {
    let remove_class = $(this).attr("name");
    var remove_id = selected_list.indexOf(parseInt(remove_class));
    $(".product_select_" + remove_class).removeClass("selected-order");
    let remove_item = $(this).parent();
    $(remove_item).remove();
    selected_list.splice(remove_id, 1);
    number_order--;
    $(".number-count").text(number_order);
    total_amount();
  });
}

//add quantity
function addquantity(id) {
  var numberqty = $("#numqty_" + id).val();
  numberqty++;
  $("#numqty_" + id).val(numberqty);
  total_amount();
}

function removeorderifzero(id){
  let remove_class = id;
  var remove_id = selected_list.indexOf(parseInt(remove_class));
  $(".product_select_" + remove_class).removeClass("selected-order");
  let remove_item = $("."+id).parent();
  $(remove_item).remove();
  selected_list.splice(remove_id, 1);
  number_order--;
  $(".number-count").text(number_order);
  total_amount();
  // console.log(id);
}

//minus quantity;
function minusquantity(id) {
  var numberqty = $("#numqty_" + id).val();
  numberqty--;
  $("#numqty_" + id).val(numberqty);
  total_amount();
  for (let x = 0; x < selected_list.length; x++) {
    var qty = parseInt($("#numqty_" + selected_list[x]).val());
    if(qty==0){
      i = true;
      removeorderifzero(selected_list[x]);
      break;
    }else{
      i = false;
    }
  }
}

//show total amount
function total_amount() {
  let total = 0;
  for (let x = 0; x < selected_list.length; x++) {
    var qty = parseInt($("#numqty_" + selected_list[x]).val());
    var price = parseInt($("#price_" + selected_list[x]).val());
    var result = price * qty;
    total = total + result;
  }

  // if(<?=$amount ?> < total){
  //     $(".total-amount").addClass('not-enough');
  // }else{
  //      $(".total-amount").removeClass('not-enough');
  // }
  if (typeof total === "number") {
    $(".total-amount").text("Total: " + total + ".00");
  }else if(total<0){
    $(".total-amount").text("Total: " + 0 + ".00");
  } else {
    $(".total-amount").text("Total: " + 0 + ".00");
  }
}

function submit(){
  
  $("#submit_order").on("submit", function (e) {
    e.preventDefault();
    
    if(selected_list.length==0){
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Empty Order',
        showConfirmButton: false,
        timer: 1000
      });
    }else {
      
      $.ajax({
        url: "../../controller/Dbuser_insertorder.php",
        type: "POST",
        data: $(this).serialize(),
        cache: false,
        beforeSend: function () {
          $(".loader").show();
        },
        success: function (res) {
          // console.log(res);
          if (res == "success") {
            $(".loader").hide();
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: 'Order sent',
              showConfirmButton: false,
              timer: 1000
            }).then(function () {
              window.location = "userordersummary.php";
            });
          }
        },
      });
      
    }
  });

}
