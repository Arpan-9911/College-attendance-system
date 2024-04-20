<?php
include "database.php";
session_start();

if(!isset($_SESSION['staffLogged'])){
  header("Location: ../../index.php");
}

$staffName = $_SESSION['staffName'];
$staffEmail = $_SESSION['staffEmail'];
$staffPhone = $_SESSION['staffPhone'];
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

  <link rel="stylesheet" href="markAttendance.css">
</head>
<body>
    <?php include "header.php"; ?>

    <?php
    $subject = $_GET['subject'];
    if ($subject == null) {
      header('Location: staffDashboard.php');
    }
    ?>

      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin mb-2">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0">Edit Attendance</h4>
                </div>
              </div>
            </div>
            <hr color="black">
          </div>


          <div class="row">
          <!-- php for showing all the dates on which attendance was marked -->
          <?php
            $select = "SELECT DISTINCT(date) as attendanceDate, period FROM `attendance` WHERE teacherName = '$staffName' AND subject = '$subject' ORDER BY date DESC";
            $result = mysqli_query($conn, $select);
            if ($result) {
              $count = mysqli_num_rows($result);
          ?>
              <div class="col-md-12 p-1 card-stretch">
                <div class="card">
                  <div class="card-body p-3">
                    <p class="card-title text-md-center text-xl-left mb-1"><?php echo $subject ?></p>
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                      <h4 class="mb-0"><?php echo $count ?> Attendance</h4>
                      <i class="ti-book icon-md text-muted mb-0"></i>
                    </div>
                  </div>
                </div>
              </div>
          <?php
              while ($row = mysqli_fetch_array($result)){
          ?>
            <div class="col-md-3 col-6 p-1 stretch-card">
              <div class="card">
                <a class="card-body text-center btn px-4 py-2" href="dateAttendance.php?subject=<?php echo $subject ?>&date=<?php echo $row['attendanceDate'] ?>&period=<?php echo $row['period'] ?>"><?php echo date_format(date_create($row['attendanceDate']), 'd-m-Y'); echo '<br>'.$row['period']; ?></a>
              </div>
            </div>
          <?php
              }
            }
          ?>
          </div>
        </div>
        <?php include 'footer.php'; ?>