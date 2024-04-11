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
$sheet->setCellValue('B1', "Roll No.");
$sheet->setCellValue('C1', "Semester");
$sheet->setCellValue('D1', "Subject1");
$sheet->setCellValue('E1', "Subject2");
$sheet->setCellValue('F1', "Subject3");
$sheet->setCellValue('G1', "Subject4");
$sheet->setCellValue('H1', "Subject5");
$sheet->setCellValue('I1', "Subject6");
$sheet->setCellValue('J1', "Subject7");

// Save Excel file
$writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$filename = 'StudentTimeTableFormat.xlsx';

// Download the Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');