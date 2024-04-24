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
    <!-- partial:partials/_navbar.html -->
  <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <img src="uploads/pgdavLogo.jpg" alt="LOGO" class="menu-icon" style="width: 40px; height:40px">
      <a class="navbar-brand brand-logo me-5 mx-2" href="">PGDAV(M)</a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="ti-view-list"></span>
      </button>
      <div class="navbar-nav navbar-nav-right">
        <div class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown" id="profileDropdown">
            Hi, <?php echo $staffName ?>
          </a>
        </div>
      </div>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="ti-view-list"></span>
      </button>
    </div>
  </nav><!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas bg-white card" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="staffDashboard.php">
            <i class="ti-shield menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="staffDownload.php">
            <i class="ti-download menu-icon"></i>
            <span class="menu-title">Download Attendance</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="staffFreeze.php">
            <i class="ti-save menu-icon"></i>
            <span class="menu-title">Freeze Attendance</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">
            <i class="ti-user menu-icon"></i>
            <span class="menu-title">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <i class="ti-power-off menu-icon"></i>
            <span class="menu-title">Logout</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin mb-2">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h4 class="font-weight-bold mb-0">Mark Attendance</h4>
              </div>
            </div>
          </div>
          <hr color="black">
        </div>

          <?php
          $subject = $_GET['subject'];
          if ($subject == null) {
            header('Location: staffDashboard.php');
          }
          ?>

          <!-- php for submitting attendance -->
          <?php
          if(isset($_POST['submit'])){
            $studentNames = $_POST['studentName'];
            $studentRolls = $_POST['studentRoll'];
            $studentSems = $_POST['studentSem'];
            $date = $_POST['date'];
            $period = $_POST['period'];
            // Checking for already submitted or not
            $sel = "SELECT * FROM `attendance` WHERE teacherName = '$staffName' AND date = '$date' AND subject = '$subject' AND period = '$period'";
            $res = mysqli_query($conn, $sel);
            if(mysqli_num_rows($res) == 0){
              foreach($studentRolls as $studentRoll){
                $studentName = $studentNames[$studentRoll];
                $studentSem = $studentSems[$studentRoll];
                $attendance = isset($_POST['attendance'][$studentRoll]) ? "P" : "A" ;
                // Preventing duplicate entries
                $select = "SELECT * FROM `attendance` WHERE teacherName = '$staffName' AND date = '$date' AND period = '$period' AND subject = '$subject' AND studentName = '$studentName' AND studentRoll = '$studentRoll'";
                $resultSelect = mysqli_query($conn, $select);
                if(mysqli_num_rows($resultSelect) == 0){
                  // Inserting attendance
                  $insert = "INSERT INTO `attendance` (teacherName, subject, studentName, studentRoll, studentSem, date, period, attendance) VALUES ('$staffName', '$subject', '$studentName', '$studentRoll', '$studentSem', '$date', '$period', '$attendance')";
                  $result = mysqli_query($conn, $insert);
                }
              }
              echo "<script>alert('Attendance Added Successfully')</script>";
              echo "<script>window.location.href ='staffDashboard.php';</script>";
            }
            else{
              echo "<script>alert('Attendance For Today Already Added')</script>";
              echo "<script>window.location.href ='staffDashboard.php';</script>";
            }
          }
          ?>


          <!-- php for selecting students opted for the subject -->
          <?php

          if(isset($_POST['copy-btn'])){
            $date = $_POST['date'];
            $period = $_POST['period'];
            $sql = "SELECT * FROM `attendance` WHERE subject = '$subject' AND date = '$date' AND period = '$period' ORDER BY studentRoll ASC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) <= 0) {
              echo "<script>alert('No Student Data')</script>";
              echo "<script>window.location.href = 'markAttendance.php?subject={$subject}';</script>";
            }
            else {
          ?>
          <form method="post">
            <div class="fixed-col">
              <input type="text" name="subject" value="<?php echo $subject ?>" readonly>
              <input type="date" name="date" value="<?php echo $date ?>">
              <select name="period">
                <option value="Theory-1">Theory-1</option>
                <option value="Theory-2">Theory-2</option>
                <option value="Prac/Tut-1">Prac/Tut-1</option>
                <option value="Prac/Tut-2">Prac/Tut-2</option>
              </select>
            </div>
            <div class="copy">
              <input type="submit" name="copy-btn" value="Copy Attendance">
            </div>
            <table>
              <tr>
                <th>Student</th>
                <th>Roll No.</th>
                <th>Semester</th>
                <th>P/A</th>
              </tr>
              <?php
                while ($row = mysqli_fetch_array($result)){
              ?>
              <tr>
                <td><input type="text" name="studentName[<?php echo $row['studentRoll'] ?>]" value="<?php echo $row['studentName'] ?>" readonly></td>
                <td><input type="text" name="studentRoll[]" value="<?php echo $row['studentRoll'] ?>" readonly></td>
                <td><input type="text" name="studentSem[<?php echo $row['studentRoll'] ?>]" value="<?php echo $row['studentSem'] ?>" readonly></td>
                <td><input type='checkbox' name="attendance[<?php echo $row['studentRoll'] ?>]" <?php if($row['attendance'] == 'P') echo "checked" ?>></td>
              </tr>
              <?php
                  }
              ?>
            </table>
            <input type='submit' name='submit' value='Submit Attendance' class="submit">
          </form>
          <?php
            }
          }
          else{
            $sql = "SELECT * FROM `studentsubjects` WHERE (subject1 = '$subject' OR subject2 = '$subject' OR subject3 = '$subject' OR subject4 = '$subject' OR subject5 = '$subject' OR subject6 = '$subject' OR subject7 = '$subject') ORDER BY studentRoll ASC";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) <= 0) {
              echo "<script>alert('No Student Data')</script>";
              echo "<script>window.location.href = 'staffDashboard.php';</script>";
            }
            else {
          ?>
          <form method="post">
            <div class="fixed-col">
              <input type="text" name="subject" value="<?php echo $subject ?>" readonly>
              <input type="date" name="date" value="<?php echo date("Y-m-d") ?>">
              <select name="period">
                <option value="Theory-1">Theory-1</option>
                <option value="Theory-2">Theory-2</option>
                <option value="Prac/Tut-1">Prac/Tut-1</option>
                <option value="Prac/Tut-2">Prac/Tut-2</option>
              </select>
            </div>

            <div class="copy">
              <input type="submit" name="copy-btn" value="Copy Attendance">
            </div>

            <table>
              <tr>
                <th>Student</th>
                <th>Roll No.</th>
                <th>Semester</th>
                <th>P/A</th>
              </tr>
              <?php
                  while ($row = mysqli_fetch_array($result)){
              ?>
              <tr>
                <td><input type="text" name="studentName[<?php echo $row['studentRoll'] ?>]" value="<?php echo $row['studentName'] ?>" readonly></td>
                <td><input type="text" name="studentRoll[]" value="<?php echo $row['studentRoll'] ?>" readonly></td>
                <td><input type="text" name="studentSem[<?php echo $row['studentRoll'] ?>]" value="<?php echo $row['studentSem'] ?>" readonly></td>
                <td><input type='checkbox' name="attendance[<?php echo $row['studentRoll'] ?>]" value='Present'></td>
              </tr>
              <?php
                    }
              ?>
            </table>
            <input type='submit' name='submit' value='Submit Attendance' class="submit">
          </form>
          <?php
            }
          }
          ?>
        </div>
      <!-- partial:partials/_footer.html -->
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
          <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © PGDAV College</span>
        </div>
      </footer>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  

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