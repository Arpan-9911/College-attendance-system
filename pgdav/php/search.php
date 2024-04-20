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


          <?php
          if(isset($_POST['updateStudent-btn'])){
            $updatedStudentName = $_POST['studentName'];
            $studentRoll = $_POST['studentRoll'];
            $updatedStudentEmail = $_POST['studentEmail'];
            $updatedStudentPhone = $_POST['studentPhone'];
            $updatedStudentSem = $_POST['studentSem'];
            $updatedSubject1 = $_POST['studentSub1'];
            $updatedSubject2 = $_POST['studentSub2'];
            $updatedSubject3 = $_POST['studentSub3'];
            $updatedSubject4 = $_POST['studentSub4'];
            $updatedSubject5 = $_POST['studentSub5'];
            $updatedSubject6 = $_POST['studentSub6'];
            $updatedSubject7 = $_POST['studentSub7'];

            $changedSql = "UPDATE `student` SET studentName = '$updatedStudentName', studentEmail = '$updatedStudentEmail', studentPhone = '$updatedStudentPhone' WHERE studentRoll = '$studentRoll'";
            $changedResult = mysqli_query($conn, $changedSql);

            $changedSql2 = "UPDATE `studentsubjects` SET studentName = '$updatedStudentName', studentSem = '$updatedStudentSem', subject1 = '$updatedSubject1', subject2 = '$updatedSubject2', subject3 = '$updatedSubject3', subject4 = '$updatedSubject4', subject5 = '$updatedSubject5', subject6 = '$updatedSubject6', subject7 = '$updatedSubject7' WHERE studentRoll = '$studentRoll'";
            $changedResult2 = mysqli_query($conn, $changedSql2);

             echo "<script>alert('Data Updated Successfully')</script>";
          }
          elseif(isset($_POST['updateStaff-btn'])){
            $staffName = $_POST['staffName'];
            $updatedStaffEmail = $_POST['staffEmail'];
            $updatedStaffPhone = $_POST['staffPhone'];
            $updatedStaffPassword = $_POST['staffPass'];
            $updatedSubject1 = $_POST['studentSub1'];
            $updatedSubject2 = $_POST['studentSub2'];
            $updatedSubject3 = $_POST['studentSub3'];
            $updatedSubject4 = $_POST['studentSub4'];


            $changedSql = "UPDATE `staff` SET staffEmail = '$updatedStaffEmail', staffPhone = '$updatedStaffPhone' WHERE staffName = '$staffName'";
            $changedResult = mysqli_query($conn, $changedSql);

            $changedSql2 = "UPDATE `teachertimetable` SET subject1 = '$updatedSubject1', subject2 = '$updatedSubject2', subject3 = '$updatedSubject3', subject4 = '$updatedSubject4' WHERE teacherName = '$staffName'";
            $changedResult2 = mysqli_query($conn, $changedSql2);

            echo "<script>alert('Data Updated Successfully')</script>";
          }
          ?>




          <div class="row">

            <!-- Student Searched -->
            <?php
            if(isset($_POST['student-btn'])){
              $studentID = $_POST['student'];
              $query = "SELECT * FROM `student` WHERE studentRoll = '$studentID'";
              $result = mysqli_query($conn, $query);
              if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $studentName = $row['studentName'];
                $studentRoll = $row['studentRoll'];
                $studentEmail = $row['studentEmail'];
                $studentPhone = $row['studentPhone'];
                $query2 = "SELECT * FROM `studentsubjects` WHERE studentRoll = '$studentRoll'";
                $result2 = mysqli_query($conn, $query2);
                if(mysqli_num_rows($result2) == 1){
                  $row2 = mysqli_fetch_assoc($result2);
                  $sem = $row2['studentSem'];
                  $subject1 = $row2['subject1'];
                  $subject2 = $row2['subject2'];
                  $subject3 = $row2['subject3'];
                  $subject4 = $row2['subject4'];
                  $subject5 = $row2['subject5'];
                  $subject6 = $row2['subject6'];
                  $subject7 = $row2['subject7'];
            ?>

                  <form class="p-0 d-flex align-items-center justify-content-between" method="post">
                    <div class="input-group p-0">
                      <input type="text" name="student" class="form-control" placeholder="Search Student">
                      <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="student-btn" value="SEARCH">
                    </div>
                  </form>
                  <form class="p-0 d-flex align-items-center justify-content-between my-4" method="post">
                    <div class="input-group p-0">
                      <input type="text" name="staff" class="form-control" placeholder="Search Teacher">
                      <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="staff-btn" value="SEARCH">
                    </div>
                  </form>

                  <h4 class="text-success p-0">Result Found</h4>

                  <form class="p-0 d-flex flex-wrap align-items-center justify-content-between" method="post">
                    <div class="form-group col-md-5 col-12 mb-2">
                      <label for="exampleInputName" class="m-0">Name</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-user text-primary"></i>
                          </span>
                          </div>
                          <input type="text" name="studentName" class="form-control form-control-lg border-left-0" id="exampleInputName" value="<?php echo $studentName ?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-12 mb-2">
                      <label for="exampleInputRoll" class="m-0">Roll No.</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-user text-primary"></i>
                          </span>
                          </div>
                          <input type="text" name="studentRoll" readonly class="form-control form-control-lg border-left-0" id="exampleInputRoll" value="<?php echo $studentRoll ?>" required>
                        </div>
                        <p class="text-danger m-0">Not to change*</p>
                    </div>
                    <div class="form-group col-md-5 col-12 mb-2">
                      <label for="exampleInputEmail" class="m-0">Email</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-email text-primary"></i>
                          </span>
                          </div>
                          <input type="email" name="studentEmail" class="form-control form-control-lg border-left-0" id="exampleInputEmail" value="<?php echo $studentEmail ?>" required>
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
                          <input type="text" name="studentPhone" class="form-control form-control-lg border-left-0" id="exampleInputPhone" value="<?php echo $studentPhone ?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-12 mb-2">
                      <label for="exampleInputSem" class="m-0">Semester</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-book text-primary"></i>
                          </span>
                          </div>
                          <input type="text" name="studentSem" class="form-control form-control-lg border-left-0" id="exampleInputSem" value="<?php echo $sem ?>" required>
                      </div>
                    </div>
                    <div class="form-group col-md-5 col-12 mb-2">
                      <label for="exampleInputSub1" class="m-0">Subject 1</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-book text-primary"></i>
                          </span>
                          </div>
                          <input type="text" name="studentSub1" class="form-control form-control-lg border-left-0" id="exampleInputSub1" value="<?php echo $subject1 ?>" required>
                      </div>
                    </div>
                    <div class="form-group col-md-5 col-12 mb-2">
                      <label for="exampleInputSub2" class="m-0">Subject 2</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-book text-primary"></i>
                          </span>
                          </div>
                          <input type="text" name="studentSub2" class="form-control form-control-lg border-left-0" id="exampleInputSub2" value="<?php echo $subject2 ?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-12 mb-2">
                      <label for="exampleInputSub3" class="m-0">Subject 3</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-book text-primary"></i>
                          </span>
                          </div>
                          <input type="text" name="studentSub3" class="form-control form-control-lg border-left-0" id="exampleInputSub3" value="<?php echo $subject3 ?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-12 mb-2">
                      <label for="exampleInputSub4" class="m-0">Subject 4</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-book text-primary"></i>
                          </span>
                          </div>
                          <input type="text" name="studentSub4" class="form-control form-control-lg border-left-0" id="exampleInputSub4" value="<?php echo $subject4 ?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-12 mb-2">
                      <label for="exampleInputSub5" class="m-0">Subject 5</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-book text-primary"></i>
                          </span>
                          </div>
                          <input type="text" name="studentSub5" class="form-control form-control-lg border-left-0" id="exampleInputSub5" value="<?php echo $subject5 ?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-12 mb-2">
                      <label for="exampleInputSub6" class="m-0">Subject 6</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-book text-primary"></i>
                          </span>
                          </div>
                          <input type="text" name="studentSub6" class="form-control form-control-lg border-left-0" id="exampleInputSub6" value="<?php echo $subject6 ?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-5 col-12 mb-2">
                      <label for="exampleInputSub7" class="m-0">Subject 7</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="ti-book text-primary"></i>
                          </span>
                          </div>
                          <input type="text" name="studentSub7" class="form-control form-control-lg border-left-0" id="exampleInputSub7" value="<?php echo $subject7 ?>" required>
                        </div>
                    </div>
                    <div class="my-3 col-12">
                      <input type="submit" name="updateStudent-btn" class="btn btn-block btn-success text-white btn-lg font-weight-medium auth-form-btn" value="UPDATE">
                    </div>
                  </form>
            <?php
                } else {
            ?> 
                  <form class="p-0 d-flex align-items-center justify-content-between" method="post">
                    <div class="input-group p-0">
                      <input type="text" name="student" class="form-control" placeholder="Search Student">
                      <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="student-btn" value="SEARCH">
                    </div>
                  </form>
                  <form class="p-0 d-flex align-items-center justify-content-between my-4" method="post">
                    <div class="input-group p-0">
                      <input type="text" name="staff" class="form-control" placeholder="Search Teacher">
                      <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="staff-btn" value="SEARCH">
                    </div>
                  </form>
                  <h4 class="text-danger">Subjects Not Found</h4>
            <?php
                }
              } else {
            ?>
                  <form class="p-0 d-flex align-items-center justify-content-between" method="post">
                    <div class="input-group p-0">
                      <input type="text" name="student" class="form-control" placeholder="Search Student">
                      <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="student-btn" value="SEARCH">
                    </div>
                  </form>
                  <form class="p-0 d-flex align-items-center justify-content-between my-4" method="post">
                    <div class="input-group p-0">
                      <input type="text" name="staff" class="form-control" placeholder="Search Teacher">
                      <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="staff-btn" value="SEARCH">
                    </div>
                  </form>
                  <h4 class="text-danger">No Result Found</h4>
            <?php
              }

              // Teacher Searched
            } elseif (isset($_POST['staff-btn'])) {
              $staffID = $_POST['staff'];
              $query = "SELECT * FROM `staff` WHERE staffName LIKE '%$staffID%'";
              $result = mysqli_query($conn, $query);
              if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                $staffName = $row['staffName'];
                $staffEmail = $row['staffEmail'];
                $staffPhone = $row['staffPhone'];
                $staffPassword = $row['staffPassword'];
                $query2 = "SELECT * FROM `teachertimetable` WHERE teacherName = '$staffName'";
                $result2 = mysqli_query($conn, $query2);
                if(mysqli_num_rows($result2) > 0){
                  $row2 = mysqli_fetch_array($result2);
                  $subject1 = $row2['subject1'];
                  $subject2 = $row2['subject2'];
                  $subject3 = $row2['subject3'];
                  $subject4 = $row2['subject4'];
            ?>
                <form class="p-0 d-flex align-items-center justify-content-between" method="post">
                  <div class="input-group p-0">
                    <input type="text" name="student" class="form-control" placeholder="Search Student">
                    <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="student-btn" value="SEARCH">
                  </div>
                </form>
                <form class="p-0 d-flex align-items-center justify-content-between my-4" method="post">
                  <div class="input-group p-0">
                    <input type="text" name="staff" class="form-control" placeholder="Search Teacher">
                    <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="staff-btn" value="SEARCH">
                  </div>
                </form>

                <h4 class="text-success p-0">Result Found</h4>

                <form class="p-0 d-flex flex-wrap align-items-center justify-content-between" method="post">
                  <div class="form-group col-md-5 col-12 mb-2">
                    <label for="exampleInputName" class="m-0">Name</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="ti-user text-primary"></i>
                        </span>
                        </div>
                        <input type="text" name="staffName" readonly class="form-control form-control-lg border-left-0" id="exampleInputName" value="<?php echo $staffName ?>" required>
                      </div>
                      <p class="text-danger m-0">Not to change*</p>
                  </div>
                  <div class="form-group col-md-5 col-12 mb-2">
                    <label for="exampleInputEmail" class="m-0">Email</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="ti-email text-primary"></i>
                        </span>
                        </div>
                        <input type="email" name="staffEmail" class="form-control form-control-lg border-left-0" id="exampleInputEmail" value="<?php echo $staffEmail ?>" required>
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
                    <label for="exampleInputSub1" class="m-0">Subject 1</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="ti-book text-primary"></i>
                        </span>
                        </div>
                        <input type="text" name="studentSub1" class="form-control form-control-lg border-left-0" id="exampleInputSub1" value="<?php echo $subject1 ?>" required>
                    </div>
                  </div>
                  <div class="form-group col-md-5 col-12 mb-2">
                    <label for="exampleInputSub2" class="m-0">Subject 2</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="ti-book text-primary"></i>
                        </span>
                        </div>
                        <input type="text" name="studentSub2" class="form-control form-control-lg border-left-0" id="exampleInputSub2" value="<?php echo $subject2 ?>" required>
                      </div>
                  </div>
                  <div class="form-group col-md-5 col-12 mb-2">
                    <label for="exampleInputSub3" class="m-0">Subject 3</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="ti-book text-primary"></i>
                        </span>
                        </div>
                        <input type="text" name="studentSub3" class="form-control form-control-lg border-left-0" id="exampleInputSub3" value="<?php echo $subject3 ?>" required>
                      </div>
                  </div>
                  <div class="form-group col-md-5 col-12 mb-2">
                    <label for="exampleInputSub4" class="m-0">Subject 4</label>
                    <div class="input-group">
                      <div class="input-group-prepend bg-transparent">
                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="ti-book text-primary"></i>
                        </span>
                        </div>
                        <input type="text" name="studentSub4" class="form-control form-control-lg border-left-0" id="exampleInputSub4" value="<?php echo $subject4 ?>" required>
                      </div>
                  </div>
                  <div class="my-3 col-12">
                    <input type="submit" name="updateStaff-btn" class="btn btn-block btn-success text-white btn-lg font-weight-medium auth-form-btn" value="UPDATE">
                  </div>
                </form>
            <?php
                }
                else {
            ?>
                  <form class="p-0 d-flex align-items-center justify-content-between" method="post">
                    <div class="input-group p-0">
                      <input type="text" name="student" class="form-control" placeholder="Search Student">
                      <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="student-btn" value="SEARCH">
                    </div>
                  </form>
                  <form class="p-0 d-flex align-items-center justify-content-between my-4" method="post">
                    <div class="input-group p-0">
                      <input type="text" name="staff" class="form-control" placeholder="Search Teacher">
                      <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="staff-btn" value="SEARCH">
                    </div>
                  </form>
                  <h4 class="text-danger">Subjects Not Found</h4>
            <?php
                }
              } else {
            ?>
                <form class="p-0 d-flex align-items-center justify-content-between" method="post">
                    <div class="input-group p-0">
                      <input type="text" name="student" class="form-control" placeholder="Search Student">
                      <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="student-btn" value="SEARCH">
                    </div>
                  </form>
                  <form class="p-0 d-flex align-items-center justify-content-between my-4" method="post">
                    <div class="input-group p-0">
                      <input type="text" name="staff" class="form-control" placeholder="Search Teacher">
                      <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="staff-btn" value="SEARCH">
                    </div>
                  </form>
                  <h4 class="text-danger">No Result Found</h4>
            <?php
              }
            } else {
            ?>


            <form class="p-0 d-flex align-items-center justify-content-between" method="post">
              <div class="input-group p-0">
                <input type="text" name="student" class="form-control" placeholder="Search Student">
                <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="student-btn" value="SEARCH">
              </div>
            </form>
            <form class="p-0 d-flex align-items-center justify-content-between my-4" method="post">
              <div class="input-group p-0">
                <input type="text" name="staff" class="form-control" placeholder="Search Teacher">
                <input class="btn btn-block btn-success text-white px-2 px-md-4" type="submit" name="staff-btn" value="SEARCH">
              </div>
            </form>

            <?php
            }
            ?>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <?php include 'footer.php'; ?>