<?php
ob_end_clean();
require('../fpdf/tfpdf.php');


// function create_pdf($imie, $nazwisko, $wzrost, $masa, $bmi, $wzrok, $sluch, $statyka_ciala, $cisnienie, $uwagi){

// $klasa = '2a';

$imie = $_POST['Firstname'];
$nazwisko = $_POST['Surname'];

$plik = $imie.$nazwisko.'.pdf';

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename='.$plik);

// badanie

$wzrost = $_POST['height'];
$masa = $_POST['weight'];
$bmi = floatval($_POST['bmi']);
$bmi = strval($bmi);


$wzrok = $_POST['sight'];
$sluch = $_POST['hearing'];
$statyka_ciala = $_POST['statics'];
$cisnienie = $_POST['bloodPressure'];
$uwagi = $_POST['comments'];

// $imie = 'a';
// $nazwisko = 'a';
// $wzrost = 'a';
// $wzrok = 'a';
// $masa = 'a';
// $bmi = 'a';
// $sluch = 'a';
// $statyka_ciala = 'a';
// $cisnienie = 'a';
// $uwagi = 'a';


$pdf = new tFPDF();
  

//Add a new page
$pdf->AddPage();
  
// czcionka z polskimi znakami
$pdf->AddFont('PL', 'B', 'DejaVuSans.ttf', true);
$pdf->SetFont('Arial', 'B', 10);


$pdf->Cell(42);
$pdf->Cell(100, 10, 'Karta profilaktycznego badania lekarskiego ucznia klasy "...."');

$pdf->SetFont('PL', '', 8);
$pdf->Ln(4);
$pdf->Cell(45);
$pdf->Write(10, 'Kolejność wypełniania: 1-rodzic/opiekun, 2-pielęgniarka, 3-lekarz');

$pdf->Ln(20);
$pdf->Cell(10);
$pdf->Write(10, 'pieczęć szkoły');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(37);
$pdf->Cell(100, 10, 'Karta profilaktycznego badania lekarskiego ucznia klasy "...."');

$pdf->SetFont('PL', '', 8);
$pdf->Ln(4);
$pdf->Cell(40);
$pdf->Write(10, '(informacje tylko do użytku ochrony zdrowia, objęte tajemnicą zawodową)');

$pdf->Line(20, 51, 210-20, 51);

$pdf->Ln(8);
$pdf->Cell(48);
$pdf->Cell(90, 10, $imie.' '.$nazwisko);
$pdf->Cell(50, 10, '');
$pdf->Ln(5);
$pdf->Cell(10);

$pdf->Write(4, 'Nazwisko i imię ucznia................................................................................data urodzenia.....................................');

$pdf->Ln(6);
$pdf->SetFont('PL', '', 11);
$pdf->Cell(10);
$pdf->Write(4, '1.   INFORMACJE RODZICÓW O DZIECKU I RODZINIE ');

// TABELA

$pdf->Ln(6);
$pdf->Cell(10);
$pdf->Cell(34, 5, '', 1, 0, 'C');
$pdf->Cell(34, 5, 'OJCIEC', 1, 0, 'C');
$pdf->Cell(34, 5, 'MATKA', 1, 0, 'C');
$pdf->Cell(68, 5, 'RODZEŃSTWO DZIECKA', 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10);
$pdf->SetFont('PL', '', 9);
$pdf->Cell(34, 5, 'Imię', 1, 0, 'C');
$pdf->SetFont('PL', '', 6);
$pdf->Cell(34, 5, '', 1, 0, 'C');
$pdf->Cell(34, 5, '', 1, 0, 'C');
$pdf->SetFont('PL', '', 9);
$pdf->Cell(34, 5, 'Rok Urodzenia', 1, 0, 'C');
$pdf->Cell(34, 5, 'Stan Zdrowia', 1, 0, 'C');

$pdf->Ln();
$pdf->Cell(10);
$pdf->SetFont('PL', '', 9);
$pdf->Cell(34, 5, 'Wykształcenie', 1, 0, 'C');
$pdf->SetFont('PL', '', 6);
$pdf->Cell(34, 5, '', 1, 0, 'C');
$pdf->Cell(34, 5, '', 1, 0, 'C');
$pdf->SetFont('PL', '', 9);
$pdf->Cell(34, 5, '', 'R', 0, 'C');
$pdf->Cell(34, 5, '', 'R', 0, 'C');

