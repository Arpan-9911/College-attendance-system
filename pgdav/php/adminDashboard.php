<?php
include "database.php";
session_start();

if(!isset($_SESSION['adminLogged'])){
  header("Location: ../../index.php");
}

$adminName = $_SESSION['adminName'];
$adminEmail = $_SESSION['adminEmail'];
$adminPhone = $_SESSION['adminPhone'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PGDAV | Admin</title>
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
                  <h4 class="font-weight-bold mb-0">ADMIN Dashboard</h4>
                </div>
              </div>
            </div>
            <hr color="black">
          </div>

          <!-- Total Teachers -->
          <?php
          $teacher = "SELECT * FROM `teachertimetable`";
          $resultTeacher = mysqli_query($conn, $teacher);
          $countTeacher = mysqli_num_rows($resultTeacher);
          ?>

          <!-- Total Students -->
          <?php
          $student1 = "SELECT * FROM `studentsubjects` WHERE studentSem = 1";
          $resultStudent1 = mysqli_query($conn, $student1);
          $countStudent1 = mysqli_num_rows($resultStudent1);

          $student2 = "SELECT * FROM `studentsubjects` WHERE studentSem = 2";
          $resultStudent2 = mysqli_query($conn, $student2);
          $countStudent2 = mysqli_num_rows($resultStudent2);

          $student3 = "SELECT * FROM `studentsubjects` WHERE studentSem = 3";
          $resultStudent3 = mysqli_query($conn, $student3);
          $countStudent3 = mysqli_num_rows($resultStudent3);

          $student4 = "SELECT * FROM `studentsubjects` WHERE studentSem = 4";
          $resultStudent4 = mysqli_query($conn, $student4);
          $countStudent4 = mysqli_num_rows($resultStudent4);

          $student5 = "SELECT * FROM `studentsubjects` WHERE studentSem = 5";
          $resultStudent5 = mysqli_query($conn, $student5);
          $countStudent5 = mysqli_num_rows($resultStudent5);

          $student6 = "SELECT * FROM `studentsubjects` WHERE studentSem = 6";
          $resultStudent6 = mysqli_query($conn, $student6);
          $countStudent6 = mysqli_num_rows($resultStudent6);

          $student7 = "SELECT * FROM `studentsubjects` WHERE studentSem = 7";
          $resultStudent7 = mysqli_query($conn, $student7);
          $countStudent7 = mysqli_num_rows($resultStudent7);

          $student8 = "SELECT * FROM `studentsubjects` WHERE studentSem = 8";
          $resultStudent8 = mysqli_query($conn, $student8);
          $countStudent8 = mysqli_num_rows($resultStudent8);

          $totalStudent = $countStudent1 + $countStudent2 + $countStudent3 + $countStudent4 + $countStudent5 + $countStudent6 + $countStudent7 + $countStudent8;
          ?>



          <div class="row">
            <div class="col-md-6 p-md-3 p-1 stretch-card">
              <div class="card">
                <div class="card-body p-3">
                  <p class="card-title text-md-center text-xl-left mb-1">Total Teachers</p>
                  <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0"><?php echo $countTeacher ?> Teachers</h6>
                    <i class="ti-user icon-sm text-muted mb-0"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6 p-md-3 p-1 stretch-card">
              <div class="card">
                <div class="card-body p-3">
                  <p class="card-title text-md-center text-xl-left mb-1">Total Students</p>
                  <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0"><?php echo $totalStudent ?> Students</h6>
                    <i class="ti-user icon-sm text-muted mb-0"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 p-md-3 p-1 stretch-card">
              <div class="card">
                <div class="card-body p-3">
                  <p class="card-title text-md-center text-xl-left mb-1">Semester-1</p>
                  <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0"><?php echo $countStudent1 ?> Students</h6>
                    <i class="ti-user icon-sm text-muted mb-0"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 p-md-3 p-1 stretch-card">
              <div class="card">
              <div class="card-body p-3">
                  <p class="card-title text-md-center text-xl-left mb-1">Semester-2</p>
                  <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0"><?php echo $countStudent2 ?> Students</h6>
                    <i class="ti-user icon-sm text-muted mb-0"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 p-md-3 p-1 stretch-card">
              <div class="card">
                <div class="card-body p-3">
                  <p class="card-title text-md-center text-xl-left mb-1">Semester-3</p>
                  <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0"><?php echo $countStudent3 ?> Students</h6>
                    <i class="ti-user icon-sm text-muted mb-0"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 p-md-3 p-1 stretch-card">
              <div class="card">
              <div class="card-body p-3">
                  <p class="card-title text-md-center text-xl-left mb-1">Semester-4</p>
                  <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0"><?php echo $countStudent4 ?> Students</h6>
                    <i class="ti-user icon-sm text-muted mb-0"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 p-md-3 p-1 stretch-card">
              <div class="card">
              <div class="card-body p-3">
                  <p class="card-title text-md-center text-xl-left mb-1">Semester-5</p>
                  <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0"><?php echo $countStudent5 ?> Students</h6>
                    <i class="ti-user icon-sm text-muted mb-0"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 p-md-3 p-1 stretch-card">
              <div class="card">
              <div class="card-body p-3">
                  <p class="card-title text-md-center text-xl-left mb-1">Semester-6</p>
                  <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0"><?php echo $countStudent6 ?> Students</h6>
                    <i class="ti-user icon-sm text-muted mb-0"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-3 p-md-3 p-1 stretch-card">
              <div class="card">
              <div class="card-body p-3">
                  <p class="card-title text-md-center text-xl-left mb-1">Semester-7</p>
                  <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0"><?php echo $countStudent7 ?> Students</h6>
                    <i class="ti-user icon-sm text-muted mb-0"></i>
                  </div>  
                </div>
              </div>
            </div>
            <div class="col-md-3 p-md-3 p-1 stretch-card">
              <div class="card">
              <div class="card-body p-3">
                  <p class="card-title text-md-center text-xl-left mb-1">Semester-8</p>
                  <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h6 class="mb-0"><?php echo $countStudent8 ?> Students</h6>
                    <i class="ti-user icon-sm text-muted mb-0"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <?php include 'footer.php'; ?>