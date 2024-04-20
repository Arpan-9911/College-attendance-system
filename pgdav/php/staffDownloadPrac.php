<?php
include "database.php";
session_start();

if(!isset($_SESSION['staffLogged'])){
  header("Location: ../../index.php");
}

$staffName = $_SESSION['staffName'];
$staffEmail = $_SESSION['staffEmail'];
$staffPhone = $_SESSION['staffPhone'];

$subject = $_GET['subject'];
if ($subject == null) {
    header('Location: staffDashboard.php');
    exit(); // Always exit after header redirects
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PGDAV | Staff</title>
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
                  <h4 class="font-weight-bold mb-0">Download Attendance</h4>
                </div>
              </div>
            </div>
            <hr color="black">
          </div>
          <div class="row d-flex justify-content-center">
            <div class="col-sm-6 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracSem.php?subject=<?php echo $subject ?>&&time=Sem" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; Whole Semester</a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracMonth.php?subject=<?php echo $subject ?>&&time=Jan" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; January</a>
              </div>
            </div>
            <div class="col-sm-4 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracMonth.php?subject=<?php echo $subject ?>&&time=Feb" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; February</a>
              </div>
            </div>
            <div class="col-sm-4 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracMonth.php?subject=<?php echo $subject ?>&&time=Mar" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; March</a>
              </div>
            </div>
            <div class="col-sm-4 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracMonth.php?subject=<?php echo $subject ?>&&time=Apr" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; April</a>
              </div>
            </div>
            <div class="col-sm-4 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracMonth.php?subject=<?php echo $subject ?>&&time=May" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; May</a>
              </div>
            </div>
            <div class="col-sm-4 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracMonth.php?subject=<?php echo $subject ?>&&time=Jun" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; June</a>
              </div>
            </div>
            <div class="col-sm-4 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracMonth.php?subject=<?php echo $subject ?>&&time=Jul" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; July</a>
              </div>
            </div>
            <div class="col-sm-4 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracMonth.php?subject=<?php echo $subject ?>&&time=Aug" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; Aug</a>
              </div>
            </div>
            <div class="col-sm-4 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracMonth.php?subject=<?php echo $subject ?>&&time=Sep" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; September</a>
              </div>
            </div>
            <div class="col-sm-4 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracMonth.php?subject=<?php echo $subject ?>&&time=Oct" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; October</a>
              </div>
            </div>
            <div class="col-sm-4 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracMonth.php?subject=<?php echo $subject ?>&&time=Nov" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; November</a>
              </div>
            </div>
            <div class="col-sm-4 p-md-3 p-1 stretch-card">
              <div class="card">
                <a href="staffDownloadPracMonth.php?subject=<?php echo $subject ?>&&time=Dec" class="btn btn-block btn-primary text-white btn-md"><i class="ti-download menu-icon"></i> &nbsp; December</a>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <?php include 'footer.php'; ?>