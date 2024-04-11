<?php
include "database.php";
session_start();

if(isset($_SESSION['adminLogged'])){
  header("Location: adminDashboard.php");
}
elseif(isset($_SESSION['staffLogged'])){
  header("Location: staffDashboard.php");
}
elseif(isset($_SESSION['studentLogged'])){
  header("Location: studentDashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PGDAV | Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>


  <?php
  // Include PHPMailer's autoloader
  require '../../vendor/autoload.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  if(isset($_POST['submit-btn'])){
    $email = $_POST['username'];
    $select = "SELECT * FROM `admin` WHERE adminEmail = '$email'";
    $result = mysqli_query($conn, $select);
    if(mysqli_num_rows($result) == 1){
      $row = mysqli_fetch_assoc($result);
      $password = $row['adminPassword'];
    }
    else{
      $select2 = "SELECT * FROM `staff` WHERE staffEmail = '$email'";
      $result2 = mysqli_query($conn, $select2);
      if(mysqli_num_rows($result2) == 1){
        $row = mysqli_fetch_assoc($result2);
        $password = $row['staffPassword'];
      }
      else{
        $select3 = "SELECT * FROM `student` WHERE studentEmail = '$email'";
        $result3 = mysqli_query($conn, $select3);
        if(mysqli_num_rows($result3) == 1){
          $row = mysqli_fetch_assoc($result3);
          $password = $row['studentPassword'];
        }
      }
    }
    if(isset($password)){

      // Create a new PHPMailer instance
      $mail = new PHPMailer(true);

      try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'arpanks1263@gmail.com';
        $mail->Password   = 'smgbrfwbptragrwi';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('arpanks1263@gmail.com', 'Arpan Kumar');
        $mail->addAddress($email, '');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'PGDAV';
        $mail->Body = 'Your password for login to PGDAV Attedance-website is <b>' . $password .'</b>';

        // Send email
        $mail->send();
        $message = 'Message has been sent on your email address.';
      } catch (Exception $e) {
        $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}.";
      }
    }
    else{
      $error = 'This email is not resistered.';
    }
  }
?>





  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo d-flex align-items-center justify-content-between">
                <img src="uploads/pgdavLogo.jpg" alt="logo" style="height: 80px; width: 80px;">
                <div class="d-flex flex-column align-items-end text-right">
                  <h2 class="h3">PGDAV College</h2>
                  <h4 class="h5">University Of Delhi</h4>
                </div>
              </div>
              <h4>Don't Worry!</h4>
              <h6 class="font-weight-light">We can solve your problem!</h6>
              <form class="pt-3" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail">Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                      </div>
                      <input type="email" name="username" autocomplete="on" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Email" required>
                    </div>
                </div>
                <div class="my-3">
                  <input type="submit" name="submit-btn" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn" value="SEND">
                </div>
                <div class="text-center mt-4 font-weight-light">
                </div>
              </form>
              <div class="mt-4 font-weight-light">
                <?php
                if(isset($message)){
  ?>
                <h6 class="text-muted mb-2"><?php echo strtoupper($message) ?></h6>
  <?php
                }
                elseif(isset($error)){
  ?>
                <h6 class="text-danger mb-2"><?php echo strtoupper($error) ?></h6>
  <?php
                }
                ?>
                <a href="../../index.php" class="btn btn-block btn-success text-white font-weight-medium auth-form-btn"><i class="ti-hand-point-left"></i> &nbsp; LOGIN</a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; <?php echo date("Y") ?>  All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <!-- endinject -->
</body>

</html>
