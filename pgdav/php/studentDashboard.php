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
  <!-- partial:partials/_navbar.html -->
  <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center">
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
            Hi, <?php echo $studentName ?>
          </a>
        </div>
      </div>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="ti-view-list"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas bg-white card" id="sidebar">
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link" href="studentDashboard.php">
            <i class="ti-shield menu-icon"></i>
            <span class="menu-title">Dashboard</span>
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
          <a class="col-md-4 p-1 stretch-card text-decoration-none text-black" href="studentDateDisplay.php?subject=<?php echo $subject ?>">
            <div class="card">
              <div class="card-body p-3">
                <div class="d-flex flex-column">
                  <h4 class="mb-2 text-muted"><?php echo strtoupper($subject) ?></h4>
                  <table class="table-bordered">
                    <tr>
                      <td style="font-weight: 600;">Total</td>
                      <td><?php echo $totalDays ?> Times</td>
                    </tr>
                    <tr>
                      <td style="font-weight: 600;">Present</td>
                      <td><?php echo $presentDays ?> Times</td>
                    </tr>
                    <tr>
                      <td style="font-weight: 600;">Percentage</td>
                      <td><?php echo $percent ?> %</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </a>
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