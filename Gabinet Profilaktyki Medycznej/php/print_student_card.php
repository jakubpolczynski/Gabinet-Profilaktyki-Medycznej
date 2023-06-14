<?php
    include "../php/config.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname']; 
    
    $id_uczen = "Brak ucznia";

    $conn_szkola = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname_szkola);
    
    if (!$conn_szkola) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql_student = "SELECT * FROM uczniowie WHERE imie='$fname' AND nazwisko='$lname'";

    $result_student = mysqli_query($conn_szkola, $sql_student);
    if (mysqli_num_rows($result_student) > 0){
        while($row = mysqli_fetch_assoc($result_student)){
            $id_uczen = $row['id_uczen'];
            $id_klasy = $row['id_klasy'];
        }
    }
    else{
        
    }

    mysqli_close($conn_szkola);

    if ($id_uczen === 'Brak ucznia')
    {
        echo "Brak ucznia";
    }
    else{
        $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

        if(!$conn){
            die("Connection failed: ".mysqli_connect_error());
        }

        $sql_screening = "SELECT * FROM badaniaprzesiewowe WHERE id_ucznia='$id_uczen'";
        $sql_student_card = "SELECT * FROM kartaucznia WHERE id_ucznia='$id_uczen'";

        $result_screening = mysqli_query($conn, $sql_screening);
        $result_student_card = mysqli_query($conn, $sql_student_card);

        if (mysqli_num_rows($result_screening) > 0){
            while ($row = mysqli_fetch_assoc($result_screening)){
                $id_ucznia = $row['id_ucznia'];
                $id_klasy = $row['id_klasy'];

                $conn1 = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname_szkola);
                
                $sql_uczen = "SELECT * FROM uczniowie WHERE id_uczen='$id_ucznia'";
                $sql_klasa = "SELECT * FROM klasy WHERE id_klasy='$id_klasy'";
                
                $result_u = mysqli_query($conn1, $sql_uczen);
                $result_k = mysqli_query($conn1, $sql_klasa);

                echo "---------- - Informacje o uczniu;";
                while($row_u = mysqli_fetch_assoc($result_u)){
                    echo 'Imie - '.$row_u['imie'].";";
                    echo 'Nazwisko - '.$row_u['nazwisko'].";";
                }
                while($row_k = mysqli_fetch_assoc($result_k)){
                    echo 'Klasa - '.$row_k['nazwaKlasy'].";";
                }
                echo "---------- - Informacje pielegniarki o uczniu;";

                echo 'Data badania - '.$row['dataBilansu'].";";
                echo 'Wzrost - '.$row['wzrost'].";";
                echo 'Waga - '.$row['waga'].";"; 
                echo 'Ciśnienie - '.$row['cisnienie'].";"; 
                echo 'Uwagi - '.$row['inneUwagi']."|"; 
            }
        }

        if($row = mysqli_fetch_assoc($result_student_card))
        {
            echo 'Imie ojca - '.$row['imie_ojca'].";";
            echo 'Imie matki - '.$row['imie_matki'].";";
            echo 'Wykształcenie ojca - '.$row['wyksztalcenie_ojca'].";";
            echo 'Wykształcenie matki - '.$row['wyksztalcenie_matki'].";";
            echo 'Zawód ojca - '.$row['zawod_ojca'].";";
            echo 'Zawód matki - '.$row['zawod_matki'].";";
            echo 'Stan zdrowia ojca - '.$row['stan_zdrowia_ojca'].";";
            echo 'Stan zdrowia matki - '.$row['stan_zdrowia_matki'].";";
            echo 'Rok urodzenia rodzeństwa - '.$row['rok_urodzenia_rodzenstwa_dziecka'].";";
            echo 'Stan zdrowia rodzeństwa - '.$row['stan_zdrowia_rodzenstwa_dziecka'].";";
            echo 'Warunki mieszkaniowe - '.$row['warunki_mieszkaniowe'].";";
            echo 'Problemy w rodzinie - '.$row['problemy_w_rodzinie'].";";
            echo 'Zachowanie zdrowotne w rodzinie - '.$row['zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie'].";";
            echo 'Przebyte choroby - '.$row['przebyte_choroby'].";";
            echo 'Uczulenia - '.$row['uczulenia'].";";
            echo 'Objawy uczulenia - '.$row['objawy_uczulenia'].";";
            echo 'Słuch - '.$row['sluch'].";";
            echo 'Wzrok - '.$row['wzrok'].";";
            echo 'Zez - '.$row['zez'].";";
            echo 'Używanie - '.$row['uzywanie'].";";
            echo 'Leki - '.$row['leki'].";";
            echo 'Dolegliwości i objawy - '.$row['dolegliwosci_objawy'].";";
            echo 'Uwagi rodziców - '.$row['uwagi_rodzicow'].";";
            echo 'Inne uwagi - '.$row['inne_uwagi'].";";
            echo 'Wymowa - '.$row['wymowa'].";";
            echo 'Sprawność fizyczna - '.$row['sprawnosc_fizyczna'].";";
            echo 'Uzdolnienia - '.$row['uzdolnienia'].";";
            echo 'Zachowanie - '.$row['zachowanie'].";";
            echo 'Wyniki w nauce - '.$row['wyniki_w_nauce'].";";
            echo 'Absencja szkolna - '.$row['absencja_szkolna'].";";
            echo 'Trudności szkolne - '.$row['trudnosci_szkolne'].";";
            echo 'Relacje z rówieśnikami - '.$row['relacje_z_rowiesnikami'].";";
            echo 'Inne uwagi wychowawcy - '.$row['inne_uwagi_wychowawcy'].";";
            echo 'Rozwój fizyczny - '.$row['rozwoj_fizyczny'].";";
            echo 'Dojrzewanie płciowe - '.$row['dojrzewanie_plciowe'].";";
            echo 'Tarczyca - '.$row['tarczyca'].";";
            echo 'Rozwój psychospołeczny - '.$row['rozwoj_psychospoleczny'].";";
            echo 'Układ ruchu - '.$row['uklad_ruchu'].";";
            echo 'Skóra - '.$row['skora'].";";
            echo 'Jama ustna - '.$row['jama_ustna'].";";
            echo 'Pozostałe układy - '.$row['pozostale_uklady'].";";
            echo 'Problem zdrowotny - '.$row['problem_zdrowotny'].";";
            echo 'Grupa na WF - '.$row['grupa_na_wf'].";";
            echo 'Może uczestniczyć w zawodach - '.$row['moze_uczestniczyc_w_zawodach'].";";
            echo 'Ograniczenie dot. zawodu - '.$row['ograniczenie_dotyczace_wyboru_i_nauki_zawodu'].";";
            echo 'Zalecenia - '.$row['zalecenia']."|";
        }

        mysqli_close($conn);
        mysqli_close($conn1);
    }
    

?>