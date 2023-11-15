<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="../../css/interfont.css" />
    <link rel="stylesheet" href="../../css/cashiernav.css" />
    <!-- <title>Document</title> -->
  </head>
  <body>
    <div class="loader"><img src="../../image/loader.gif"></div>    
    <div class="navigation">
      <nav class="header">
        <b>BCC DIGITAL PAYMENT SYSTEM</b>
        <div class="profile">
          <img src="../../image/avatar.jpg" />
          <p>Cashier</p>
        </div>
      </nav>

      <div class="sidebar">
        <ul class="categories-list">
          <li class="categories" id="home">
            <i class="fa-solid fa-house"></i>
            <p class="label">Home</p>
          </li>
          <li class="categories" id="request_info">
            <i class="fa-solid fa-code-pull-request"></i>
            <p class="label">Request</p>
          </li>
          <li class="categories" id="cash_in">
            <i class="fas fa-wallet"></i>
            <p class="label">Cash In</p>
          </li>
          <li class="categories" id="account_balance">
            <i class="fas fa-balance-scale"></i>
            <p class="label">Account Balance</p>
          </li>
          <li class="categories" id="collection">
            <i class="fa-solid fa-money-bill"></i>
            <p class="label">Collection</p>
          </li>
          <li class="categories" id="history">
            <i class="fas fa-history"></i>
            <p class="label">History</p>
          </li>
          <li class="categories" id="logout">
            <i class="fas fa-sign-out-alt"></i>
            <p class="label">Logout</p>
          </li>
        </ul>
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
  <script src="../../js/cashiernav.js"></script>
</html>
