<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/cashiercashin.css">
    <title>Cash in</title>

</head>
<body>
    <div id="nav"></div>
    <div class="container-fluid">
      <div class="content">
        <div class="row">
          <div class="col-6 col-md-12" id="main_info">
            <div class="label-title mt-5">
              Cash In
            </div>
            <div id="search_user" class="search-div mt-2">
              <input type="text" name="search" id="search" placeholder="Search Name Or ID" class="form-control w-25">
              <input type="text" name="rfid" id="rfid" class="form-control w-25">
            </div>
            <div class="content_display">
              <div class="logo-id" >
                <div class="id-pic">
                  <i class="fas fa-id-card"></i>
                  <p>Tap ID on Scanner</p>
                </div>
              </div>
              <div class="message"></div>
              <div class="search-table" style="display: none;">
                <div class="table-result">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Department</th>
                        <th scope="col">User ID</th>
                      </tr>
                    </thead>
                    <tbody class="table-body">
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="user-info" style="display: none;">
              <div class="input-amount">
                <label class="label-input" for="input_amount">Input Amount:</label>
                <form id="input">
                  <div class="input-class">
                    <p>₱</p>
                    <input type="number" name="input_amount" id="input_amount" class="form-control">
                  </div>
                  <input type="sumbit" value="Okay" class="btn btn-primary">
                </form>
              </div>
            </div>
          </div>
          <div class="col-6 col-md-4" style="display: none;" id="view_user">
            <div class="profile-user">
              <div class="label-profile">Profile</div>
              <div class="profile-info">
                <img id="profile_image">
                <div class="user-name">
                  <h2 class="name">
                   
                  </h2>
                </div>
                <div class="user_id">
                  
                </div>
                <div class="user-type">
                  
                </div>
              </div>
              <div class="department">
                <label for="department_user" id="department_year">
               
                </label>
                <div class="department-info" id="department_user">
             
                </div>
              </div>
              <div class="phonenumber">
                <label for="phonenumber_user">Phone Number:</label>
                <div class="phonenumber-user" id="phonenumber_user">
                  
                </div>
              </div>
              <div class="address">
                <label for="address_user">Address:</label>
                <div class="addess-user" id="address_user">
                  
                </div>
              </div>
              <div class="balance">
                <b>Balance:</b>
                <b class="balance_amount"></b>
              </div>
              <div class="btn-cancel">
                <center>
                  <button class="btn btn-danger" id="btn_cancel" onclick="cancel()">Cancel</button>
                </center>
              </div>
            </div>
          </div>  
        </div>
      </div>  
    </div>

</body>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  ></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../../js/cashiercashin.js"></script>
</html>