<?php
session_start();
if(!isset($_SESSION['adminLogged']) || !isset($_SESSION['staffLogged']) || !isset($_SESSION['studentLogged'])){
  header('Location: ../../index.php');
}
unset($_SESSION['adminLogged']);
unset($_SESSION['staffLogged']);
unset($_SESSION['studentLogged']);
session_destroy();
header("location: ../../index.php");
?>