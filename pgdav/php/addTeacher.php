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



    <?php
    if(isset($_POST['submit-btn'])){
      $staffName = $_POST['username'];
      $Email = $_POST['email'];
      $staffEmail = strtolower($Email);
      $staffPhone = $_POST['phone'];
      $staffPassword = $_POST['pass'];

      $check = "SELECT * FROM `staff` WHERE staffEmail = '$staffEmail'";
      $result = mysqli_query($conn, $check);

      if(mysqli_num_rows($result) == 0){
        $insert = "INSERT INTO `staff` (staffName, staffEmail, staffPhone, staffPassword) VALUES ('$staffName', '$staffEmail', '$staffPhone', '$staffPassword')";
        $resultInsert = mysqli_query($conn, $insert);
        if($resultInsert){
          echo "<script>alert('Teacher Data Added Successfully!')</script>";
        }
        else{
          echo "<script>alert('Error Occured!')</script>";
        }
      }
      else{
        echo "<script>alert('This Teacher Already Added!')</script>";
      }
    }
    ?>


    <?php
    // include phpspreadsheet
    require '../../vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;

    // php for adding teacher data
    if (isset($_POST['upload-btn'])) {
      $fileName = $_FILES['file']['name'];
      $fileTmpName = $_FILES['file']['tmp_name'];

      // file extension
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
      $allowed = array('xlsx', 'xls');

      // checking file extension
      if (in_array($fileExtension, $allowed)) {
        $filePath = 'uploads/'.$fileName;
        move_uploaded_file($fileTmpName, $filePath);

        $spreadsheet = IOFactory::load($filePath);
        $workSheet = $spreadsheet->getActiveSheet();
        $highestRow = $workSheet->getHighestRow();

        // For each row of the sheet but not the first row
        for($row = 2; $row <= $highestRow; $row++ ){
          $staffName = $workSheet->getCell("A" . $row)->getValue();
          $staffEmail = $workSheet->getCell("B" . $row)->getValue();
          $staffPhone = $workSheet->getCell("C" . $row)->getValue();
          $staffPassword = $workSheet->getCell("D" . $row)->getValue();

          // checking the row is already exist or not
          $check = "SELECT * FROM `staff` WHERE `staffName` = '$staffName' && staffEmail='$staffEmail'";
          $checkResult = mysqli_query($conn, $check);

          // If not already exist then add the detail
          if (mysqli_num_rows($checkResult) == 0) {
            $sql = "INSERT INTO `staff` (staffName, staffEmail, staffPhone, staffPassword) VALUES ('$staffName', '$staffEmail', '$staffPhone', '$staffPassword')";
            $result = mysqli_query($conn, $sql);
          }
        }
        echo "<script>alert('Data Added Successfully')</script>";
        unlink($filePath);
      }
      else {
        echo "<script>alert('Invalid file extension');</script>";
      }
      mysqli_close($conn);
    }
    // php for adding teacher timetable
    elseif (isset($_POST['timetable-btn'])) {
      $fileName = $_FILES['timetable']['name'];
      $fileTmpName = $_FILES['timetable']['tmp_name'];

      // file extension
      $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
      $allowed = array('xlsx', 'xls');

      // checking file extension
      if (in_array($fileExtension, $allowed)) {
        $filePath = 'uploads/'.$fileName;
        move_uploaded_file($fileTmpName, $filePath);

        $spreadsheet = IOFactory::load($filePath);
        $workSheet = $spreadsheet->getActiveSheet();
        $highestRow = $workSheet->getHighestRow();

        // For each row of the sheet but not the first row
        for($row = 2; $row <= $highestRow; $row++ ){
          $teacherName = $workSheet->getCell("A" . $row)->getValue();
          $teacherSubject1 = $workSheet->getCell("B" . $row)->getValue();
          $teacherSubject2 = $workSheet->getCell("C" . $row)->getValue();
          $teacherSubject3 = $workSheet->getCell("D". $row)->getValue();
          $teacherSubject4 = $workSheet->getCell("E". $row)->getValue();

          // checking the row is already exist or not
          $check = "SELECT * FROM `teachertimetable` WHERE `teacherName` = '$teacherName'";
          $checkResult = mysqli_query($conn, $check);

          // If already not exist then add the detail
          if (mysqli_num_rows($checkResult) == 0) {
            $sql = "INSERT INTO `teachertimetable` (teacherName, subject1, subject2, subject3, subject4) VALUES ('$teacherName', '$teacherSubject1', '$teacherSubject2', '$teacherSubject3', '$teacherSubject4')";
            $result = mysqli_query($conn, $sql);
          }
        }
        echo "<script>alert('Data Added Successfully')</script>";
        unlink($filePath);
      }
      else {
        echo "<script>alert('Invalid file extension');</script>";
      }
      mysqli_close($conn);
    }
    ?>

    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
              <div class="col-12">
                <h4 class="font-weight-bold mb-0">ADD TEACHERS</h4>
                <hr color="black">
              </div>
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-between">
          <div class="col-md-6 grid-margin">
            <div>
              <div>
                <h4 class="font-weight-bold mb-0">Manually</h4>
              </div>
              <form class="pt-3" method="post">
                <div class="form-group mb-1">
                  <label for="exampleInputName" class="m-0">Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-user text-primary"></i>
                      </span>
                      </div>
                      <input type="text" name="username" autocomplete="off" class="form-control form-control-lg border-left-0" id="exampleInputName" placeholder="Teacher Name" required>
                    </div>
                </div>
                <div class="form-group mb-1">
                  <label for="exampleInputEmail" class="m-0">Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-email text-primary"></i>
                      </span>
                      </div>
                      <input type="email" name="email" autocomplete="off" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Teacher Email" required>
                    </div>
                </div>
                <div class="form-group mb-1">
                  <label for="exampleInputPhone" class="m-0">Contact</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-mobile text-primary"></i>
                      </span>
                      </div>
                      <input type="text" name="phone" autocomplete="off" class="form-control form-control-lg border-left-0" id="exampleInputPhone" placeholder="Teacher Phone" required>
                    </div>
                </div>
                <div class="form-group mb-1">
                  <label for="exampleInputPass" class="m-0">Set Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-lock text-primary"></i>
                      </span>
                      </div>
                      <input type="text" name="pass" autocomplete="off" class="form-control form-control-lg border-left-0" id="exampleInputPass" placeholder="Teacher Password" required>
                    </div>
                </div>
                <div class="my-3">
                  <input type="submit" name="submit-btn" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn" value="SUBMIT">
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-6 grid-margin">
            <div>
              <div>
                <h4 class="font-weight-bold mb-0">Excel Sheet</h4>
              </div>
              <form class="pt-3" method="post" enctype="multipart/form-data">
                <div class="form-group mb-1">
                  <label for="exampleInputFile" class="m-0">File</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-file text-primary"></i>
                      </span>
                      </div>
                      <input type="file" name="file" class="form-control bg-white form-control-lg border-left-0" id="exampleInputFile" required>
                    </div>
                </div>
                <div class="my-3">
                  <input type="submit" name="upload-btn" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn" value="UPLOAD">
                  <a href="teacherDataFormat.php" class="btn btn-block btn-info text-white btn-sm font-weight-medium auth-form-btn"><i class="ti-download"></i></a>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="mt-2">
          <div class="col-md-12">
            <div>
              <div>
                <h4 class="font-weight-bold mb-0">UPLOAD TIMETABLE</h4>
                <hr color="black">
              </div>
              <form class="pt-1" method="post" enctype="multipart/form-data">
                <div class="form-group mb-1">
                  <label for="exampleInputFile" class="m-0">File</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="ti-file text-primary"></i>
                      </span>
                      </div>
                      <input type="file" name="timetable" class="form-control bg-white form-control-lg border-left-0" id="exampleInputFile" required>
                    </div>
                </div>
                <div class="my-3">
                  <input type="submit" name="timetable-btn" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn" value="UPLOAD">
                  <a href="teacherTimeTableFormat.php" class="btn btn-block btn-info text-white btn-sm font-weight-medium auth-form-btn"><i class="ti-download"></i></a>
                </div>
              </form>
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