$pdf->Ln();
$pdf->Cell(10);
$pdf->SetFont('PL', '', 9);
$pdf->Cell(34, 5, 'Zawód', 1, 0, 'C');
$pdf->SetFont('PL', '', 6);
$pdf->Cell(34, 5, '', 1, 0, 'C');
$pdf->Cell(34, 5, '', 1, 0, 'C');
$pdf->SetFont('PL', '', 9);
$pdf->Cell(34, 5, '', 'R', 0, 'C');
$pdf->Cell(34, 5, '', 'R', 0, 'C');

$pdf->Ln();
$pdf->Cell(10);
$pdf->SetFont('PL', '', 9);
$pdf->Cell(34, 5, 'Stan zdrowia', 1, 0, 'C');
$pdf->SetFont('PL', '', 6);
$pdf->Cell(34, 5, '', 1, 0, 'C');
$pdf->Cell(34, 5, '', 1, 0, 'C');
$pdf->SetFont('PL', '', 9);
$pdf->Cell(34, 5, '', 'RB', 0, 'C');
$pdf->Cell(34, 5, '', 'RB', 0, 'C');

// KONIEC TABELI

$pdf->Ln(6);
$pdf->Cell(120);
$pdf->Cell(37, 5, '');
$pdf->Cell(0, 5, '');
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10);
$pdf->Write(5, 'Warunki mieszkaniowe**: ');
$pdf->SetFont('PL', '', 10);
$pdf->Write(5, 'dobra, średnie, złe. Liczba izb..............................osób.....................');
$pdf->SetFont('Arial', 'B', 10);

$pdf->Ln(5);
$pdf->SetFont('PL', '', 10);
$pdf->Cell(90);
$pdf->Cell(80, 5, '');
$pdf->Ln(1);
$pdf->Cell(10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(37, 5, 'Problemy w rodzinie: ');
$pdf->SetFont('PL', '', 10);
$pdf->Cell(0, 5, '(zdrowotne, bytowe)...............................................................................');

$pdf->Ln(5);
$pdf->SetFont('PL', '', 10);
$pdf->Cell(100);
$pdf->Cell(70, 5, '');
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10);
$pdf->Cell(85, 5, 'Zachowania zdrowotne i antyzdrowotne w rodzinie: ');
$pdf->SetFont('PL', '', 10);
$pdf->Cell(0, 5, '.....................................................................');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10);
$pdf->Cell(0, 5, 'Przebyte przez dziecko choroby, urazy, operacje');

// TABELA 2

$pdf->Ln(5);
$pdf->SetFont('PL', '', 10);
$pdf->Cell(10);
$pdf->Cell(28, 5, 'Rok życia', 1, 0, 'C');
$pdf->Cell(54, 5, 'Rodzaj', 'TBR', 0, 'C');
$pdf->Cell(5);
$pdf->Cell(28, 5, 'Rok życia', 1, 0, 'C');
$pdf->Cell(54, 5, 'Rodzaj', 'TBR', 0, 'C');


$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Cell(28, 10, '', 'LRB', 0, 'C');
$pdf->Cell(54, 10, '', 'RB', 0, 'C');
$pdf->Cell(5);
$pdf->Cell(28, 10, '', 'LRB', 0, 'C');
$pdf->Cell(54, 10, '', 'RB', 0, 'C');

// KONIEC TABELI 2

$pdf->Ln(13);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10);
$pdf->Cell(30, 5, 'Czy dziecko:');

$pdf->SetFont('PL', '', 8);
$pdf->Ln(3);
$pdf->Cell(80);
$pdf->Cell(0, 5, '');
$pdf->Ln(1);
$pdf->Cell(13);
$pdf->Write(5, '- ma uczulenie (alergię)** NIE, TAK - na co................................................................................................................');

$pdf->Ln(3);
$pdf->Cell(50);
$pdf->Cell(0, 5, '');
$pdf->Ln(1);
$pdf->Cell(15);
$pdf->Write(5, 'objawy uczulenia......................................................................................................................................................');

