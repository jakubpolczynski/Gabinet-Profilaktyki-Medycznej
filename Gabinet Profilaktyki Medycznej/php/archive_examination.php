<?php
    include "../php/config.php";
    // Pobieramy dane z żądania
    $dateL = $_POST['dateL'];
    $dateR = $_POST['dateR'];
    $type = $_POST['type'];

    /////////// POBIERAMY ID UCZNIA I ID KLASY Z BAZY SZKOŁY ///////////

    // Tworzymy połączenie z bazą danych szkoły
    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

     // Sprawdzamy czy połączenie jest poprawne
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($type == "badaniapielegniarskie") {
        if(!empty($dateL) && empty($dateR)) {
            $sql = "SELECT * FROM $type WHERE dataBadania >= $dateL";
            $set = 0;
        }
        
        if(empty($dateL) && !empty($dateR)) {
            $sql = "SELECT * FROM $type WHERE dataBadania <= $dateR";
            $set = 0;
        }

        if(!empty($dateL) && !empty($dateR)) {
            $sql = "SELECT * FROM $type WHERE dataBadania >= $dateL AND dataBadania <= $dateR";
            $set = 0;
        }
    }

    if ($type == "badaniaprzesiewowe") {
        if(!empty($dateL) && empty($dateR)) {
            $sql = "SELECT * FROM $type WHERE dataBilansu >= $dateL";
            $set = 1;
        }
        
        if(empty($dateL) && !empty($dateR)) {
            $sql = "SELECT * FROM $type WHERE dataBilansu <= $dateR";
            $set = 1;
        }

        if(!empty($dateL) && !empty($dateR)) {
            $sql = "SELECT * FROM $type WHERE dataBilansu >= $dateL AND dataBilansu <= $dateR";
            $set = 1;
        }
    }

    // Jeśli znaleziono uczniów, wysyłamy opodwiedź "Znaleziono osoby"
    if ($set == 0)
    {
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result))
            {
                echo $row['dataBadania'].";";
                echo $row['godzinaBadania'].";";
                echo $row['powodBadania'].";";
                echo $row['przeprowadzoneCzynnosci'].";"; 
                echo $row['uwagi']."|";
            }
        }
    }

    if ($set == 1)
    {
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result))
            {
                echo $row['dataBilansu'].";";
                echo $row['wzrost'].";";
                echo $row['waga']."|";
            }
        }
    }
    
    mysqli_close($conn);
    
?>

