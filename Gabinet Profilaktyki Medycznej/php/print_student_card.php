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
            echo "|";
            while ($row = mysqli_fetch_assoc($result_screening)){
                $id_ucznia = $row['id_ucznia'];
                $id_klasy = $row['id_klasy'];

                $conn1 = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname_szkola);
                
                $sql_uczen = "SELECT * FROM uczniowie WHERE id_uczen='$id_ucznia'";
                $sql_klasa = "SELECT * FROM klasy WHERE id_klasy='$id_klasy'";
                
                $result_u = mysqli_query($conn1, $sql_uczen);
                $result_k = mysqli_query($conn1, $sql_klasa);

                echo "Informacje o uczniu;";
                while($row_u = mysqli_fetch_assoc($result_u)){
                    echo $row_u['imie'].";";
                    echo $row_u['nazwisko'].";";
                }
                while($row_k = mysqli_fetch_assoc($result_k)){
                    echo $row_k['nazwaKlasy'].";";
                }
                echo "Informacje pielegniarki o uczniu";

                echo $row['dataBilansu'].";";
                echo $row['wzrost'].";";
                echo $row['waga'].";"; 
                echo $row['cisnienie'].";"; 
                echo $row['inneUwagi']."|"; 
            }
        }

        if($row = mysqli_fetch_assoc($result_student_card))
        {
            echo $row['imie_ojca'].";";
            echo $row['imie_matki'].";";
            echo $row['wyksztalcenie_ojca'].";";
            echo $row['wyksztalcenie_matki'].";";
            echo $row['zawod_ojca'].";";
            echo $row['zawod_matki'].";";
            echo $row['stan_zdrowia_ojca'].";";
            echo $row['stan_zdrowia_matki'].";";
            echo $row['rok_urodzenia_rodzenstwa_dziecka'].";";
            echo $row['stan_zdrowia_rodzenstwa_dziecka'].";";
            echo $row['warunki_mieszkaniowe'].";";
            echo $row['problemy_w_rodzinie'].";";
            echo $row['zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie'].";";
            echo $row['przebyte_choroby'].";";
            echo $row['uczulenia'].";";
            echo $row['objawy_uczulenia'].";";
            echo $row['sluch'].";";
            echo $row['wzrok'].";";
            echo $row['zez'].";";
            echo $row['uzywanie'].";";
            echo $row['leki'].";";
            echo $row['dolegliwosci_objawy'].";";
            echo $row['uwagi_rodzicow'].";";
            echo $row['inne_uwagi'].";";
            echo $row['wymowa'].";";
            echo $row['sprawnosc_fizyczna'].";";
            echo $row['uzdolnienia'].";";
            echo $row['zachowanie'].";";
            echo $row['wyniki_w_nauce'].";";
            echo $row['absencja_szkolna'].";";
            echo $row['trudnosci_szkolne'].";";
            echo $row['relacje_z_rowiesnikami'].";";
            echo $row['inne_uwagi_wychowawcy'].";";
            echo $row['rozwoj_fizyczny'].";";
            echo $row['dojrzewanie_plciowe'].";";
            echo $row['tarczyca'].";";
            echo $row['rozwoj_psychospoleczny'].";";
            echo $row['uklad_ruchu'].";";
            echo $row['skora'].";";
            echo $row['jama_ustna'].";";
            echo $row['pozostale_uklady'].";";
            echo $row['problem_zdrowotny'].";";
            echo $row['grupa_na_wf'].";";
            echo $row['moze_uczestniczyc_w_zawodach'].";";
            echo $row['ograniczenie_dotyczace_wyboru_i_nauki_zawodu'].";";
            echo $row['zalecenia']."|";
        }

        mysqli_close($conn);
        mysqli_close($conn1);
    }
    

?>