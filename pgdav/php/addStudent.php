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
  <?php include "header.php"; ?>



  <?php
  if(isset($_POST['submit-btn'])){
    $studentName = $_POST['username'];
    $studentRoll = $_POST['roll'];
    $Email = $_POST['email'];
    $studentEmail = strtolower($Email);
    $studentPhone = $_POST['phone'];
    $studentPassword = $_POST['pass'];

    $check = "SELECT * FROM `student` WHERE studentEmail = '$studentEmail' AND studentRoll = '$studentRoll'";
    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) == 0){
      $insert = "INSERT INTO `student` (studentName, studentRoll, studentEmail, studentPhone, studentPassword) VALUES ('$studentName', '$studentRoll', '$studentEmail', '$studentPhone', '$studentPassword')";
      $resultInsert = mysqli_query($conn, $insert);
      if($resultInsert){
        echo "<script>alert('Student Data Added Successfully!')</script>";
      }
      else{
        echo "<script>alert('Error Occured!')</script>";
      }
    }
    else{
      echo "<script>alert('This Student Already Added!')</script>";
    }
  }
  ?>


  <?php
  // include phpspreadsheet
  require '../../vendor/autoload.php';
  use PhpOffice\PhpSpreadsheet\IOFactory;

  // php for adding student data
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
        $studentName = $workSheet->getCell("A" . $row)->getValue();
        $studentRoll = $workSheet->getCell("B" . $row)->getValue();
        $studentEmail = strtolower($workSheet->getCell("C" . $row)->getValue());
        $studentPhone = $workSheet->getCell("D" . $row)->getValue();
        $studentPassword = $workSheet->getCell("E" . $row)->getValue();

        // checking the row is already exist or not
        $check = "SELECT * FROM `student` WHERE `studentRoll` = '$studentRoll' && studentEmail='$studentEmail'";
        $checkResult = mysqli_query($conn, $check);

        // If already not exist then add the detail
        if (mysqli_num_rows($checkResult) == 0) {
          $sql = "INSERT INTO `student` (studentName, studentRoll, studentEmail, studentPhone, studentPassword) VALUES ('$studentName', '$studentRoll', '$studentEmail', '$studentPhone', '$studentPassword')";
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



  // php for adding student subject lists
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
        $studentName = $workSheet->getCell("A" . $row)->getValue();
        $studentRoll = $workSheet->getCell("B" . $row)->getValue();
        $studentSem = $workSheet->getCell("C" . $row)->getValue();
        $studentSubject1 = $workSheet->getCell("D". $row)->getValue();
        $studentSubject2 = $workSheet->getCell("E". $row)->getValue();
        $studentSubject3 = $workSheet->getCell("F". $row)->getValue();
        $studentSubject4 = $workSheet->getCell("G". $row)->getValue();
        $studentSubject5 = $workSheet->getCell("H". $row)->getValue();
        $studentSubject6 = $workSheet->getCell("I". $row)->getValue();
        $studentSubject7 = $workSheet->getCell("J". $row)->getValue();

        // checking the row is already exist or not
        $check = "SELECT * FROM `studentsubjects` WHERE studentName = '$studentName' && studentRoll = '$studentRoll' && studentSem='$studentSem'";
        $checkResult = mysqli_query($conn, $check);

        // If already not exist then add the detail
        if (mysqli_num_rows($checkResult) == 0) {
          $sql = "INSERT INTO `studentsubjects` (studentName, studentRoll, studentSem, subject1, subject2, subject3, subject4, subject5, subject6, subject7) VALUES ('$studentName', '$studentRoll', '$studentSem', '$studentSubject1', '$studentSubject2', '$studentSubject3', '$studentSubject4', '$studentSubject5', '$studentSubject6', '$studentSubject7')";
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
            <div class="col-md-12">
              <h4 class="font-weight-bold mb-0">ADD STUDENTS</h4>
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
                  <input type="text" name="username" autocomplete="off" class="form-control form-control-lg border-left-0" id="exampleInputName" placeholder="Student Name" required>
                </div>
              </div>
              <div class="form-group mb-1">
                <label for="exampleInputRoll" class="m-0">Roll No.</label>
                <div class="input-group">
                  <div class="input-group-prepend bg-transparent">
                    <span class="input-group-text bg-transparent border-right-0">
                      <i class="ti-user text-primary"></i>
                    </span>
                  </div>
                  <input type="text" name="roll" autocomplete="off" class="form-control form-control-lg border-left-0" id="exampleInputRoll" placeholder="College Roll No." required>
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
                  <input type="email" name="email" autocomplete="off" class="form-control form-control-lg border-left-0" id="exampleInputEmail" placeholder="Student Email" required>
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
                  <input type="text" name="phone" autocomplete="off" class="form-control form-control-lg border-left-0" id="exampleInputPhone" placeholder="Student Phone" required>
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
                  <input type="text" name="pass" autocomplete="off" class="form-control form-control-lg border-left-0" id="exampleInputPass" placeholder="Student Password" required>
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
                <a href="studentDataFormat.php" class="btn btn-block btn-info text-white btn-sm font-weight-medium auth-form-btn"><i class="ti-download"></i></a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="mt-2">
        <div class="col-md-12 grid-margin">
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
                <a href="studentTimeTableFormat.php" class="btn btn-block btn-info text-white btn-sm font-weight-medium auth-form-btn"><i class="ti-download"></i></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  <?php include "footer.php"; ?>
</body>
</html>