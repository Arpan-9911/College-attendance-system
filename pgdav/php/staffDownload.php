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
          if(isset($_POST['theory-btn'])){
            $subject = $_POST['theorySubject'];
            $period = $_POST['timeTheory'];
            if($period == "Sem"){
              header("Location: staffDownloadTheorySem.php?subject={$subject}&&time={$period}");
            }
            else{
              header("Location: staffDownloadTheoryMonth.php?subject={$subject}&&time={$period}");
            }
          }
          elseif(isset($_POST['prac-btn'])){
            $subject = $_POST['pracSubject'];
            $period = $_POST['timePrac'];
            if($period == "Sem"){
              header("Location: staffDownloadPracSem.php?subject={$subject}&&time={$period}");
            }
            else{
              header("Location: staffDownloadPracMonth.php?subject={$subject}&&time={$period}");
            }
          }
          ?>




         <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-1 text-md-center text-xl-left">Download Theory Attendance</p>
                  <form method="post">
                    <div class="form-group mb-2">
                      <label for="exampleInputSubject" class="m-0">Subject</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-book text-primary"></i>
                          </span>
                          </div>
                          <input type="text" name="theorySubject" class="form-control form-control-lg border-left-0" id="exampleInputSubject" required>
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
                          <select name="timeTheory" id="exampleInputTime" class="form-select border-left-0 px-4">
                            <option value="Sem">Semester</option>
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
                      <input type="submit" name="theory-btn" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn" value="DOWNLOAD">
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title mb-1 text-md-center text-xl-left">Download Practical Attendance</p>
                  <form method="post">
                    <div class="form-group mb-2">
                      <label for="exampleInputSubject" class="m-0">Subject</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-book text-primary"></i>
                          </span>
                          </div>
                          <input type="text" name="pracSubject" class="form-control form-control-lg border-left-0" id="exampleInputSubject" required>
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
                          <select name="timePrac" id="exampleInputTime" class="form-select border-left-0 px-4">
                            <option value="Sem">Semester</option>
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
                      <input type="submit" name="prac-btn" class="btn btn-block btn-primary text-white btn-lg font-weight-medium auth-form-btn" value=" DOWNLOAD">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <?php include 'footer.php'; ?>