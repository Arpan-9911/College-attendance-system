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
            Hi, <?php echo $adminName ?>
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
          <a class="nav-link" href="adminDashboard.php">
            <i class="ti-shield menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="addTeacher.php">
            <i class="ti-user menu-icon"></i>
            <span class="menu-title">Teachers</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="addStudent.php">
            <i class="ti-user menu-icon"></i>
            <span class="menu-title">Students</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adminDownload.php">
            <i class="ti-download menu-icon"></i>
            <span class="menu-title">Download Attendance</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="search.php">
            <i class="ti-search menu-icon"></i>
            <span class="menu-title">Search Data</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="javascript:newSem()" class="nav-link">
            <i class="ti-book menu-icon"></i>
            <span class="menu-title">New Semester</span>
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


  <script>
    function newSem() {
      if(confirm("Are you sure to start new semester !!")){
        window.location.href = "newSem.php";
      }
    }
  </script>
  

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