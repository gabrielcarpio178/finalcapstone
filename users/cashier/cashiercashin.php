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
        <div class="label-title">
          Cash In
        </div>
        <div id="search_user" class="search-div mt-2">
          <input type="text" name="search" id="search" placeholder="Search Name Or ID" class="form-control w-25">
        </div>
        <div class="content_display">
          <div class="logo-id" >
            <div class="id-pic">
              <img src="data:image/png;base64,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" alt="" srcset="">
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
                    <th scope="col">User ID</th>
                  </tr>
                </thead>
                <tbody class="table-body">
                  
                </tbody>
              </table>
            </div>
          </div>
          <div class="load_input_amount">

          </div>
        </div>
        

      </div>

    </div>


    <!-- far fa-address-card -->
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