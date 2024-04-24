<?php
// Include database and start sessions
include "database.php";
session_start();

// Checking user is logged as admin or not
if (!isset($_SESSION['staffLogged'])) {
    header('Location: ../../index.php');
    exit(); // Always exit after header redirects
}

// Checking data passed or not
$staffName = $_SESSION['staffName'];
$subject = $_GET['subject'];
$time = $_GET['time'];
if ($subject == null || $time == null) {
    header('Location: staffDashboard.php');
    exit(); // Always exit after header redirects
}
else{
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
}

// Load PhpSpreadsheet library
require '../../vendor/autoload.php';

// Create new PhpSpreadsheet instance
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

if($time == 'Sem'){
    $sheet->setCellValue('A1', 'Teacher Name');
    $sheet->setCellValue('B1', 'Semester');
    $sheet->setCellValue('C1', 'Subject');
    $sheet->setCellValue('D1', 'Total Lectures');

    $query = "SELECT DISTINCT DATE(date) as total_taken FROM `attendance` WHERE teacherName = '$staffName' AND subject = '$subject' AND period = 'Prac/Tut-1'";
    $query2 = "SELECT DISTINCT DATE(date) as total_taken FROM `attendance` WHERE teacherName = '$staffName' AND subject = '$subject' AND period = 'Prac/Tut-2'";
    $result = mysqli_query($conn, $query);
    $result2 = mysqli_query($conn, $query2);
    $count1 = mysqli_num_rows($result);
    $count2 = mysqli_num_rows($result2);
    $count = $count1 + $count2;

    $sheet->setCellValue('A2', $staffName);
    $sheet->setCellValue('B2', '');
    $sheet->setCellValue('C2', $subject);
    $sheet->setCellValue('D2', $count);
}
else{
    $sheet->setCellValue('A1', 'Teacher Name');
    $sheet->setCellValue('B1', 'Month');
    $sheet->setCellValue('C1', 'Subject');
    $sheet->setCellValue('D1', 'Total Lectures');

    $query = "SELECT DISTINCT DATE(date) as total_taken FROM `attendance` WHERE teacherName = '$staffName' AND subject = '$subject' AND period = 'Prac/Tut-1' AND month(date) = $month";
    $query2 = "SELECT DISTINCT DATE(date) as total_taken FROM `attendance` WHERE teacherName = '$staffName' AND subject = '$subject' AND period = 'Prac/Tut-2' AND month(date) = $month";
    $result = mysqli_query($conn, $query);
    $result2 = mysqli_query($conn, $query2);
    $count1 = mysqli_num_rows($result);
    $count2 = mysqli_num_rows($result2);
    $count = $count1 + $count2;

    $sheet->setCellValue('A2', $staffName);
    $sheet->setCellValue('B2', $month . ' - ' . date('Y'));
    $sheet->setCellValue('C2', $subject);
    $sheet->setCellValue('D2', $count);
}



// Set headers
$sheet->setCellValue('A4', 'Student Name');
$sheet->setCellValue('B4', 'Roll No.');

// Query to fetch distinct dates for the subject
if($time == 'Sem'){
    $dateQuery = "SELECT DISTINCT DATE(date) AS attendanceDate FROM `attendance` WHERE teacherName = '$staffName' AND subject LIKE '%$subject%' AND period = 'Prac/Tut-1' ORDER BY attendanceDate ASC";
}
else{
    $dateQuery = "SELECT DISTINCT DATE(date) AS attendanceDate FROM `attendance` WHERE teacherName = '$staffName' AND subject LIKE '%$subject%' AND period = 'Prac/Tut-1' AND month(date) = $month ORDER BY attendanceDate ASC";
}
$dateResult = mysqli_query($conn, $dateQuery);

