<?php
include "database.php";
session_start();

if(!isset($_SESSION['staffLogged']) && !isset($_SESSION['studentLogged']) && !isset($_SESSION['adminLogged'])){
  header("Location: ../../index.php");
}
elseif(isset($_SESSION['adminLogged'])){
  $adminName = $_SESSION['adminName'];
  $adminEmail = $_SESSION['adminEmail'];
  $adminPhone = $_SESSION['adminPhone'];
  $selectPass = "SELECT * FROM `admin` WHERE adminEmail = '$adminEmail'";
  $resultPass = mysqli_query($conn, $selectPass);
  $row = mysqli_fetch_array($resultPass);
  $adminPassword = $row['adminPassword'];
}
elseif(isset($_SESSION['staffLogged'])){
  $staffName = $_SESSION['staffName'];
  $staffEmail = $_SESSION['staffEmail'];
  $staffPhone = $_SESSION['staffPhone'];
  $selectPass = "SELECT * FROM `staff` WHERE staffEmail = '$staffEmail'";
  $resultPass = mysqli_query($conn, $selectPass);
  $row = mysqli_fetch_array($resultPass);
  $staffPassword = $row['staffPassword'];
}
elseif(isset($_SESSION['studentLogged'])){
  $studentName = $_SESSION['studentName'];
  $studentRoll = $_SESSION['studentRoll'];
  $studentEmail = $_SESSION['studentEmail'];
  $studentPhone = $_SESSION['studentPhone'];
  $selectPass = "SELECT * FROM `student` WHERE studentEmail = '$studentEmail'";
  $resultPass = mysqli_query($conn, $selectPass);
  $row = mysqli_fetch_array($resultPass);
  $studentPassword = $row['studentPassword'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PGDAV | Profile</title>
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
    <?php include "header.php"; ?>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin mb-2">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0">PROFILE</h4>
                </div>
              </div>
            </div>
            <hr color="black">
          </div>

        <div class="row">
          <?php
          if(isset($_SESSION['adminLogged'])){

            // Update
            if(isset($_POST['admin-btn'])){
              $changedAdminPhone = $_POST['adminPhone'];
              $changedAdminPassword = $_POST['adminPass'];
              $changedSql = "UPDATE `admin` SET adminPhone = '$changedAdminPhone', adminPassword = '$changedAdminPassword' WHERE adminEmail = '$adminEmail'";
              $changedResult = mysqli_query($conn, $changedSql);
              if ($changedResult) {
                echo "<script>alert('Data Updated Successfully')</script>";
                echo "<script>window.location.href ='adminDashboard.php';</script>";
              }
            }
          ?>

          <!-- Display -->
          <form class="pt-0 d-flex flex-wrap align-items-center justify-content-between" method="post">
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputName" class="m-0">Name</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-user text-primary"></i>
                  </span>
                  </div>
                  <input type="text" name="adminName" disabled class="form-control bg-secondary text-white form-control-lg border-left-0" id="exampleInputName" value="<?php echo $adminName ?>" required>
                </div>
            </div>
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputEmail" class="m-0">Email</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-email text-primary"></i>
                  </span>
                  </div>
                  <input type="email" name="adminEmail" disabled class="form-control form-control-lg bg-secondary text-white border-left-0" id="exampleInputEmail" value="<?php echo $adminEmail ?>" required>
                </div>
            </div>
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputPhone" class="m-0">Contact</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-mobile text-primary"></i>
                  </span>
                  </div>
                  <input type="text" name="adminPhone" class="form-control form-control-lg border-left-0" id="exampleInputPhone" value="<?php echo $adminPhone ?>" required>
                </div>
            </div>
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputPass" class="m-0">Password</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-lock text-primary"></i>
                  </span>
                  </div>
                  <input type="text" name="adminPass" class="form-control form-control-lg border-left-0" id="exampleInputPass" value="<?php echo $adminPassword ?>" required>
                </div>
            </div>
            <div class="my-3 col-12">
              <input type="submit" name="admin-btn" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn" value="UPDATE">
            </div>
          </form>
          <?php
          }


          elseif(isset($_SESSION['staffLogged'])){

            // Update
            if(isset($_POST['staff-btn'])){
              $changedStaffPhone = $_POST['staffPhone'];
              $changedStaffPassword = $_POST['staffPass'];
              $changedSql = "UPDATE `staff` SET staffPhone = '$changedStaffPhone', staffPassword = '$changedStaffPassword' WHERE staffEmail = '$staffEmail'";
              $changedResult = mysqli_query($conn, $changedSql);
              if ($changedResult) {
                echo "<script>alert('Data Updated Successfully')</script>";
                echo "<script>window.location.href ='staffDashboard.php';</script>";
              }
            }
          ?>

          <!-- Display -->
          <form class="pt-0 d-flex flex-wrap align-items-center justify-content-between" method="post">
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputName" class="m-0">Name</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-user text-primary"></i>
                  </span>
                  </div>
                  <input type="text" name="staffName" disabled class="form-control bg-secondary text-white form-control-lg border-left-0" id="exampleInputName" value="<?php echo $staffName ?>" required>
                </div>
            </div>
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputEmail" class="m-0">Email</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-email text-primary"></i>
                  </span>
                  </div>
                  <input type="email" name="staffEmail" disabled class="form-control form-control-lg bg-secondary text-white border-left-0" id="exampleInputEmail" value="<?php echo $staffEmail ?>" required>
                </div>
            </div>
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputPhone" class="m-0">Contact</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-mobile text-primary"></i>
                  </span>
                  </div>
                  <input type="text" name="staffPhone" class="form-control form-control-lg border-left-0" id="exampleInputPhone" value="<?php echo $staffPhone ?>" required>
                </div>
            </div>
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputPass" class="m-0">Password</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-lock text-primary"></i>
                  </span>
                  </div>
                  <input type="text" name="staffPass" class="form-control form-control-lg border-left-0" id="exampleInputPass" value="<?php echo $staffPassword ?>" required>
                </div>
            </div>
            <div class="my-3 col-12">
              <input type="submit" name="staff-btn" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn" value="UPDATE">
            </div>
          </form>
          <?php
          }

          elseif(isset($_SESSION['studentLogged'])){
          ?>
            <div class="form-group col-md-6 col-12 mb-2">
              <label for="exampleInputName" class="m-0">Name</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-user text-primary"></i>
                  </span>
                </div>
                <input type="text" name="username" disabled class="form-control bg-secondary text-white form-control-lg border-left-0" id="exampleInputName" value="<?php echo $studentName ?>">
              </div>
            </div>
            <div class="form-group col-md-6 col-12 mb-2">
              <label for="exampleInputRoll" class="m-0">College Roll No.</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-user text-primary"></i>
                  </span>
                </div>
                <input type="text" name="username" disabled class="form-control bg-secondary text-white form-control-lg border-left-0" id="exampleInputRoll" value="<?php echo $studentRoll ?>">
              </div>
            </div>
            <div class="form-group col-md-6 col-12 mb-2">
              <label for="exampleInputEmail" class="m-0">Email</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-email text-primary"></i>
                  </span>
                </div>
                <input type="email" name="email" disabled class="form-control form-control-lg bg-secondary text-white border-left-0" id="exampleInputEmail" value="<?php echo $studentEmail ?>">
              </div>
            </div>
            <div class="form-group col-md-6 col-12 mb-2">
              <label for="exampleInputPhone" class="m-0">Contact</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-mobile text-primary"></i>
                  </span>
                </div>
                <input type="text" name="phone" disabled class="form-control form-control-lg bg-secondary text-white border-left-0" id="exampleInputPhone" value="<?php echo $studentPhone ?>">
              </div>
            </div>
            <div class="form-group col-md-6 col-12 mb-2">
              <label for="exampleInputPass" class="m-0">Password</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-lock text-primary"></i>
                  </span>
                </div>
                <input type="text" name="pass" disabled class="form-control form-control-lg bg-secondary text-white border-left-0" id="exampleInputPass" value="<?php echo $studentPassword ?>">
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
        <!-- content-wrapper ends -->
        <?php include 'footer.php'; ?>