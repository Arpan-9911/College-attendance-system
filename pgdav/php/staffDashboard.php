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
          if($row = mysqli_fetch_array($result)){
            $subject1 = $row['subject1'];
            $subject2 = $row['subject2'];
            $subject3 = $row['subject3'];
            $subject4 = $row['subject4'];

            if($subject1 != null){
              $selectStudents1 = "SELECT * FROM `studentsubjects` WHERE subject1 = '$subject1' OR subject2 = '$subject1' OR subject3 = '$subject1' OR subject4 = '$subject1' OR subject5 = '$subject1' OR subject6 = '$subject1' OR subject7 = '$subject1'";
              $selectStudentsResult1 = mysqli_query($conn, $selectStudents1);
              $count1 = mysqli_num_rows($selectStudentsResult1);
          ?>
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title mb-1 text-md-center text-xl-left"><?php echo $subject1 ?></p>
                <div class="list-group">
                  <a href="markAttendance.php?subject=<?php echo $subject1 ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-calendar menu-icon"></i> &nbsp; Mark Attendance</a>
                  <a href="viewAttendance.php?subject=<?php echo $subject1 ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-eye menu-icon"></i> &nbsp; View Overall Attendance</a>
                  <a href="editAttendance.php?subject=<?php echo $subject1 ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-pencil menu-icon"></i> &nbsp; Edit Attendance</a>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center mt-2">
                  <h4 class="mb-0 mb-md-2 mb-xl-0"><?php echo $count1 ?> Students</h4>
                  <i class="ti-book icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div>
              </div>
            </div>
          </div>
          <?php
            }
            if($subject2 != null){
              $selectStudents2 = "SELECT * FROM `studentsubjects` WHERE subject1 = '$subject2' OR subject2 = '$subject2' OR subject3 = '$subject2' OR subject4 = '$subject2' OR subject5 = '$subject2' OR subject6 = '$subject2' OR subject7 = '$subject2'";
              $selectStudentsResult2 = mysqli_query($conn, $selectStudents2);
              $count2 = mysqli_num_rows($selectStudentsResult2);
          ?>
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title mb-1 text-md-center text-xl-left"><?php echo $subject2 ?></p>
                <div class="list-group">
                  <a href="markAttendance.php?subject=<?php echo $subject2 ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-calendar menu-icon"></i> &nbsp; Mark Attendance</a>
                  <a href="viewAttendance.php?subject=<?php echo $subject2 ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-eye menu-icon"></i> &nbsp; View Overall Attendance</a>
                  <a href="editAttendance.php?subject=<?php echo $subject2 ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-pencil menu-icon"></i> &nbsp; Edit Attendance</a>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center mt-2">
                  <h4 class="mb-0 mb-md-2 mb-xl-0"><?php echo $count2 ?> Students</h4>
                  <i class="ti-book icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div>
              </div>
            </div>
          </div>
          <?php
            }
            if($subject3 != null){
              $selectStudents3 = "SELECT * FROM `studentsubjects` WHERE subject1 = '$subject3' OR subject2 = '$subject3' OR subject3 = '$subject3' OR subject4 = '$subject3' OR subject5 = '$subject3' OR subject6 = '$subject3' OR subject7 = '$subject3'";
              $selectStudentsResult3 = mysqli_query($conn, $selectStudents3);
              $count3 = mysqli_num_rows($selectStudentsResult3);
          ?>
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title mb-1 text-md-center text-xl-left"><?php echo $subject3 ?></p>
                <div class="list-group">
                  <a href="markAttendance.php?subject=<?php echo $subject3 ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-calendar menu-icon"></i> &nbsp; Mark Attendance</a>
                  <a href="viewAttendance.php?subject=<?php echo $subject3 ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-eye menu-icon"></i> &nbsp; View Overall Attendance</a>
                  <a href="editAttendance.php?subject=<?php echo $subject3 ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-pencil menu-icon"></i> &nbsp; Edit Attendance</a>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center mt-2">
                  <h4 class="mb-0 mb-md-2 mb-xl-0"><?php echo $count3 ?> Students</h4>
                  <i class="ti-book icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div>
              </div>
            </div>
          </div>
          <?php
            }
            if($subject4 != null){
              $selectStudents4 = "SELECT * FROM `studentsubjects` WHERE subject1 = '$subject4' OR subject2 = '$subject4' OR subject3 = '$subject4' OR subject4 = '$subject4' OR subject5 = '$subject4' OR subject6 = '$subject4' OR subject7 = '$subject4'";
              $selectStudentsResult4 = mysqli_query($conn, $selectStudents4);
              $count4 = mysqli_num_rows($selectStudentsResult4);
          ?>
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title mb-1 text-md-center text-xl-left"><?php echo $subject4 ?></p>
                <div class="list-group">
                  <a href="markAttendance.php?subject=<?php echo $subject4 ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-calendar menu-icon"></i> &nbsp; Mark Attendance</a>
                  <a href="viewAttendance.php?subject=<?php echo $subject4 ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-eye menu-icon"></i> &nbsp; View Overall Attendance</a>
                  <a href="editAttendance.php?subject=<?php echo $subject4 ?>" class="btn-inverse-info my-1 p-2 list-group-item"><i class="ti-pencil menu-icon"></i> &nbsp; Edit Attendance</a>
                </div>
                <div class="d-flex flex-wrap justify-content-between align-items-center mt-2">
                  <h4 class="mb-0 mb-md-2 mb-xl-0"><?php echo $count4 ?> Students</h4>
                  <i class="ti-book icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
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