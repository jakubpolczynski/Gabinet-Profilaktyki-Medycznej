<?php
    include "../php/config.php";
    // Pobieramy dane z żądania
    $dateL = $_POST['dateL'];
    $dateR = $_POST['dateR'];
    $type = $_POST['type'];

    /////////// POBIERAMY ID UCZNIA I ID KLASY Z BAZY SZKOŁY ///////////

    // Tworzymy połączenie z bazą danych szkoły
    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);
    $conn_arch = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname_archiwum);

     // Sprawdzamy czy połączenie jest poprawne
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($type == "badaniapielegniarskie") {
        if(!empty($dateL) && empty($dateR)) {
            $sql = "SELECT * FROM $type WHERE dataBadania >= '$dateL'";
            $set = 0;
            $sqlDEL = "DELETE FROM $type WHERE dataBadania >= '$dateL'";
        }
        
        if(empty($dateL) && !empty($dateR)) {
            $sql = "SELECT * FROM $type WHERE dataBadania <= '$dateR'";
            $set = 0;
            $sqlDEL = "DELETE FROM $type WHERE dataBadania <= '$dateR'";
        }

        if(!empty($dateL) && !empty($dateR)) {
            $sql = "SELECT * FROM $type WHERE dataBadania >= '$dateL' AND dataBadania <= '$dateR'";
            $set = 0;
            $sqlDEL = "DELETE FROM $type WHERE dataBadania >= '$dateL' AND dataBadania <= '$dateR'";
        }
    }

    if ($type == "badaniaprzesiewowe") {
        if(!empty($dateL) && empty($dateR)) {
            $sql = "SELECT * FROM $type WHERE dataBilansu >= '$dateL'";
            $set = 1;
            $sqlDEL = "DELETE FROM $type WHERE dataBilansu >= '$dateL'";
        }
        
        if(empty($dateL) && !empty($dateR)) {
            $sql = "SELECT * FROM $type WHERE dataBilansu <= '$dateR'";
            $set = 1;
            $sqlDEL = "DELETE FROM $type WHERE dataBilansu <= '$dateR'";
        }

        if(!empty($dateL) && !empty($dateR)) {
            $sql = "SELECT * FROM $type WHERE dataBilansu >= '$dateL' AND dataBilansu <= '$dateR'";
            $set = 1;
            $sqlDEL = "DELETE FROM $type WHERE dataBilansu >= '$dateL' AND dataBilansu <= '$dateR'";
        }
    }

    // Jeśli znaleziono uczniów, wysyłamy opodwiedź "Znaleziono osoby"
    if ($set == 0)
    {
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result))
            {
                $id_ucznia = $row['id_ucznia'];
                $id_klasy = $row['id_klasy'];
                $id_pielegniarki = $row['id_pielegniarki'];
                $data = $row['dataBadania'];
                $godzina = $row['godzinaBadania'];
                $powod = $row['powodBadania'];
                $czynnosci = $row['przeprowadzoneCzynnosci']; 
                $uwagi = $row['uwagi'];

                $sql1 = "INSERT INTO badaniapielegniarskie (
                    id_ucznia, 
                    id_klasy, 
                    id_pielegniarki,
                    dataBadania,
                    godzinaBadania,
                    powodBadania,
                    przeprowadzoneCzynnosci,
                    uwagi
                    ) VALUES (
                        '$id_ucznia',
                        '$id_klasy',
                        '$id_pielegniarki',
                        '$data',
                        '$godzina',
                        '$powod',
                        '$czynnosci',
                        '$uwagi')";

                # DODAWANIE DO TABELI ARCHIWUM_BADAN.SQL
                $result1 = mysqli_query($conn_arch, $sql1);

            }
        }
        
        # USUWANIE Z TABELI GABINET.SQL
        $result2 = mysqli_query($conn, $sqlDEL);
        
    }

    // Jeśli znaleziono uczniów, wysyłamy opodwiedź "Znaleziono osoby"
    if ($set == 1)
    {
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result))
            {
                $id_ucznia = $row['id_ucznia'];
                $id_klasy = $row['id_klasy'];
                $id_pielegniarki = $row['id_pielegniarki'];
                $data = $row['dataBilansu'];
                $wzrost = $row['wzrost'];
                $waga = $row['waga'];
                $BMI = $row['BMI']; 
                $wzrok = $row['wzrok'];
                $sluch = $row['sluch'];
                $cisnienie = $row['cisnienie'];
                $statyka = $row['statykaCiala'];
                $wada = $row['wadaWymowy'];
                $uwagi = $row['inneUwagi'];
                $obecnosc = $row['obecnosc'];

                $sql1 = "INSERT INTO badaniaprzesiewowe (
                    id_ucznia, 
                    id_klasy, 
                    id_pielegniarki,
                    dataBilansu,
                    wzrost,
                    waga,
                    BMI,
                    wzrok,
                    sluch,
                    cisnienie,
                    statykaCiala,
                    wadaWymowy,
                    inneUwagi,
                    obecnosc
                    ) VALUES (
                        '$id_ucznia',
                        '$id_klasy',
                        '$id_pielegniarki',
                        '$data',
                        '$wzrost',
                        '$waga',
                        '$BMI',
                        '$wzrok',
                        '$sluch',
                        '$cisnienie',
                        '$statyka',
                        '$wada',
                        '$uwagi',
                        '$obecnosc')";

                # DODAWANIE DO TABELI ARCHIWUM_BADAN.SQL
                $result1 = mysqli_query($conn_arch, $sql1);

            }
        }
        
        # USUWANIE Z TABELI GABINET.SQL
        $result2 = mysqli_query($conn, $sqlDEL);
        
    }
    
    mysqli_close($conn);
    
?>

