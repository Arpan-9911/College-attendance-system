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
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin mb-2">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="font-weight-bold mb-0">STAFF Dashboard</h4>
                </div>
              </div>
            </div>
            <hr color="black">
          </div>

         <div class="row">


          <?php
          $sql = "SELECT * FROM `teachertimetable` WHERE teacherName = '$staffName'";
          $result = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_array($result)){
            $subject = $row['teacherSubject'];
            $selectStudents = "SELECT * FROM `studentsubjects` WHERE subject1 = '$subject' OR subject2 = '$subject' OR subject3 = '$subject' OR subject4 = '$subject' OR subject5 = '$subject' OR subject6 = '$subject' OR subject7 = '$subject'";
            $selectStudentsResult = mysqli_query($conn, $selectStudents);
            $count = mysqli_num_rows($selectStudentsResult);
          ?>

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-1 text-md-center text-xl-left"><?php echo $row['teacherSubject'] ?></p>
                  <div class="list-group">
                    <a href="markAttendance.php?subject=<?php echo $subject ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-calendar menu-icon"></i> &nbsp; Mark Attendance</a>
                    <a href="viewAttendance.php?subject=<?php echo $subject ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-eye menu-icon"></i> &nbsp; View Overall Attendance</a>
                    <a href="editAttendance.php?subject=<?php echo $subject ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-pencil menu-icon"></i> &nbsp; Edit Attendance</a>
                    <a href="staffDownloadTheory.php?subject=<?php echo $subject ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-download menu-icon"></i> &nbsp; Download Theory</a>
                    <a href="staffDownloadPrac.php?subject=<?php echo $subject ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-download menu-icon"></i> &nbsp; Download Prac/Tut</a>
                  </div>
                  
                  
                  
                  <div class="d-flex flex-wrap justify-content-between align-items-center mt-2">
                    <h4 class="mb-0 mb-md-2 mb-xl-0"><?php echo $count ?> Students</h4>
                    <i class="ti-book icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                  </div>
                </div>
              </div>
            </div>

          <?php
          }
          ?>

          </div>
        </div>
        <!-- content-wrapper ends -->
        <?php include 'footer.php'; ?>