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
                  <h4 class="font-weight-bold mb-0">View Attendance</h4>
                </div>
              </div>
            </div>
            <hr color="black">
          </div>

        <div class="row">


          <!-- displaying overall attendance teaken by teacher -->
          <?php
          $theory1 = "SELECT COUNT(DISTINCT DATE(date)) AS theory_1 FROM `attendance` WHERE teacherName = '$staffName' AND subject = '$subject' AND period = 'Theory-1'";
          $resultTheory1 = mysqli_query($conn, $theory1);
          $theory2 = "SELECT COUNT(DISTINCT DATE(date)) AS theory_2 FROM `attendance` WHERE teacherName = '$staffName' AND subject = '$subject' AND period = 'Theory-2'";
          $resultTheory2 = mysqli_query($conn, $theory2);
          $prac1 = "SELECT COUNT(DISTINCT DATE(date)) AS prac_1 FROM `attendance` WHERE teacherName = '$staffName' AND subject = '$subject' AND period = 'Prac/Tut-1'";
          $resultPrac1 = mysqli_query($conn, $prac1);
          $prac2 = "SELECT COUNT(DISTINCT DATE(date)) AS prac_2 FROM `attendance` WHERE teacherName = '$staffName' AND subject = '$subject' AND period = 'Prac/Tut-2'";
          $resultPrac2 = mysqli_query($conn, $prac2);
          if ($resultTheory1 AND $resultTheory2 AND $resultPrac1 AND $resultPrac2) {
            $rowTheory1 = mysqli_fetch_assoc($resultTheory1);
            $countTheory1 = $rowTheory1['theory_1'];
            $rowTheory2 = mysqli_fetch_assoc($resultTheory2);
            $countTheory2 = $rowTheory2['theory_2'];
            $countTheory = $countTheory1+$countTheory2;
            $rowPrac1 = mysqli_fetch_assoc($resultPrac1);
            $countPrac1 = $rowPrac1['prac_1'];
            $rowPrac2 = mysqli_fetch_assoc($resultPrac2);
            $countPrac2 = $rowPrac2['prac_2'];
            $countPrac = $countPrac1+$countPrac2;
          ?>
            <div class="col-md-12 p-1 card-stretch">
              <div class="card">
                <div class="card-body p-3">
                  <p class="card-title text-md-center text-xl-left mb-1"><?php echo $subject ?></p>
                  <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                      <h4 class="text-danger mb-0">Theory</h4>
                      <h4 class="text-muted mb-0">Total: <?php echo $countTheory ?> Days</h4>
                    </div>
                    <div>
                      <h4 class="text-danger mb-0">Prac/Tut</h4>
                      <h4 class="text-muted mb-0">Total: <?php echo $countPrac ?> Days</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
          else {
          ?>
            echo "<script>alert('Error occurred while fetching data');</script>";
            echo "<script>window.location.href ='staffDashboard.php';</script>";
          <?php
          }
          ?>


          <!-- displaying total attendance attended by student -->
          <?php
          $studentQuery1 = "SELECT studentName, studentRoll, SUM(CASE WHEN attendance = 'P' THEN 1 ELSE 0 END) AS presentDays1 FROM `attendance` WHERE teacherName = '$staffName' AND subject = '$subject' AND period IN ('Theory-1', 'Theory-2') GROUP BY studentName, studentRoll ORDER BY studentRoll ASC";
          $studentResult1 = mysqli_query($conn, $studentQuery1);
          $studentQuery2 = "SELECT studentName, studentRoll, SUM(CASE WHEN attendance = 'P' THEN 1 ELSE 0 END) AS presentDays3 FROM `attendance` WHERE teacherName = '$staffName' AND subject = '$subject' AND period IN ('Prac/Tut-1', 'Prac/Tut-2') GROUP BY studentName, studentRoll ORDER BY studentRoll ASC";
          $studentResult2 = mysqli_query($conn, $studentQuery2);

          if ($studentResult1 && mysqli_num_rows($studentResult1) > 0 && $studentResult2) {
            while ($row1 = mysqli_fetch_assoc($studentResult1)) {
              $row2 = mysqli_fetch_assoc($studentResult2);
              $presentCountTheory = isset($row1['presentDays1']) ? $row1['presentDays1'] : 0;
              $presentCountPrac = isset($row2['presentDays3']) ? $row2['presentDays3'] : 0;
          ?>
              <div class="col-md-6 p-1 stretch-card">
                <div class="card">
                  <div class="card-body p-3">
                    <p class="card-title text-md-center text-xl-left mb-1"><?php echo $row1['studentName'] . '-' . $row1['studentRoll'] ?></p>
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                      <div>
                        <h5 class="text-danger mb-0">Theory</h5>
                        <h5 class="mb-0 text-muted">Present: <?php echo $presentCountTheory ?> Days</h5>
                        <h5 class="mb-0 text-muted">Percent: <?php echo ($countTheory > 0 ? number_format(($presentCountTheory * 100) / $countTheory, 2) : '0.00'); ?>%</h5>
                      </div>
                      <div>
                        <h5 class="text-danger mb-0">Prac/Tut</h5>
                        <h5 class="mb-0 text-muted">Present: <?php echo $presentCountPrac ?> Days</h5>
                        <h5 class="mb-0 text-muted">Percent: <?php echo ($countPrac > 0 ? number_format(($presentCountPrac * 100) / $countPrac, 2) : '0.00'); ?>%</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php
              }
          }
          elseif ($studentResult1 && mysqli_num_rows($studentResult1) == 0 && $studentResult2) {
            while ($row2 = mysqli_fetch_assoc($studentResult2)) {
              $row1 = mysqli_fetch_assoc($studentResult1);
              $presentCountPrac = isset($row2['presentDays3']) ? $row2['presentDays3'] : 0;
          ?>
              <div class="col-md-6 p-1 stretch-card">
                <div class="card">
                  <div class="card-body p-3">
                    <p class="card-title text-md-center text-xl-left mb-1"><?php echo $row2['studentName'] . '-' . $row2['studentRoll'] ?></p>
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                      <div>
                        <h5 class="text-danger mb-0">Theory</h5>
                        <h5 class="mb-0 text-muted">Present: 0 Days</h5>
                        <h5 class="mb-0 text-muted">Percent: 0.00 %</h5>
                      </div>
                      <div>
                        <h5 class="text-danger mb-0">Prac/Tut</h5>
                        <h5 class="mb-0 text-muted">Present: <?php echo $presentCountPrac ?> Days</h5>
                        <h5 class="mb-0 text-muted">Percent: <?php echo ($countPrac > 0 ? number_format(($presentCountPrac * 100) / $countPrac, 2) : '0.00'); ?>%</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <?php
              }
          } else {
              echo "<script>alert('Error occurred while fetching data');</script>";
              echo "<script>window.location.href ='staffDashboard.php';</script>";
          }
          ?>

        </div>
      </div>
      <!-- content-wrapper ends -->
      <?php include 'footer.php'; ?>