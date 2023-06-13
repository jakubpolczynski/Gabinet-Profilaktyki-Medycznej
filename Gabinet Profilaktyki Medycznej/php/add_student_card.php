<?php
    include "../php/config.php";

    $imie_ojca=$_POST['imie_ojca'];
    $imie_matki=$_POST['imie_matki'];
    $wyksztalcenie_ojca=$_POST['wyksztalcenie_ojca'];
    $wyksztalcenie_matki=$_POST['wyksztalcenie_matki'];
    $zawod_ojca=$_POST['zawod_ojca'];
    $zawod_matki=$_POST['zawod_matki'];
    $stan_zdrowia_ojca=$_POST['stan_zdrowia_ojca'];
    $stan_zdrowia_matki=$_POST['stan_zdrowia_matki'];
    $rok_urodzenia_rodzenstwa_dziecka=$_POST['rok_urodzenia_rodzenstwa_dziecka'];
    $stan_zdrowia_rodzenstwa_dziecka=$_POST['stan_zdrowia_rodzenstwa_dziecka'];
    $warunki_mieszkaniowe=$_POST['warunki_mieszkaniowe'];
    $problemy_w_rodzinie=$_POST['problemy_w_rodzinie'];
    $zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie=$_POST['zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie'];
    $przebyte_choroby=$_POST['przebyte_choroby'];
    $uczulenia=$_POST['uczulenia'];
    $objawy_uczulenia=$_POST['objawy_uczulenia'];
    $sluch=$_POST['sluch'];
    $wzrok=$_POST['wzrok'];
    $zez=$_POST['zez'];
    $uzywanie=$_POST['uzywanie'];
    $leki=$_POST['leki'];
    $dolegliwosci_objawy=$_POST['dolegliwosci_objawy'];
    $uwagi_rodzicow=$_POST['uwagi_rodzicow'];
    $inne_uwagi=$_POST['inne_uwagi'];
    $wymowa=$_POST['wymowa'];
    $sprawnosc_fizyczna=$_POST['sprawnosc_fizyczna'];
    $uzdolnienia=$_POST['uzdolnienia'];
    $zachowanie=$_POST['zachowanie'];
    $wyniki_w_nauce=$_POST['wyniki_w_nauce'];
    $absencja_szkolna=$_POST['absencja_szkolna'];
    $trudnosci_szkolne=$_POST['trudnosci_szkolne'];
    $relacje_z_rowiesnikami=$_POST['relacje_z_rowiesnikami'];
    $inne_uwagi_wychowawcy=$_POST['inne_uwagi_wychowawcy'];
    $rozwoj_fizyczny=$_POST['rozwoj_fizyczny'];
    $dojrzewanie_plciowe=$_POST['dojrzewanie_plciowe'];
    $tarczyca=$_POST['tarczyca'];
    $rozwoj_psychospoleczny=$_POST['rozwoj_psychospoleczny'];
    $uklad_ruchu=$_POST['uklad_ruchu'];
    $skora=$_POST['skora'];
    $jama_ustna=$_POST['jama_ustna'];
    $pozostale_uklady=$_POST['pozostale_uklady'];
    $problem_zdrowotny=$_POST['problem_zdrowotny'];
    $grupa_na_wf=$_POST['grupa_na_wf'];
    $moze_uczestniczyc_w_zawodach=$_POST['moze_uczestniczyc_w_zawodach'];
    $ograniczenie_dotyczace_wyboru_i_nauki_zawodu=$_POST['ograniczenie_dotyczace_wyboru_i_nauki_zawodu'];
    $zalecenia=$_POST['zalecenia'];
    $imie_ucznia=$_POST['imie_ucznia'];
    $nazwisko_ucznia=$_POST['nazwisko_ucznia'];

    $conn_szkola = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname_szkola);

    if (!$conn_szkola) {
        die("Connection failed: " . mysqli_connect_error());
    } 

    $sql_student = "SELECT * FROM uczniowe WHERE imie=`$imie_ucznia` AND nazwisko=`$nazwisko_ucznia`"
    $result_student = mysqli_query($conn_szkola, $sql_student);

    if(mysqli_num_rows($result_student) > 0) {
        echo "Znaleziono osoby";
        while ($row = mysqli_fetch_assoc($result_student)){
            $id_uczen = $row['id_uczen'];

        }
    }
    else{
        echo "Brak osob";
    }

    mysqli_close($conn_szkola);

    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

    $sql = "INSERT INTO kartaucznia (
        imie_ojca,
        imie_matki,
        wyksztalcenie_ojca,
        wyksztalcenie_matki,
        zawod_ojca,
        zawod_matki,
        stan_zdrowia_ojca,
        stan_zdrowia_matki,
        rok_urodzenia_rodzenstwa_dziecka,
        stan_zdrowia_rodzenstwa_dziecka,
        warunki_mieszkaniowe,
        problemy_w_rodzinie,
        zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie,
        przebyte_choroby,
        uczulenia,
        objawy_uczulenia,
        sluch,
        wzrok,
        zez,
        uzywanie,
        leki,
        dolegliwosci_objawy,
        uwagi_rodzicow,
        inne_uwagi,
        wymowa,
        sprawnosc_fizyczna,
        uzdolnienia,
        zachowanie,
        wyniki_w_nauce,
        absencja_szkolna,
        trudnosci_szkolne,
        relacje_z_rowiesnikami,
        inne_uwagi_wychowawcy,
        rozwoj_fizyczny,
        dojrzewanie_plciowe,
        tarczyca,
        rozwoj_psychospoleczny,
        uklad_ruchu,
        skora,
        jama_ustna,
        pozostale_uklady,
        problem_zdrowotny,
        grupa_na_wf,
        moze_uczestniczyc_w_zawodach,
        ograniczenie_dotyczace_wyboru_i_nauki_zawodu,
        zalecenia,
        imie_ucznia,
        nazwisko_ucznia
    ) VALUES (
        '$id_uczen',
        '$imie_ojca',
        '$imie_matki',
        '$wyksztalcenie_ojca',
        '$wyksztalcenie_matki',
        '$zawod_ojca',
        '$zawod_matki',
        '$stan_zdrowia_ojca',
        '$stan_zdrowia_matki',
        '$rok_urodzenia_rodzenstwa_dziecka',
        '$stan_zdrowia_rodzenstwa_dziecka',
        '$warunki_mieszkaniowe',
        '$problemy_w_rodzinie',
        '$zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie',
        '$przebyte_choroby',
        '$uczulenia',
        '$objawy_uczulenia',
        '$sluch',
        '$wzrok',
        '$zez',
        '$uzywanie',
        '$leki',
        '$dolegliwosci_objawy',
        '$uwagi_rodzicow',
        '$inne_uwagi',
        '$wymowa',
        '$sprawnosc_fizyczna',
        '$uzdolnienia',
        '$zachowanie',
        '$wyniki_w_nauce',
        '$absencja_szkolna',
        '$trudnosci_szkolne',
        '$relacje_z_rowiesnikami',
        '$inne_uwagi_wychowawcy',
        '$rozwoj_fizyczny',
        '$dojrzewanie_plciowe',
        '$tarczyca',
        '$rozwoj_psychospoleczny',
        '$uklad_ruchu',
        '$skora',
        '$jama_ustna',
        '$pozostale_uklady',
        '$problem_zdrowotny',
        '$grupa_na_wf',
        '$moze_uczestniczyc_w_zawodach',
        '$ograniczenie_dotyczace_wyboru_i_nauki_zawodu',
        '$zalecenia',
        '$imie_ucznia',
        '$nazwisko_ucznia'
    )";

    if($conn->query($sql) === TRUE){
        echo "Dodano karte ucznia";
    }
    else{
        echo "Błąd dodawania danych";
    }
    mysqli_close($conn);



?>  