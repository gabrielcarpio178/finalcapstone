<?php 
session_start();
require('../../controller/Dbconnection.php');
if(($_SESSION['usertype']!="cashier")){
  if(!isset($_SERVER['HTTP_REFERER'])){
    header('location: ../../index.php');
  exit;
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/cashierrequest.css">
    <title>Require</title>
</head>
<body>
    <div id="nav"></div>
    <div class="contents">

        <div class="fw-bold label-request">Request</div>
        <div class="">Home</div>

        <div class="content-menu mt-3">
          <div class="d-flex flex-row-reverse mb-2">
            <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#payment_rate">Payment Rates</button>
          </div>
          <div class="d-flex flex-row justify-content-around align-self-center content-header">
              <div id="non_bago" class="focus-1 fucos-class">NON-BAGO FEE</div>
              <div id="tor" class="focus-2">TOR</div>
              <div id="cash_out" class="focus-3">CASH OUT</div>
              <div id="certificate" class="focus-4">CERTIFICATE</div>
          </div>

          <div class="table-content">

          </div>
            

        </div>

    </div>
    <!--payment rate modal -->
    <div class="modal fade" id="payment_rate">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Payment Rates</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
            </button>
          </div>
          <div class="modal-body">

            <div class="d-flex gap-3 flex-row-reverse p-2">
              <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_certificate">Add Payment</button>
              <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit_certificate">Edit</button>
            </div> 
            <div class="content-rate p-2">

              <div class="header-rate">
                <div class="d-flex flex-row justify-content-between align-items-center w-75">
                  <div class="rate-label">Request Type</div>
                  <div class="rate-label">Amount</div>
                </div>
              </div>

              <div class="d-flex flex-row gap-2 non-bago-content">
                <div class="d-flex flex-row justify-content-between align-items-center w-75 rate-content">
                  <div class="rate-label">Non Bago Fee</div>
                  <div class="rate-label" id="non_bago_fee"></div>
                </div>
                <div class="d-flex flex-column gap-1 align-items-center dateyear-sem w-25">
                  <div class="year-sem">
                  </div>
                  <div class="d-flex flex-row gap-2 justify-content-between align-items-center month-sem">
                    <div class="school-month">
                      
                    </div>
                    <i class="fa-solid fa-calendar fa-sm"></i>
                  </div>
                  <div class="line w-100"></div>

                  <div class="select_option">
                    <select name="" id="semester-year">
                      <option value="first-semister" id="first-semister">First Sem.</option>
                      <option value="second-semister" id="second-semister">Second Sem.</option>
                    </select>
                  </div>

                </div>
              </div>

              <div class="rate-content-certifications">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-between align-items-center w-75">
                      <div class="rate-label">Certifications</div>
                      <div class="rate-label" id="certificate_show"><i class="fa-solid fa-angle-up"></i></div>
                    </div>

                    <div class="d-flex flex-column gap-2" id="cert-content" style="display: none !important">
                      
                    </div>
                  </div>
              </div>

              

              <div class="rate-content">
                <div class="d-flex flex-row justify-content-between align-items-center w-75">
                  <div class="rate-label">Transcript of Record</div>
                  <div class="rate-label" id="certTCre"></div>
                </div>
              </div>

            </div>

          </div>
        </div>
      </div>
    </div>

  <!--Add payment modal -->
  <div class="modal fade" id="add_certificate">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Payment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
            </button>
          </div>
          <div class="modal-body">

            <form id="addCertificate_submit" class="d-flex flex-column gap-2 p-2">

              <div class="d-flex flex-row justify-content-between addCertificate-label">
                <div class="certificate-name">Payment Name</div>
                <div class="certificate-amount">Amount</div>
                <div></div>
              </div>

              <div class="d-flex flex-column gap-2 p-2" id="input-content">
                <!-- input-content -->
              </div>

              <div class="add_btn w-100">
                <input class="btn btn-success w-100" value="Add row" onclick="addCertificateRow();">
              </div>

              <div class="btn_submit-content">
                <button type="submit" value="submit" class="btn btn-primary w-100" id="submit_inputed">Submit</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>  

  <!--edit payment modal -->
  <div class="modal fade" id="edit_certificate">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Certificate</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">

          <form id="editCertificate_submit" class="d-flex flex-column gap-2 p-2">

            <div class="d-flex flex-row justify-content-between addCertificate-label">
              <div class="certificate-name">Certificate Name</div>
              <div class="certificate-amount">Amount</div>
              <div></div>
            </div>

            <div class="d-flex flex-column gap-2 p-2" id="edit_input-content">
              <!-- input-content -->
            </div>

            <div class="btn_submit-content">
              <button type="submit" value="submit" class="btn btn-primary w-100">Submit</button>
            </div>
          </form>

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
  <script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/bootstrap.bundle.min.js"></script>
  <script src="../../js/cashierrequest.js"></script>
</html>