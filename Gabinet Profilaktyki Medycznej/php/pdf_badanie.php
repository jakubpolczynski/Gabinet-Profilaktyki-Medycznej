<?php
ob_end_clean();
require('../fpdf/tfpdf.php');

$imie = $_POST['Firstname'];
$nazwisko = $_POST['Surname'];

// $imie = 'Jan';
// $nazwisko = 'Dzban';

$plik = $imie.$nazwisko.'.pdf';

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename='.$plik);

$pielegniarka = $_POST['nurse'];
$godzina = $_POST['time'];
$przyczyna_badania = $_POST['reason'];
$opis = $_POST['description'];
$uwagi = $_POST['comments'];
$data = $_POST['date'];

// $data = '14-06-2023';
// $pielegniarka = 'Barbara Kowalska';
// $godzina = '12:30';
// $przyczyna_badania = 'Ból głowy';
// $opis = 'zmierzenie temperatury (36,6), podanie leku przecibólowego';
// $uwagi = 'Brak';


$pdf = new tFPDF();
  
$pdf->AddFont('PL', 'B', 'DejaVuSans.ttf', true);

//Add a new page
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70);
$pdf->Cell(100, 10, 'Karta badania pielegniarskiego');

$pdf->SetFont('PL', '', 11);
$pdf->Ln(12);
$pdf->Cell(10);
$pdf->Line(20, 20, 210-20, 20);
$pdf->Write(4, 'INFORMACJE PIELĘGNIARKI/HIGIENISTKI SZKOLNEJ ');

$pdf->Ln(6);
$pdf->SetFont('PL', '', 8);
$pdf->Cell(25);
$pdf->Cell(35, 5, $imie.' '.$nazwisko);
$pdf->Cell(30);
$pdf->Cell(20, 5, $data);
$pdf->Cell(30);
$pdf->Cell(25, 5, $godzina);
$pdf->Ln(1);
$pdf->Cell(10);
$pdf->Write(5, 'Uczeń..........................................................    Data..................................     Godzina..................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'Przyczyna badania:');

$pdf->Ln(4);
$pdf->Cell(10);
$pdf->Cell(0, 5, $przyczyna_badania, '', 0, 'C');
$pdf->Ln(1);
$pdf->Cell(10);
$pdf->Write(5, '.......................................................................................................................................................................................');


$pdf->Ln(4);
$pdf->Cell(10);
$pdf->Write(5, 'Opis wykonanych czynności:');

$pdf->Ln(4);
$pdf->Cell(10);
$pdf->Cell(0, 5, $opis, '', 0, 'C');
$pdf->Ln(1);
$pdf->Cell(10);
$pdf->Write(5, '.......................................................................................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'Inne uwagi:');

$pdf->Ln(4);
$pdf->Cell(10);
$pdf->Cell(0, 5, $uwagi, '', 0, 'C');
$pdf->Ln(1);
$pdf->Cell(10);
$pdf->Write(5, '.......................................................................................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'Badanie przeprowadzone przez:');

$pdf->Ln(4);
$pdf->Cell(10);
$pdf->Cell(0, 5, $pielegniarka, '', 0, 'C');
$pdf->Ln(1);
$pdf->Cell(10);
$pdf->Write(5, '.......................................................................................................................................................................................');


$pdf->Ln(20);
$pdf->Cell(10);
$pdf->Cell(30);
$pdf->Cell(50);
$pdf->Cell(0, 5, 'podpis i pieczęć pielęgniarki szkolnej....................................');

// $pdf->Output();
$pdf->Output('F', '../pdfFile/'.$plik);

?>