<?php
//Sstart sessions
session_start();

// Checking user is logged as admin or not
if (!isset($_SESSION['adminLogged'])) {
	header('Location: ../../index.php');
	exit(); // Always exit after header redirects
}

// Load PhpSpreadsheet library
require '../../vendor/autoload.php';

// Create new PhpSpreadsheet instance
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set headers
$sheet->setCellValue('A1', "Teacher Name");
$sheet->setCellValue('B1', "Subject");
$sheet->setCellValue('C1', "Semester");

// Save Excel file
$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$filename = 'TeacherTimeTableFormat.xlsx';

// Download the Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');