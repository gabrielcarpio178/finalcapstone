let category = 'all';
let usertype = 'user_buyer';
let address = 'all';
let search = '';
$(document).ready(function(){
    table_info(category, usertype, address, search);
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
        var email = $("#email").val();
        var storename = $("#storename").val();
        var gender = $("#gender").val();
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
          gender == null||
          username == ""||
          email == ""
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
                  title: "Successfully Added!",
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
    $(".txt, #filter, .checkbox").each(function() {
        $(this).change(function(){
          address = $(this).val();
          table_info(category, usertype, address, search);
        }); 
    });


    $(".data").on('click', function(){
        category = $(this).attr('id');  
        usertype = $(this).attr('name');
        table_info(category, usertype, address, search);
    });

    $('#search').on('keyup', function(){
      var search = $(this).val();
      table_info(category, usertype, address, search);
    });

    

});
function table_info(category, usertype, address, search){
  $.ajax({
    url: '../../controller/Dbadminusermanagement_table.php',
    type: 'POST',
    data: {
      category : category,
      usertype : usertype,
      address : address,
      search : search
    },
    cache: false,
    success: function(res){
      var result_table = JSON.parse(res);
      if(usertype=='user_buyer'){
        if(result_table.length!=0){
          table_content = `
          <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">Department</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone #</th>
                    <th scope="col">Address</th>
                   
                </tr>
            </thead>
            <tbody id="tbody_data">
              
            </tbody>
          </table>
          `; 
          //<th scope="col">Reset Pass.</th>
          $(".table-info").html(table_content);
          tbody = '';
          for(let i = 0; i<result_table.length; i++){
            tbody += `
            <tr>
              <td>${(result_table[i]).department}</td>
              <td>${(result_table[i]).name}</td>
              <td>${(result_table[i]).email}</td>
              <td>${(result_table[i]).phonenumber}</td>
              <td>${(result_table[i]).address}</td>
            </tr>
            `
          }
          $("#tbody_data").html(tbody);
          //<td class="action" onclick="edit('${(result_table[i]).user_id}', 'buyer')"><i class="fas fa-edit" style="#282828de"></td>
        }else{
          $(".table-info").text('No Record');
        }
        $("#filter").show();
      }else{
        if(result_table.length!=0){
          table_content = `
          <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th scope="col">Store Name</th>
                    <th scope="col">Owner Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone #</th>
                    
                </tr>
            </thead>
            <tbody id="tbody_data">
              
            </tbody>
          </table>
          `;
          //<th scope="col">View QR</th>
          $(".table-info").html(table_content);
          tbody = '';
          for(let i = 0; i<result_table.length; i++){
            tbody += `
            <tr>
              <td>${(result_table[i]).store_name}</td>
              <td>${(result_table[i]).name}</td>
              <td>${(result_table[i]).email}</td>
              <td>${(result_table[i]).phonenumber_teller}</td>
              
            </tr>
            `
          }
          $("#tbody_data").html(tbody);
          // <td class="action" onclick="viewqr('${(result_table[i]).teller_id}')"><i class="fa-solid fa-eye"></i></td>
        }else{
          $(".table-info").text('No Record');
        }
        $("#filter").hide();
      }
    }
  })
}
function num_of_data(){
    $.ajax({
        url: '../../controller/Dbadminusermanagement_num_of_data.php',
        type: 'POST',
        data: {info: 'info'},
        cache: false,
        success: function(res){
          var data_num = JSON.parse(res);
          $('.num-all').text(parseInt(data_num[2]));
          $('.num-bsis').text(data_num[0].BSIS);
          $('.num-bscrim').text(data_num[0].BSCrim);
          $('.num-bsed').text(data_num[0].BSED);
          $('.num-bsoa').text(data_num[0].BSOA);
          $('.num-registerar').text(data_num[0].Registrar);
          $('.num-saso').text(data_num[0].SASO);
          $('.num-ssg').text(data_num[0].SSG);
          $('.num-admin').text(data_num[0].Admin);
          $('.num-guidance').text(data_num[0].Guidance);
          $('.num-beed').text(data_num[0].BEED);
          $('.num-faculty').text(data_num[0].Faculty);
          $('.num-teller').text(data_num[3]);
          $('.num-abe').text(data_num[0].ABE);
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
  window.open('../../pdf.php?teller_id='+id);
}
