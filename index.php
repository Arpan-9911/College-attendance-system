<?php
include "pgdav/php/database.php";
session_start();

if(isset($_SESSION['adminLogged'])){
  header("Location: pgdav/php/adminDashboard.php");
}
elseif(isset($_SESSION['staffLogged'])){
  header("Location: pgdav/php/staffDashboard.php");
}
elseif(isset($_SESSION['studentLogged'])){
  header("Location: pgdav/php/studentDashboard.php");
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
  <link rel="stylesheet" href="pgdav/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="pgdav/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="pgdav/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="pgdav/images/favicon.png" />


  <!-- Extra css -->
  <style>
    #exampleInputPassword{
      position: relative;
    }
    #toggleIcon{
      position: absolute;
      right: 0px;
      top: 8px;
      font-size: 20px;
      z-index: 10;
      cursor: pointer;
      padding: 10px;
    }
  </style>

</head>

<body>

  <?php
  if(isset($_POST['submit-btn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `admin` WHERE adminEmail = '$username' AND adminPassword = '$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
      $_SESSION['adminLogged'] = true;
      $row = mysqli_fetch_assoc($result);
      $_SESSION['adminName'] = $row['adminName'];
      $_SESSION['adminEmail'] = $username;
      $_SESSION['adminPhone'] = $row['adminPhone'];
      header("location: pgdav/php/adminDashboard.php");
    }else{
      $query2 = "SELECT * FROM `staff` WHERE staffEmail = '$username' AND staffPassword = '$password'";
      $result2 = mysqli_query($conn, $query2);

      if(mysqli_num_rows($result2) > 0){
        $_SESSION['staffLogged'] = true;
        $row = mysqli_fetch_assoc($result2);
        $_SESSION['staffName'] = $row['staffName'];
        $_SESSION['staffEmail'] = $username;
        $_SESSION['staffPhone'] = $row['staffPhone'];
        header("location: pgdav/php/staffDashboard.php");
      }else{
        $query3 = "SELECT * FROM `student` WHERE studentEmail = '$username' AND studentPassword = '$password'";
        $result3 = mysqli_query($conn, $query3);

        if(mysqli_num_rows($result3) > 0){
          $_SESSION['studentLogged'] = true;
          $row = mysqli_fetch_assoc($result3);
          $_SESSION['studentName'] = $row['studentName'];
          $_SESSION['studentRoll'] = $row['studentRoll'];
          $_SESSION['studentEmail'] = $username;
          $_SESSION['studentPhone'] = $row['studentPhone'];
          header("location: pgdav/php/studentDashboard.php");
        }else{
          echo "<script>alert('Invalid Username or Password');</script>";
        }
      }
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
                <img src="pgdav/php/uploads/pgdavLogo.jpg" alt="logo" style="height: 80px; width: 80px;">
                <div class="d-flex flex-column align-items-end text-right">
                  <h2 class="h3">PGDAV College</h2>
                  <h4 class="h5">University Of Delhi</h4>
                </div>
              </div>
              <h4>Welcome back!</h4>
              <h6 class="font-weight-light">Happy to see you again!</h6>
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
                <div class="form-group">
                  <label for="exampleInputPassword">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-lock text-primary"></i>
                      </span>
                    </div>
                    <input type="password" name="password" autocomplete="on" class="form-control form-control-lg border-left-0" id="exampleInputPassword" placeholder="Password" required>
                    <i class="ti-lock" id="toggleIcon"></i>                     
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" name="keepMe" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="pgdav/php/forgetPassword.php" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="my-3">
                  <input type="submit" name="submit-btn" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn" value="LOGIN">
                </div>
              </form>
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
  <script src="pgdav/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="pgdav/js/off-canvas.js"></script>
  <script src="pgdav/js/hoverable-collapse.js"></script>
  <script src="pgdav/js/template.js"></script>
  <!-- endinject -->

  <script>
  // Get the input and icon elements
  var inputField = document.getElementById("exampleInputPassword");
  var toggleIcon = document.getElementById("toggleIcon");

  // Function to toggle input type
  toggleIcon.addEventListener("click", function() {
    if (inputField.type === "password") {
      inputField.type = "text";
      toggleIcon.classList.remove("ti-lock");
      toggleIcon.classList.add("ti-eye");
    } else {
      inputField.type = "password";
      toggleIcon.classList.remove("ti-eye");
      toggleIcon.classList.add("ti-lock");
    }
  });
  </script>


</body>
</html>