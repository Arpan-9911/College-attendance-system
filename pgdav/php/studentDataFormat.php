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
$sheet->setCellValue('A1', "Student Name");
$sheet->setCellValue('B1', "College Roll No.");
$sheet->setCellValue('C1', "Email");
$sheet->setCellValue('D1', "Contact");
$sheet->setCellValue('E1', "Password");

// Save Excel file
$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$filename = 'StudentDataUploadFormat.xlsx';

// Download the Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');