$pdf->Ln(3);
$pdf->Cell(130);
$pdf->Cell(0, 5, '');
$pdf->Ln(1);
$pdf->Cell(13);
$pdf->Write(5, '- słyszy**: DOBRZE, ŹLE; widzi**: DOBRZE, ŹLE; ma zeza**: NIE, TAK.......................................................................');

$pdf->Ln(4);
$pdf->Cell(13);
$pdf->Write(5, '- używa**: okulary, aparat ortodontyczny, wkładki ortopedyczne..............................................................................');

$pdf->Ln(4);
$pdf->Cell(13);
$pdf->Write(5, '- przyjmuje leki**: NIE, TAK - jakie..............................................................................................................................');

$pdf->Ln(4);
$pdf->Cell(15);
$pdf->Write(5, '..................................................................................................................................................................................');

$pdf->Ln(4);
$pdf->Cell(13);
$pdf->Write(5, '- uczęszcza na zajęcia korekcyjne,**: NIE, TAK - jakie.................................................................................................');

$pdf->Ln(8);
$pdf->SetFont('PL', '', 10);
$pdf->Cell(10);
$pdf->Write(5, 'Dolegliwości i objawy, które występowały u dziecka w ostatnich 12 miesiącach**:');

$pdf->SetFont('PL', '', 8);
$pdf->Ln(4);
$pdf->Cell(13);
$pdf->Write(5, 'częste: bóle głowy, brzucha, biegunki, zaparcia, brak apetytu, nadmierny apetyt, dolegliwości, przy oddawaniu');

$pdf->Ln(4);
$pdf->Cell(13);
$pdf->Write(5, 'moczu, moczenie nocnem napady duszności, długotrwały kaszel, długotrwały katar, omdlenia, zaburzenia snu,');

$pdf->Ln(4);
$pdf->Cell(13);
$pdf->Write(5, 'tiki, jąkanie, zez: stałe lub czasem; inne - jakie...........................................................................................................');

$pdf->Ln(4);
$pdf->Cell(13);
$pdf->Write(5, '.....................................................................................................................................................................................');

$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10);
$pdf->Cell(38, 5, 'Zachowanie dziecka**:');
$pdf->SetFont('PL', '', 8);
$pdf->Write(6, 'nie budzi niepokoju, nadruchliwość, agresywność, nieśmiałość, płaczliwość, mała');