if (mysqli_num_rows($dateResult) > 0) {
    $colIndex = 'C'; // Start from column C (after 'Student Name' and 'Roll No.')
    $rowIndex = 5; // Start from row 2

    // Query to fetch student names and roll numbers
    $studentQuery = "SELECT DISTINCT studentName, studentRoll FROM `attendance` WHERE teacherName = '$staffName' AND subject LIKE '%$subject%' ORDER BY studentRoll ASC";
    $studentResult = mysqli_query($conn, $studentQuery);

    if ($studentResult) {
        // Loop through each student
        while ($studentRow = mysqli_fetch_assoc($studentResult)) {
            $sheet->setCellValue('A' . $rowIndex, $studentRow['studentName']);
            $sheet->setCellValue('B' . $rowIndex, $studentRow['studentRoll']);

            // Loop through each date to fetch attendance
            mysqli_data_seek($dateResult, 0); // Reset dateResult pointer
            while ($dateRow = mysqli_fetch_assoc($dateResult)) {
                $attendanceDate = $dateRow['attendanceDate'];
                $sheet->setCellValue($colIndex . 4, $attendanceDate);
                $name = $studentRow['studentName'];
                $roll = $studentRow['studentRoll'];
                $selectDate2 = "SELECT DISTINCT DATE(date) AS attendanceDate2 FROM `attendance` WHERE teacherName = '$staffName' AND subject LIKE '%$subject%' AND period = 'Prac/Tut-2' AND date = '$attendanceDate'";
                $resultDate2 = mysqli_query($conn, $selectDate2);
                if (mysqli_num_rows($resultDate2) > 0) {
                    // Query to fetch attendance for each student and date
                    $attendanceQuery = "SELECT attendance FROM `attendance` WHERE teacherName = '$staffName' AND subject LIKE '%$subject%' AND period = 'Prac/Tut-1' AND date = '$attendanceDate' AND studentName = '$name' AND studentRoll = '$roll'";
                    $attendanceResult = mysqli_query($conn, $attendanceQuery);
                    if ($attendanceResult) {
                        $attendanceData = mysqli_fetch_assoc($attendanceResult);
                        $attend = ($attendanceData !== null && isset($attendanceData['attendance'])) ? $attendanceData['attendance'] : 'A';
                        $sheet->setCellValue($colIndex . $rowIndex, $attend);
                    }
                    $colIndex++;
                    $attendanceDate = $dateRow['attendanceDate'];
                    $sheet->setCellValue($colIndex . 4, $attendanceDate);
                    $attendanceQuery2 = "SELECT attendance FROM `attendance` WHERE teacherName = '$staffName' AND subject AND '%$subject%' AND period = 'Prac/Tut-2' AND date = '$attendanceDate' AND studentName = '$name' AND studentRoll = '$roll'";
                    $attendanceResult2 = mysqli_query($conn, $attendanceQuery2);
                    if ($attendanceResult2) {
                        $attendanceData2 = mysqli_fetch_assoc($attendanceResult2);
                        $attend2 = ($attendanceData2 !== null && isset($attendanceData2['attendance'])) ? $attendanceData2['attendance'] : 'A';
                        $sheet->setCellValue($colIndex . $rowIndex, $attend2);
                    }
                    $colIndex++;
                }
                else{
                    // Query to fetch attendance for each student and date
                    $attendanceQuery = "SELECT attendance FROM `attendance` WHERE teacherName = '$staffName' AND subject LIKE '%$subject%' AND period = 'Theory-1' AND date = '$attendanceDate' AND studentName = '$name' AND studentRoll = '$roll'";
                    $attendanceResult = mysqli_query($conn, $attendanceQuery);
                    if ($attendanceResult) {
                        $attendanceData = mysqli_fetch_assoc($attendanceResult);
                        $attend = ($attendanceData !== null && isset($attendanceData['attendance'])) ? $attendanceData['attendance'] : 'A';
                        $sheet->setCellValue($colIndex . $rowIndex, $attend);
                    }
                    $colIndex++;
                }
            }

            $rowIndex++;
            $colIndex = 'C'; // Reset column index for the next student
        }
    } else {
        echo "<script>alert('Error occurred while fetching student data');</script>";
        echo "<script>window.location.href ='staffDashboard.php';</script>";
        exit(); // Always exit after header redirects
    }
} else {
    echo "<script>alert('Error occurred while fetching date data');</script>";
    echo "<script>window.location.href ='staffDownloadPrac.php?subject={$subject}';</script>";
    exit(); // Always exit after header redirects
}

// Save Excel file
$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$filename = $subject . '-prac-tut-' . $time . '.xlsx';

// Download the Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');