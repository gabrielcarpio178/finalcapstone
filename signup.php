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
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.5/sweetalert2.min.css"
    />    
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/signup.css">
    <title>Register</title>
  </head>
  <body>
    <div class="loader"><img src="image/loader.gif"></div>
    <div class="container">
      
      <div class="row">

        <div class="col col-md-6 forms">
          <div class="signup-form">
            <div class="label-div">
              Sign Up
            </div>
            <form id="signup">
              <div class="row">
                <div class="col-md-6 justify-content-center">
                  <div class="form-group">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname"  placeholder="First Name">      
                  </div>                                    
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname"  placeholder="Last Name">      
                  </div>
                </div>
              </div><!-- end row -->
              <div class="row mt-2">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"  placeholder="Email">      
                  </div>
                </div>                               
              </div><!-- end row -->
              <div class="row mt-2">
                <div class="col-md-12">
                  <div class="form-group has-danger">
                    <label class="form-label" for="phonenumber">Phone Number</label>
                    <input type="number" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone Number">
                    <div class="invalid-feedback" id="message">
                      Sorry, input phone number is to short
                    </div>
                  </div>                                   
                </div> 
              </div><!-- end row -->                           
              <div class="row mt-2">
                <div class="col-lg-6 mt-2">
                  <div class="form-floating">
                    <select class="form-select" id="gender" name="gender" aria-label="Floating label select example">
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="other">Other</option>
                    </select>
                    <label for="gender">Gender</label>
                  </div>                                    
                </div><!-- end col -->
                <div class="col-lg-6 mt-2">
                  <div class="form-floating">
                    <select class="form-select" id="address" name="address" aria-label="Floating label select example">
                      <option value="bago">Bago City</option>
                      <option value="non-bago">Non-Bago</option>
                    </select>
                    <label for="address">Address</label>
                  </div>      
                </div><!-- end col -->                                                                
              </div><!-- end row -->
              <div class="row mt-2">
                  <div class="col-md-12">
                      <div class="form-group">
                <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"  placeholder="Username">      
                    </div>
                  </div> 
              </div><!-- end row -->
              <div class="row mt-2">
                  <div class="col-md-12">
                      <div class="form-group">
                      <label for="password" class="form-label">Password</label>
                      <div class="icon-password">
                        <input type="password" class="form-control" id="password" name="password"  placeholder="Password">      
                        <div class="icon-pass">
                          <i class="fa-solid fa-eye-slash"></i>
                        </div>
                      </div>
                    </div>
                  </div> 
              </div><!-- end row -->
              <div class="row mt-2">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="conpassword" class="form-label">Confirm Password</label>
                    <div class="icon-conpassword">
                      <input type="password" class="form-control" id="conpassword" name="conpassword"  placeholder="Confirm Password">    
                      <div class="icon-conpass">
                        <i class="fa-solid fa-eye-slash"></i>
                      </div>  
                    </div>       
                  </div>
                </div> 
              </div><!-- end row -->
              <div class="row mt-2">
                <div class="col-md-12">
                  <center><button type="submit" class="btn btn-primary" id="submitfirst" value="submit">Sign Up</button></center>
                </div> 
              </div><!-- end row -->
            </form>
          </div>
          <div class="signin">
            <p>Already have an account? <a id="login"><strong>Sign In</strong></a></p>
          </div>
        </div>

        <div class="col col-md-6">
          
          <div class="logo-div">
            <img src="image/icon_1.png" alt="BCC Digital Payment System LOGO">
            <div class="title">
              BCC Digital Payment System
            </div>
          </div>

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
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  ></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="js/signup.js"></script>
  
</html>