$pdf->Ln(5);
$pdf->Cell(13);
$pdf->Write(5, 'zaradność, trudności w samoobsłudze, inne niepokojące objawy................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '........................................................................................................................................................................................');

$pdf->Ln(5);
$pdf->SetFont('PL', '', 10);
$pdf->Cell(10);
$pdf->Cell(55, 5, 'Inne uwagi i życzenia rodziców');
$pdf->SetFont('PL', '', 8);
$pdf->Write(6, '...........................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '........................................................................................................................................................................................');

$pdf->Ln(10);
$pdf->Cell(10);
$pdf->Cell(30, 5, 'data..........................');
$pdf->Cell(50);
$pdf->Cell(0, 5, 'podpis matki lub ojca (opiekuna)............................................');

$pdf->Ln(44);
$pdf->Line(20, 265, 60, 265);
$pdf->SetFont('PL', '', 7);
$pdf->Cell(10);
$pdf->Write(5, '*właściwe podkreślić');


$pdf->AddPage();

$pdf->SetFont('PL', '', 11);
$pdf->Ln(12);
$pdf->Cell(10);
$pdf->Line(20, 20, 210-20, 20);
$pdf->Write(4, '2. INFORMACJE PIELĘGNIARKI/HIGIENISTKI SZKOLNEJ ');

$pdf->Ln(6);
$pdf->SetFont('PL', '', 8);
$pdf->Cell(37);
$pdf->Cell(17, 5, $wzrost);
$pdf->Cell(19);
$pdf->Cell(22, 5, $masa);
$pdf->Cell(25, 5, $bmi);
$pdf->Ln(1);
$pdf->Cell(10);
$pdf->Write(5, 'Wysokość ciała ...............cm    Masa Ciała .........kg     BMI...............kg/m2');

$pdf->Ln(4);
$pdf->Cell(10);
$pdf->Cell(0, 5, $wzrok, '', 0, 'C');
$pdf->Ln(1);
$pdf->Cell(10);
$pdf->Write(5, 'Wzrok: ..........................................................................................................................................................................');

$pdf->Ln(4);
$pdf->Cell(10);
$pdf->Cell(0, 5, $sluch, '', 0, 'C');
$pdf->Ln(1);
$pdf->Cell(10);
$pdf->Write(5, 'Słuch: ...........................................................................................................................................................................');

$pdf->Ln(4);
$pdf->Cell(10);
$pdf->Cell(0, 5, $statyka_ciala, '', 0, 'C');
$pdf->Ln(1);
$pdf->Cell(10);
$pdf->Write(5, 'Statyka ciała: ................................................................................................................................................................');

$pdf->Ln(4);
$pdf->Cell(10);
$pdf->Cell(0, 5, $cisnienie, '', 0, 'C');
$pdf->Ln(1);
$pdf->Cell(10);
$pdf->Write(5, 'Ciśnienie: ......................................................................................................................................................................');

$pdf->Ln(4);
$pdf->Cell(10);
$pdf->Cell(0, 5, $uwagi, '', 0, 'C');
$pdf->Ln(1);
$pdf->Cell(10);
$pdf->Write(5, 'Inne uwagi: ....................................................................................................................................................................');

$pdf->Ln(10);
$pdf->Cell(10);
$pdf->Cell(30, 5, 'data..........................');
$pdf->Cell(50);
$pdf->Cell(0, 5, 'podpis i pieczęć pielęgniarki szkolnej....................................');

$pdf->Line(20, 85, 210-20, 85);
$pdf->Ln(22);
$pdf->SetFont('PL', '', 11);
$pdf->Cell(10);
$pdf->Write(5, '3. WYNIK BADANIA LEKARSKIEGO');

$pdf->Ln(8);
$pdf->SetFont('PL', '', 8);
$pdf->Cell(10);
$pdf->Write(5, 'Rozwój fizyczny*: prawidłowy, niskorosłość, otyłość, niedobór masy ciała, inne odchylenia');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '.........................................................................................................................................................................................');

$pdf->Ln(10);
$pdf->Cell(10);
$pdf->Write(5, 'Układ ruchu*: prawidłowy, boczne skrzywienie kręgosłupa**...........................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'kolana koślawe, stopy płasko - koślawe, inne odchylenia**..............................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '..........................................................................................................................................................................................');

$pdf->Ln(10);
$pdf->Cell(10);
$pdf->Write(5, 'Rozwój psychospołeczny*: prawidłowy, nieprawidłowy**................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '..........................................................................................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'Mowa*: prawidłowa, nieprawidłowa');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'Lateralizacja*: prawostronna, lewostronna, skrzyżowana');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'Jama ustna**.....................................................................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '..........................................................................................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'Skóra**..............................................................................................................................................................................');

$pdf->Ln(10);
$pdf->Cell(10);
$pdf->Write(5, 'Jądra w mosznie (dotyczy chłopców)*: TAK, NIE**............................................................................................................');

$pdf->Ln(10);
$pdf->Cell(10);
$pdf->Write(5, 'Pozostałem układy*: prawidłowe, nieprawidłowe**..........................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '..........................................................................................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '..........................................................................................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'PROBLEM ZDROWOTNY - rozpoznanie..............................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '..........................................................................................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '..........................................................................................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'ZDROWOTNA DOJRZAŁOŚĆ SZKOLNA*: pełna, niepełna**................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '..........................................................................................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'KWALIFIKACJA DO ZAJĘĆ WF*: grupa A As B Bk C CL - ');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'zalecenia...................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '..........................................................................................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, 'ZALECENIA........................................................................................................................................................................');

$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '..........................................................................................................................................................................................');

$pdf->Ln(10);
$pdf->Cell(10);
$pdf->Cell(30, 5, 'data..........................');
$pdf->Cell(65);
$pdf->Cell(0, 5, 'podpis i pieczęć lekarza...........................................');

$pdf->Ln(16);
$pdf->Line(20, 265, 60, 265);
$pdf->SetFont('PL', '', 7);
$pdf->Cell(10);
$pdf->Write(5, '*właściwe podkreślić');
$pdf->Ln(5);
$pdf->Cell(10);
$pdf->Write(5, '**wpisać rodzaj odchyleń');



// $pdf->Output('D', 'doc.pdf');

$pdf->Output('F', '../pdfFile/'.$plik);
// $pdf->Output();


?>