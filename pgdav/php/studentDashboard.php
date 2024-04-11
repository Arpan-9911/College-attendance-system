<?php
include "database.php";
session_start();

if(!isset($_SESSION['studentLogged'])){
  header("Location: ../../index.php");
}

$studentName = $_SESSION['studentName'];
$studentRoll = $_SESSION['studentRoll'];
$studentEmail = $_SESSION['studentEmail'];
$studentPhone = $_SESSION['studentPhone'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PGDAV | Student</title>
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
                  <h4 class="font-weight-bold mb-0">STUDENT Dashboard</h4>
                </div>
              </div>
            </div>
            <hr color="black">
          </div>

          <div class="row">


        <?php
        $select = "SELECT subject, SUM(CASE WHEN attendance = 'P' THEN 1 ELSE 0 END) AS presentDays FROM `attendance` WHERE studentName = '$studentName' AND studentRoll = '$studentRoll' GROUP BY subject";
        $result = mysqli_query($conn, $select);
        if (mysqli_num_rows($result) <= 0) {
          echo "<script>alert('No Student Data')</script>";
          echo "<script>window.location.href ='staffDashboard.php';</script>";
        }
        else {
          while ($row = mysqli_fetch_assoc($result)) {
            $subject = $row['subject'];
            $presentDays = $row['presentDays'];
            $selectTotal = "SELECT * FROM `attendance` WHERE studentName = '$studentName' AND studentRoll = '$studentRoll' AND subject = '$subject'";
            $resultTotal = mysqli_query($conn, $selectTotal);
            $totalDays = mysqli_num_rows($resultTotal);
            $percent = number_format(($presentDays*100)/$totalDays,2);
        ?>
          <div class="col-md-4 p-1 stretch-card">
            <div class="card">
              <div class="card-body p-3">
                <div class="d-flex flex-column">
                  <h4 class="mb-2 text-muted"><?php echo strtoupper($subject) ?></h4>
                  <table class="table-bordered">
                    <tr>
                      <td style="font-weight: 600;">Total</td>
                      <td><?php echo $totalDays ?> Days</td>
                    </tr>
                    <tr>
                      <td style="font-weight: 600;">Present</td>
                      <td><?php echo $presentDays ?> Days</td>
                    </tr>
                    <tr>
                      <td style="font-weight: 600;">Percentage</td>
                      <td><?php echo $percent ?> %</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
        <?php
          }
        }
        ?>

          </div>
        </div>
    <!-- content-wrapper ends -->
    <?php include 'footer.php'; ?>