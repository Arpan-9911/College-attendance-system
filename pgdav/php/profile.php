<?php
include "database.php";
session_start();

if(!isset($_SESSION['staffLogged']) && !isset($_SESSION['studentLogged']) && !isset($_SESSION['adminLogged'])){
  header("Location: ../../index.php");
}
elseif(isset($_SESSION['adminLogged'])){
  $adminName = $_SESSION['adminName'];
  $adminEmail = $_SESSION['adminEmail'];
  $adminPhone = $_SESSION['adminPhone'];
  $selectPass = "SELECT * FROM `admin` WHERE adminEmail = '$adminEmail'";
  $resultPass = mysqli_query($conn, $selectPass);
  $row = mysqli_fetch_array($resultPass);
  $adminPassword = $row['adminPassword'];
}
elseif(isset($_SESSION['staffLogged'])){
  $staffName = $_SESSION['staffName'];
  $staffEmail = $_SESSION['staffEmail'];
  $staffPhone = $_SESSION['staffPhone'];
  $selectPass = "SELECT * FROM `staff` WHERE staffEmail = '$staffEmail'";
  $resultPass = mysqli_query($conn, $selectPass);
  $row = mysqli_fetch_array($resultPass);
  $staffPassword = $row['staffPassword'];
}
elseif(isset($_SESSION['studentLogged'])){
  $studentName = $_SESSION['studentName'];
  $studentRoll = $_SESSION['studentRoll'];
  $studentEmail = $_SESSION['studentEmail'];
  $studentPhone = $_SESSION['studentPhone'];
  $selectPass = "SELECT * FROM `student` WHERE studentEmail = '$studentEmail'";
  $resultPass = mysqli_query($conn, $selectPass);
  $row = mysqli_fetch_array($resultPass);
  $studentPassword = $row['studentPassword'];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>PGDAV | Profile</title>
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

  <!-- Extra css -->
  <style>
    #exampleInputPassword{
      position: relative;
    }
    #toggleIcon{
      position: absolute;
      right: 0px;
      top: 8px;
      font-size: 20px;
      z-index: 10;
      cursor: pointer;
      padding: 10px;
    }
  </style>

