<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, 
user-scalable=no"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/signin.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" />    
    <title>Login</title>
  </head>
  <body>
      <div class="loader"><img src="image/loader.gif"></div>
    <div class="container">
      <div class="row">

        <div class="col col-lg-6">

          <div class="d-flex flex-column align-items-center">
            <div class="title">
              BCC Digital Payment System
            </div>
            <div class="image-div">
              <img src="image/icon_1.png" alt="BCC Digital Payment System LOGO">
            </div>
          </div>    

        </div>

        <div class="col col-lg-6">

          <div class="signin-form">
            <h1 class="label-h1">
              Sign In
            </h1>
            <form id="singin">
              <div class="form-group">
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
                <center>
                  <h5>
                    Don't have account? <strong><a id="signup">Sign Up</a></strong>
                  </h5>
                </center>
                <center><div id="forgotform"> Forgot Account </div></center>
              </div>
            </form>
            
          </div>

          <div class="forgot-form">
            <h1 class="label-h1">
              Forgot Password
            </h1>
            <form id="forgot_form">
              <div class="form-group">
                <label for="forgot" class="form-label">Phone Number:</label>
                <input
                  type="number"
                  class="form-control"
                  id="phone_number"
                  name="forgot"
                  placeholder="Enter Phone Number"
                />
                <div>
                  <center>
                    <button
                      type="submit"
                      class="btn btn-primary mt-2"
                      id="forgot"
                      value="submit"
                    >
                      Send
                    </button>
                  </center>
                </div>
                <div class="mt-2">
                <center>
                  <h5>
                    <strong><div id="login">Sign In</div></strong>
                  </h5>
                </center>
                  <center><div id="resetcode" data-bs-toggle="modal" data-bs-target="#exampleModal"> Use Reset Code </div></center>
                </div>
              </div>  

            </form>

          </div>

        </div>

      </div>
    </div>  
    
    <!-- modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Enter Reset code</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="enter_code">
            <div class="modal-body">
              <input type="number" name="input_code" id="input_code" class="form-control" placeholder="Reset code">
              <span class="message"></span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="close_input_code" data-bs-dismiss="modal">Close</button>
              <button type="sumbit" value="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
        </div>
      </div>
  </div>

  <!-- input password -->

  <div class="modal fade" id="new_password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Enter Reset code</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="enter_code">
            <div class="modal-body">
              <input type="number" name="input_code" id="input_code" class="form-control" placeholder="Reset code">
              <span class="message"></span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="close_input_code" data-bs-dismiss="modal">Close</button>
              <button type="sumbit" value="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
        </div>
      </div>
  </div>

  </body>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/signin.js"></script>
</html>
