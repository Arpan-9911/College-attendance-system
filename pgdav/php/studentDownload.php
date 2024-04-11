<?php
// Include database and start sessions
include "database.php";
session_start();

// Checking user is logged as admin or not
if (!isset($_SESSION['studentLogged'])) {
	header('Location: ../../index.php');
	exit(); // Always exit after header redirects
}

// Load PhpSpreadsheet library
require '../../vendor/autoload.php';

// Create new PhpSpreadsheet instance
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Subjects
$studentName = $_SESSION['studentName'];
$studentRoll = $_SESSION['studentRoll'];
$subjects = "SELECT * FROM `studentsubjects` WHERE studentName = '$studentName' AND studentRoll = '$studentRoll'";
$resultSubjects = mysqli_query($conn, $subjects);
$row = mysqli_fetch_assoc($resultSubjects);
$subject1 = $row['subject1'];
$subject2 = $row['subject2'];
$subject3 = $row['subject3'];
$subject4 = $row['subject4'];
$subject5 = $row['subject5'];
$subject6 = $row['subject6'];
$subject7 = $row['subject7'];

// Set headers
$sheet->setCellValue('A1', $subject1);
$sheet->setCellValue('B1', $subject2);
$sheet->setCellValue('C1', $subject3);
$sheet->setCellValue('D1', $subject4);
$sheet->setCellValue('E1', $subject5);
$sheet->setCellValue('F1', $subject6);
$sheet->setCellValue('G1', $subject7);

// Query to fetch distinct dates for the subject
$dateQuery = "SELECT * FROM `attendance` WHERE studentName = '$studentName' AND studentRoll = '$studentRoll' ORDER BY date ASC";
$dateResult = mysqli_query($conn, $dateQuery);
$DateRowCount = mysqli_num_rows($dateResult);
if ($DateRowCount <= 0 ) {
  $sheet->setCellValue('A2', 'No Data Available');
}
else {
	$selectSubject1 = "SELECT date FROM `attendance` WHERE studentName = '$studentName' AND studentRoll = '$studentRoll' AND subject = '$subject1' AND attendance = 'P' ORDER BY date ASC";
	$resultSubject1 = mysqli_query($conn, $selectSubject1);
	if(mysqli_num_rows($resultSubject1) > 0){
		$rowDate = 2;
		while ($dateRow = mysqli_fetch_assoc($resultSubject1)) {
			$sheet->setCellValue('A'. $rowDate, $dateRow['date']);
			$rowDate++;
		}
	}
	$selectSubject2 = "SELECT date FROM `attendance` WHERE studentName = '$studentName' AND studentRoll = '$studentRoll' AND subject = '$subject2' AND attendance = 'P' ORDER BY date ASC";
	$resultSubject2 = mysqli_query($conn, $selectSubject2);
	if(mysqli_num_rows($resultSubject2) > 0){
		$rowDate = 2;
		while ($dateRow = mysqli_fetch_assoc($resultSubject2)) {
      $sheet->setCellValue('B'. $rowDate, $dateRow['date']);
      $rowDate++;
    }
  }
	$selectSubject3 = "SELECT date FROM `attendance` WHERE studentName = '$studentName' AND studentRoll = '$studentRoll' AND subject = '$subject3' AND attendance = 'P' ORDER BY date ASC";
	$resultSubject3 = mysqli_query($conn, $selectSubject3);
	if(mysqli_num_rows($resultSubject3) > 0){
		$rowDate = 2;
    while ($dateRow = mysqli_fetch_assoc($resultSubject3)) {
      $sheet->setCellValue('C'. $rowDate, $dateRow['date']);
      $rowDate++;
    }
  }
  $selectSubject4 = "SELECT date FROM `attendance` WHERE studentName = '$studentName' AND studentRoll = '$studentRoll' AND subject = '$subject4' AND attendance = 'P' ORDER BY date ASC";
	$resultSubject4 = mysqli_query($conn, $selectSubject4);
	if(mysqli_num_rows($resultSubject4) > 0){
		$rowDate = 2;
    while ($dateRow = mysqli_fetch_assoc($resultSubject4)) {
      $sheet->setCellValue('D'. $rowDate, $dateRow['date']);
      $rowDate++;
    }
  }
  $selectSubject5 = "SELECT date FROM `attendance` WHERE studentName = '$studentName' AND studentRoll = '$studentRoll' AND subject = '$subject5' AND attendance = 'P' ORDER BY date ASC";
  $resultSubject5 = mysqli_query($conn, $selectSubject5);
	if(mysqli_num_rows($resultSubject5) > 0){
		$rowDate = 2;
    while ($dateRow = mysqli_fetch_assoc($resultSubject5)) {
      $sheet->setCellValue('E'. $rowDate, $dateRow['date']);
      $rowDate++;
    }
  }
  $selectSubject6 = "SELECT date FROM `attendance` WHERE studentName = '$studentName' AND studentRoll = '$studentRoll' AND subject = '$subject6' AND attendance = 'P' ORDER BY date ASC";
  $resultSubject6 = mysqli_query($conn, $selectSubject6);
  if(mysqli_num_rows($resultSubject6) > 0){
		$rowDate = 2;
		while ($dateRow = mysqli_fetch_assoc($resultSubject6)) {
      $sheet->setCellValue('F'. $rowDate, $dateRow['date']);
      $rowDate++;
    }
	}
	$selectSubject7 = "SELECT date FROM `attendance` WHERE studentName = '$studentName' AND studentRoll = '$studentRoll' AND subject = '$subject7' AND attendance = 'P' ORDER BY date ASC";
	$resultSubject7 = mysqli_query($conn, $selectSubject7);
	if(mysqli_num_rows($resultSubject7) > 0){
		$rowDate = 2;
    while ($dateRow = mysqli_fetch_assoc($resultSubject7)) {
      $sheet->setCellValue('G'. $rowDate, $dateRow['date']);
      $rowDate++;
    }
	}
}

// Save Excel file
$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$filename = $studentName . '.xlsx';

// Download the Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');