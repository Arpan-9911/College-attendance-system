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
                <h4 class="font-weight-bold mb-0">Download Attendance</h4>
              </div>
            </div>
          </div>
          <hr color="black">
        </div>



        <?php
        if(isset($_POST['freeze-btn'])){
          $subject = $_POST['subject'];
          $time = $_POST['time'];
          if($time == 'Jan'){
            $month = '01';
          }
          else if($time == 'Feb'){
              $month = '02';
          }
          else if($time == 'Mar'){
              $month = '03';
          }
          else if($time == 'Apr'){
              $month = '04';
          }
          else if($time == 'May'){
              $month = '05';
          }
          else if($time == 'Jun'){
              $month = '06';
          }
          else if($time == 'Jul'){
              $month = '07';
          }
          else if($time == 'Aug'){
              $month = '08';
          }
          else if($time == 'Sep'){
              $month = '09';
          }
          else if($time == 'Oct'){
              $month = '10';
          }
          else if($time == 'Nov'){
              $month = '11';
          }
          else if($time == 'Dec'){
              $month = '12';
          }
          $query = "UPDATE `attendance` SET status = 'F' WHERE teacherName = '$staffName' AND subject LIKE '%$subject%' AND month(date) = '$month'";
          $result = mysqli_query($conn, $query);
          if($result){
            echo "<script>alert('Attendance Permanently Saved Successfully')</script>";
            echo "<script>window.location.href ='staffFreeze.php';</script>";
          }
        }
        ?>




        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <p class="card-title mb-1 text-md-center text-xl-left">Freeze Attendance</p>
                <form method="post">
                  <div class="form-group mb-2">
                    <label for="exampleInputSubject" class="m-0">Subject</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="ti-book text-primary"></i>
                        </span>
                        </div>
                        <input type="text" name="subject" class="form-control form-control-lg border-left-0" id="exampleInputSubject" required>
                      </div>
                  </div>
                  <div class="form-group mb-2">
                    <label for="exampleInputTime" class="m-0">Time Period</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="ti-book text-primary"></i>
                        </span>
                        </div>
                        <select name="time" id="exampleInputTime" class="form-select border-left-0 px-4">
                          <option value="Jan">January</option>
                          <option value="Feb">February</option>
                          <option value="Mar">March</option>
                          <option value="Apr">April</option>
                          <option value="May">May</option>
                          <option value="Jun">June</option>
                          <option value="Jul">July</option>
                          <option value="Aug">August</option>
                          <option value="Sep">September</option>
                          <option value="Oct">October</option>
                          <option value="Nov">November</option>
                          <option value="Dec">December</option>
                        </select>
                      </div>
                  </div>
                  <div class="my-3 col-12">
                    <input type="submit" name="freeze-btn" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn" value="FREEZE">
                  </div>
                </form>
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