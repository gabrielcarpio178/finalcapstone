let category = 'All';
let usertype = 'all';
let address = 'ALL';
let page = 0;
let add_row = 5;
$(document).ready(function(){
    $("#nav").load("adminnav.php");

    $("#phonenumber").keyup(function () {
        if (this.value.length == 0) {
          $("#phonenumber")
            .removeClass("form-control form-group-lg is-invalid")
            .addClass("form-control form-group-lg");
        } else if (this.value.length < 11) {
          $("#phonenumber")
            .removeClass("form-control form-group-lg is-valid")
            .addClass("form-control form-group is-invalid");
        } else if (this.value.length > 11) {
          $("#phonenumber")
            .removeClass("form-control form-group-lg is-valid")
            .addClass("form-control form-group is-invalid");
          $("#message").removeClass("valid-feedback").addClass("invalid-feedback");
          $("#message").html(
            "Sorry, input phone number is to long. The digit number must be 11"
          );
        } else {
          $("#phonenumber")
            .removeClass("form-control form-group-lg is-invalid")
            .addClass("form-control form-group is-valid");
        }
      });
      
      $("#add_teller").on("submit", function (e) {
        e.preventDefault();
        var firstname = $("#firstname").val();
        var lastname = $("#lastname").val();
        var phonenumber = $("#phonenumber").val();
        var storename = $("#storename").val();
        var gender = $().val('gender');
        var username = $("#username").val();
        var password = $("#password").val();
        var confirm_pass = $("#confirm_pass").val();
    
        if (
          firstname == "" ||
          lastname == "" ||
          phonenumber == "" ||
          storename == "" ||
          password == "" ||
          confirm_pass == ""||
          gender == null
        ) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "Empty input!",
                showConfirmButton: false,
                timer: 1000
            });
        } else if (phonenumber.length != 11) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "Invalid Phone number length!",
                showConfirmButton: false,
                timer: 1000
            });
        } else if (password != confirm_pass) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "Password not match and Confirm Password!",
                showConfirmButton: false,
                timer: 1000
            });
        } else {
          $.ajax({
            url: "../../controller/Dbaddtelleruser.php",
            type: "POST",
            data: $(this).serialize(),
            cache: false,
            beforeSend: function () {
              $(".loader").show();
            },
            success: function (res) {
              console.log(res);
              if (res == "success") {
                $(".loader").hide();
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: "Add Teller!",
                  showConfirmButton: false,
                  timer: 1000
                }).then(function () {
                  window.location.reload();
                });
              } else if (res == "invalidinput") {
                $(".loader").hide();
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: "username and password are already used",
                    showConfirmButton: false,
                    timer: 1000
                });
              } else if (res == "contact_already_used") {
                $(".loader").hide();
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: "Contact already used.",
                    showConfirmButton: false,
                    timer: 1000
                });
              }
            },
          });
        }
      });
    
    num_of_data();
    table_info('All', 'all', 'ALL', 5, 1);
    $(".txt, #filter, .checkbox").each(function() {
        $(this).change(function(){
            address = $(this).val();
             table_info(category, usertype, address, add_row, page);
        }); 
    });

    $(".txt, #add_row, .checkbox").each(function() {
        $(this).change(function(){
            add_row = $(this).val();
             table_info(category, usertype, address, add_row, page);
        }); 
    });

    $(".data").on('click', function(){
        category = $(this).attr('id');
        usertype = $(this).attr('name');
        table_info(category, usertype, address, add_row, page);
    });

    $('#search').on('keyup', function(){
        var search = $(this).val();
        if(search.length != 0){

            $.ajax({
                url: '../../controller/Dbadminusermanagement_search.php',
                type: 'POST',
                data: {
                    search : search
                },
                cache: false, 
                success: function(res){
                    $(".table-info").html(res);
                }
            });

        }else{
            table_info(category, usertype, address, add_row, page);
        }
            
    });
 
});

function page_num(page_num){
    table_info(category, usertype, address, add_row, page_num);
}
 
function num_of_data(){
    $.ajax({
        url: '../../controller/Dbadminusermanagement_num_of_data.php',
        type: 'POST',
        data: {info: 'info'},
        cache: false,
        success: function(res){
            var data_num = JSON.parse(res);

            var labels = [...Object.keys(data_num[0]), ...Object.keys(data_num[1]), ...Object.keys(data_num[2]), ...Object.keys(data_num[3])];
            var values = [...Object.values(data_num[0]), ...Object.values(data_num[1]), ...Object.values(data_num[2]), ...Object.values(data_num[3])];

            // console.log(labels);
            $('.label-all').text(labels[10]);
            $('.num-all').text(parseInt(values[10])+parseInt(values[11][0]));

            $('.label-bsis').text(labels[8]);
            $('.num-bsis').text(values[8]);

            $('.label-bscrim').text(labels[6]);
            $('.num-bscrim').text(values[6]);

            $('.label-bsed').text(labels[7]);
            $('.num-bsed').text(values[7]);

            $('.label-bsoa').text(labels[9]);
            $('.num-bsoa').text(values[9]);

            $('.label-registerar').text(labels[2]);
            $('.num-registerar').text(values[2]);

            $('.label-saso').text(labels[3]);
            $('.num-saso').text(values[3]);

            $('.label-ssg').text(labels[4]);
            $('.num-ssg').text(values[4]);

            $('.label-admin').text(labels[0]);
            $('.num-admin').text(values[0]);

            $('.label-guidance').text(labels[1]);
            $('.num-guidance').text(values[1]);

            $('.label-beed').text(labels[5]);
            $('.num-beed').text(values[5]);

            $('.num-teller').text(values[11][0]);

        }
    });
};

function table_info(category, usertype, address, add_row, page){
    $.ajax({
        url: '../../controller/Dbadminusermanagement_table.php',
        type: 'POST',
        data: {
            category : category, 
            usertype: usertype, 
            address: address, 
            add_row : add_row,
            page: page
        },
        cache: false, 
        success: function(res){
            $(".table-info").html(res);
        }
    });
};

function edit(id, usertype){
    Swal.fire({
        title: 'Are you sure?',
        text: "You show reset code!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                url: '../../controller/Dbadminusermanagement_reset_pass.php',
                type: 'POST',
                data: {
                    id : id,
                    usertype : usertype
                },
                cache: false, 
                success: function(res){
                    Swal.fire({
                        title: 'Reset password code',
                        text: res,
                        showClass: {
                          popup: 'animate__animated animate__fadeInDown'
                        },
                        hideClass: {
                          popup: 'animate__animated animate__fadeOutUp'
                        }
                      })
                    
                }
            });
          
        }
      });

}

function viewqr(id){
  window.open('../../controller/Dbtellerprintqr.php?teller_id='+id);
}
