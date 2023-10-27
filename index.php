<?php
require 'vendor/autoload.php';
require_once 'Models/workersclass.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$inputFileName = 'Workers.xlsx';

$spreadsheet = IOFactory::load($inputFileName);

$activeWorksheet = $spreadsheet->getActiveSheet();

$highestRow = $activeWorksheet->getHighestRow();

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Имя');
$sheet->setCellValue('B1', 'Должность');
$sheet->setCellValue('C1', 'ДР');
$sheet->setCellValue('D1', 'Год устройства');
$sheet->setCellValue('E1', 'Опыт');
$sheet->setCellValue('F1', 'Возраст');


$row = 2;


while ($row <= $highestRow) {
    $name = $activeWorksheet->getCell("A$row")->getValue();
    $work = $activeWorksheet->getCell("B$row")->getValue();
    $birthday = $activeWorksheet->getCell("C$row")->getFormattedValue();
    $year = $activeWorksheet->getCell("D$row")->getFormattedValue();
    $worker = new Worker($name, $work, $birthday, $year);
    $workers[] = $worker;


$row++;
}

$worker1 = new Worker('Иван Синев Федорович', 'Консультант', '20.03.2000', '2021');
$worker2 = new Worker('Федорович Синев Иванович', 'Консультант', '20.03.2000', '2021');
$workers[] = $worker1;
$workers[] = $worker2;
$row=2;
foreach ($workers as $work){
    $sheet->setCellValue("A$row", $work->name);
    $sheet->setCellValue("B$row", $work->work);
    $sheet->setCellValue("C$row", $work->birthday);
    $sheet->setCellValue("D$row", $work->year);
    $sheet->setCellValue("E$row", $work->experience);
    $sheet->setCellValue("F$row", $work->age);
    $row++;
    echo "Имя:$work->name;&nbsp Должность:$work->work;&nbsp ДР:$work->birthday;&nbsp  Год устройства:$work->year;&nbsp  Опыт:$work->experience;&nbsp Возраст:$work->age<br>";
}

$writer = new Xlsx($spreadsheet);

$outputFileName = 'NewWorkers.xlsx';

$writer->save($outputFileName);

echo "Данные сохранены в $outputFileName";