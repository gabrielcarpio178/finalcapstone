<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, 
user-scalable=no"
    />
    <!-- <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    /> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/fontawesome.css">
    <link rel="stylesheet" href="fontawesome-free-6.4.2-web/css/all.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/signin.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />    
    <title>Sign In</title>
  </head>
  <body>
      <div class="loader"><img src="image/loader.gif"></div>
    <div class="container">
      <div class="row">

        <div class="col-12 col-lg-6">

          <div class="d-flex flex-column gap-lg-1 gap-2 align-items-center">
            <div class="title">
              BCC Digital Payment System
            </div>
            <div class="image-div">
              <img src="image/icon_1.png" alt="BCC Digital Payment System LOGO">
            </div>
          </div>    

        </div>

        <div class="col-12 col-lg-6">

          <div class="signin-form">
            <h1 class="label-h1">
              Sign in
            </h1>
            <form id="singin">
              <div class="form-group mt-4">
                <label for="username" class="form-label">Username</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  name="username"
                  placeholder="Username"
                />
              </div>
              <div class="form-group">
                <label for="password" class="form-label">Password</label>

                <div class="icon-password">
                  <input
                  type="password"
                  class="form-control"
                  id="password"
                  name="password"
                  placeholder="Password"
                  />
                  <div class="icon-pass">
                  <i class="fa-solid fa-eye-slash"></i>
                  </div>
                </div>
                
              </div>

              <div>
                <center>
                  <button
                    type="submit"
                    class="btn btn-primary mt-2"
                    id="signin"
                    value="submit"
                  >
                    Sign in
                  </button>
                </center>
              </div>
              <div class="mt-2">
                <center><div id="forgotform"> Forgot Account? </div></center>
              </div>
            </form>
            
          </div>
        </div>

      </div>
    </div>  
    
  </body>
  <!-- <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  ></script> -->
<script src="js/jquery.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/signin.js"></script>
</html>
