<?php
  session_start();
  if(!isset($_SESSION['adminLogged'])){
    header('Location: ../../index.php');
  }
  include "database.php";
  $truncate1 = "TRUNCATE `teachertimetable`";
  $truncate2 = "TRUNCATE `studentsubjects`";
  $truncate3 = "TRUNCATE `attendance`";
  mysqli_query($conn, $truncate1);
  mysqli_query($conn, $truncate2);
  mysqli_query($conn, $truncate3);
  echo "<script>alert('New Semester Started...');</script>";
  echo "<script>window.location.href = 'adminDashboard.php';</script>";
?>