</head>
<body>
  <?php
  if(isset($_SESSION['adminLogged'])){
  ?>
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
                <h4 class="font-weight-bold mb-0">Search Data</h4>
              </div>
            </div>
          </div>
          <hr color="black">
        </div>

        <div class="row">
          <?php
          

            // Update
            if(isset($_POST['admin-btn'])){
              $changedAdminPhone = $_POST['adminPhone'];
              $changedAdminPassword = $_POST['adminPass'];
              $changedSql = "UPDATE `admin` SET adminPhone = '$changedAdminPhone', adminPassword = '$changedAdminPassword' WHERE adminEmail = '$adminEmail'";
              $changedResult = mysqli_query($conn, $changedSql);
              if ($changedResult) {
                echo "<script>alert('Data Updated Successfully')</script>";
                echo "<script>window.location.href ='adminDashboard.php';</script>";
              }
            }
          ?>

          <!-- Display -->
          <form class="pt-0 d-flex flex-wrap align-items-center justify-content-between" method="post">
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputName" class="m-0">Name</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-user text-primary"></i>
                  </span>
                </div>
                <input type="text" name="adminName" disabled class="form-control bg-secondary text-white form-control-lg border-left-0" id="exampleInputName" value="<?php echo $adminName ?>" required>
              </div>
            </div>
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputEmail" class="m-0">Email</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-email text-primary"></i>
                  </span>
                </div>
                <input type="email" name="adminEmail" disabled class="form-control form-control-lg bg-secondary text-white border-left-0" id="exampleInputEmail" value="<?php echo $adminEmail ?>" required>
              </div>
            </div>
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputPhone" class="m-0">Contact</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-mobile text-primary"></i>
                  </span>
                </div>
                <input type="text" name="adminPhone" class="form-control form-control-lg border-left-0" id="exampleInputPhone" value="<?php echo $adminPhone ?>" required>
              </div>
            </div>
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputPass" class="m-0">Password</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-lock text-primary"></i>
                  </span>
                </div>
                <input type="password" name="adminPass" class="form-control form-control-lg border-left-0" id="exampleInputPass" value="<?php echo $adminPassword ?>" required>
                <i class="ti-lock" id="toggleIcon"></i> 
              </div>
            </div>
            <div class="my-3 col-12">
              <input type="submit" name="admin-btn" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn" value="UPDATE">
            </div>
          </form>
          <?php
          }


  elseif(isset($_SESSION['staffLogged'])){
  ?>
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
            // Update
            if(isset($_POST['staff-btn'])){
              $changedStaffPhone = $_POST['staffPhone'];
              $changedStaffPassword = $_POST['staffPass'];
              $changedSql = "UPDATE `staff` SET staffPhone = '$changedStaffPhone', staffPassword = '$changedStaffPassword' WHERE staffEmail = '$staffEmail'";
              $changedResult = mysqli_query($conn, $changedSql);
              if ($changedResult) {
                echo "<script>alert('Data Updated Successfully')</script>";
                echo "<script>window.location.href ='staffDashboard.php';</script>";
              }
            }
          ?>

          <!-- Display -->
          <form class="pt-0 d-flex flex-wrap align-items-center justify-content-between" method="post">
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputName" class="m-0">Name</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-user text-primary"></i>
                  </span>
                  </div>
                  <input type="text" name="staffName" disabled class="form-control bg-secondary text-white form-control-lg border-left-0" id="exampleInputName" value="<?php echo $staffName ?>" required>
                </div>
            </div>
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputEmail" class="m-0">Email</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-email text-primary"></i>
                  </span>
                  </div>
                  <input type="email" name="staffEmail" disabled class="form-control form-control-lg bg-secondary text-white border-left-0" id="exampleInputEmail" value="<?php echo $staffEmail ?>" required>
                </div>
            </div>
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputPhone" class="m-0">Contact</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-mobile text-primary"></i>
                  </span>
                  </div>
                  <input type="text" name="staffPhone" class="form-control form-control-lg border-left-0" id="exampleInputPhone" value="<?php echo $staffPhone ?>" required>
                </div>
            </div>
            <div class="form-group col-md-5 col-12 mb-2">
              <label for="exampleInputPass" class="m-0">Password</label>
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <span class="input-group-text bg-transparent border-right-0">
                    <i class="ti-lock text-primary"></i>
                  </span>
                  </div>
                  <input type="password" name="staffPass" class="form-control form-control-lg border-left-0" id="exampleInputPass" value="<?php echo $staffPassword ?>" required>
                  <i class="ti-lock" id="toggleIcon"></i> 
                </div>
            </div>
            <div class="my-3 col-12">
              <input type="submit" name="staff-btn" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn" value="UPDATE">
            </div>
          </form>
          <?php
          }

  elseif(isset($_SESSION['studentLogged'])){
  ?>
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
          <div class="form-group col-md-6 col-12 mb-2">
            <label for="exampleInputName" class="m-0">Name</label>
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                <span class="input-group-text bg-transparent border-right-0">
                  <i class="ti-user text-primary"></i>
                </span>
              </div>
              <input type="text" name="username" disabled class="form-control bg-secondary text-white form-control-lg border-left-0" id="exampleInputName" value="<?php echo $studentName ?>">
            </div>
          </div>
          <div class="form-group col-md-6 col-12 mb-2">
            <label for="exampleInputRoll" class="m-0">College Roll No.</label>
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                <span class="input-group-text bg-transparent border-right-0">
                  <i class="ti-user text-primary"></i>
                </span>
              </div>
              <input type="text" name="username" disabled class="form-control bg-secondary text-white form-control-lg border-left-0" id="exampleInputRoll" value="<?php echo $studentRoll ?>">
            </div>
          </div>
          <div class="form-group col-md-6 col-12 mb-2">
            <label for="exampleInputEmail" class="m-0">Email</label>
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                <span class="input-group-text bg-transparent border-right-0">
                  <i class="ti-email text-primary"></i>
                </span>
              </div>
              <input type="email" name="email" disabled class="form-control form-control-lg bg-secondary text-white border-left-0" id="exampleInputEmail" value="<?php echo $studentEmail ?>">
            </div>
          </div>
          <div class="form-group col-md-6 col-12 mb-2">
            <label for="exampleInputPhone" class="m-0">Contact</label>
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                <span class="input-group-text bg-transparent border-right-0">
                  <i class="ti-mobile text-primary"></i>
                </span>
              </div>
              <input type="text" name="phone" disabled class="form-control form-control-lg bg-secondary text-white border-left-0" id="exampleInputPhone" value="<?php echo $studentPhone ?>">
            </div>
          </div>
          <div class="form-group col-md-6 col-12 mb-2">
            <label for="exampleInputPass" class="m-0">Password</label>
            <div class="input-group">
              <div class="input-group-prepend bg-transparent">
                <span class="input-group-text bg-transparent border-right-0">
                  <i class="ti-lock text-primary"></i>
                </span>
              </div>
              <input type="password" name="pass" disabled class="form-control form-control-lg bg-secondary text-white border-left-0" id="exampleInputPass" value="<?php echo $studentPassword ?>">
              <i class="ti-lock" id="toggleIcon"></i> 
            </div>
          </div>
          <?php
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

  <script>
    function newSem() {
      if(confirm("Are you sure to start new semester !!")){
        window.location.href = "newSem.php";
      }
    }
  </script>

  <script>
  // Get the input and icon elements
  var inputField = document.getElementById("exampleInputPass");
  var toggleIcon = document.getElementById("toggleIcon");

  // Function to toggle input type
  toggleIcon.addEventListener("click", function() {
    if (inputField.type === "password") {
      inputField.type = "text";
      toggleIcon.classList.remove("ti-lock");
      toggleIcon.classList.add("ti-eye");
    } else {
      inputField.type = "password";
      toggleIcon.classList.remove("ti-eye");
      toggleIcon.classList.add("ti-lock");
    }
  });
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