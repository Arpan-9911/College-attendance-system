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
        <?php include 'footer.php'; ?>