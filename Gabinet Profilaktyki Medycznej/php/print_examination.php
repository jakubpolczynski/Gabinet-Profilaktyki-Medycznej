<?php
    include "../php/config.php";
    // Pobieramy dane z żądania
    $dateL = $_POST['dateL'];
    $dateR = $_POST['dateR'];
    $class = $_POST['stClass'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    /////////// POBIERAMY ID UCZNIA I ID KLASY Z BAZY SZKOŁY ///////////

    // Tworzymy połączenie z bazą danych szkoły
    $conn_szkola = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname_szkola);

     // Sprawdzamy czy połączenie jest poprawne
    if (!$conn_szkola) {
        die("Connection failed: " . mysqli_connect_error());
    } 
    
    // Tworzymy zapytanie do bazy danych
    if (!empty($fname) && empty($lname)) {
        $sql_student = "SELECT * FROM uczniowie WHERE imie='$fname'";
        $setS = 1;
    }
    elseif (empty($fname) && !empty($lname)) {
        $sql_student = "SELECT * FROM uczniowie WHERE nazwisko='$lname'";
        $setS = 1;
    }
    elseif (!empty($fname) && !empty($lname)) {
        $sql_student = "SELECT * FROM uczniowie WHERE imie='$fname' AND nazwisko='$lname'";
        $setS = 1;
    }
    
    
    // Jeśli znaleziono uczniów, wysyłamy opodwiedź "Znaleziono osoby"
    if ($setS == 1)
    {
        $result_student = mysqli_query($conn_szkola, $sql_student);
        if(mysqli_num_rows($result_student) > 0) {
            while($row = mysqli_fetch_assoc($result_student))
            {
                $id_uczen = $row['id_uczen'];
            }
        }
    }

    /////////// POBIERAMY ID KLASY Z BAZY SZKOŁY ///////////
    
    // Tworzymy zapytanie do bazy danych
    $sql_student = "SELECT * FROM klasy WHERE nazwaKlasy='$class'";
    $result_student = mysqli_query($conn_szkola, $sql_student);
    
    // Jeśli znaleziono uczniów, wysyłamy opodwiedź "Znaleziono osoby"
    if(mysqli_num_rows($result_student) > 0) {
        while($row = mysqli_fetch_assoc($result_student))
        {
            $id_klasa = $row['id_klasy'];
        }
    }

    mysqli_close($conn_szkola);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // Tworzymy połączenie z bazą danych
    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

    // Sprawdzamy czy połączenie jest poprawne
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    } 


    // Sprawdź, ile pól formularza zostało wypełnionych
    if (!empty($dateL) && empty($dateR) && empty($class) && empty($fname) && empty($lname)) {
        // Zostało wypełnione tylko pole 1
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL'";
        $set = 1;
    } elseif (empty($dateL) && !empty($dateR) && empty($class) && empty($fname) && empty($lname)) {
        // Zostało wypełnione tylko pole 2
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania<'$dateR'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu<'$dateR'";
        $set = 1;
    } elseif (empty($dateL) && empty($dateR) && !empty($class) && empty($fname) && empty($lname)) {
        // Zostało wypełnione tylko pole 3
        $sql = "SELECT * FROM badaniapielegniarskie WHERE id_klasy='$id_klasa'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE id_klasy='$id_klasa'";
        $set = 1;
    } elseif (empty($dateL) && empty($dateR) && empty($class) && !empty($fname) && empty($lname)) {
        // Zostało wypełnione tylko pole 4
        $sql = "SELECT * FROM badaniapielegniarskie WHERE id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (empty($dateL) && empty($dateR) && empty($class) && empty($fname) && !empty($lname)) {
        // Zostało wypełnione tylko pole 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (!empty($dateL) && !empty($dateR) && empty($class) && empty($fname) && empty($lname)) {
        // Zostały wypełnione pola 1 i 2
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND dataBadania<'$dateR'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND dataBilansu<'$dateR'";
        $set = 1;
    } elseif (!empty($dateL) && empty($dateR) && !empty($class) && empty($fname) && empty($lname)) {
        // Zostały wypełnione pola 1 i 3
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND id_klasy='$id_klasa'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND id_klasy='$id_klasa'";
        $set = 1;
    } elseif (!empty($dateL) && empty($dateR) && empty($class) && !empty($fname) && empty($lname)) {
        // Zostały wypełnione pola 1 i 4
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (!empty($dateL) && empty($dateR) && empty($class) && empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 1 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (!empty($dateL) && !empty($dateR) && !empty($class) && empty($fname) && empty($lname)) {
        // Zostały wypełnione pola 1, 2 i 3
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND dataBadania<'$dateR' AND id_klasy='$id_klasa'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND dataBilansu<'$dateR' AND id_klasy='$id_klasa'";
        $set = 1;
    } elseif (!empty($dateL) && !empty($dateR) && !empty($class) && !empty($fname) && empty($lname)) {
        // Zostały wypełnione pola 1, 2, 3 i 4
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND dataBadania<'$dateR' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND dataBilansu<'$dateR' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (!empty($dateL) && !empty($dateR) && !empty($class) && empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 1, 2, 3 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND dataBadania<'$dateR' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND dataBilansu<'$dateR' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (!empty($dateL) && !empty($dateR) && empty($class) && !empty($fname) && empty($lname)) {
        // Zostały wypełnione pola 1, 2 i 4
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND dataBadania<'$dateR' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND dataBilansu<'$dateR' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (!empty($dateL) && !empty($dateR) && empty($class) && empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 1, 2 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND dataBadania<'$dateR' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND dataBilansu<'$dateR' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (!empty($dateL) && !empty($dateR) && empty($class) && !empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 1, 2, 4 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND dataBadania<'$dateR' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND dataBilansu<'$dateR' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (!empty($dateL) && !empty($dateR) && !empty($class) && !empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 1, 2, 3, 4 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND dataBadania<'$dateR' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND dataBilansu<'$dateR' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (!empty($dateL) && empty($dateR) && !empty($class) && !empty($fname) && empty($lname)) {
        // Zostały wypełnione pola 1, 3, i 4
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (!empty($dateL) && empty($dateR) && !empty($class) && empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 1, 3, i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (!empty($dateL) && empty($dateR) && !empty($class) && !empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 1, 3, 4 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (!empty($dateL) && empty($dateR) && empty($class) && !empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 1, 4 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (empty($dateL) && !empty($dateR) && !empty($class) && empty($fname) && empty($lname)) {
        // Zostały wypełnione pola 2 i 3
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania<'$dateR' AND id_klasy='$id_klasa'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu<'$dateR' AND id_klasy='$id_klasa'";
        $set = 1;
    } elseif (empty($dateL) && !empty($dateR) && empty($class) && !empty($fname) && empty($lname)) {
        // Zostały wypełnione pola 2 i 4
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania<'$dateR' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu<'$dateR' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (empty($dateL) && !empty($dateR) && empty($class) && empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 2 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania<'$dateR' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu<'$dateR' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (empty($dateL) && !empty($dateR) && !empty($class) && !empty($fname) && empty($lname)) {
        // Zostały wypełnione pola 2, 3 i 4
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania<'$dateR' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu<'$dateR' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (empty($dateL) && !empty($dateR) && !empty($class) && empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 2, 3 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania<'$dateR' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu<'$dateR' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (empty($dateL) && !empty($dateR) && !empty($class) && !empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 2, 3, 4 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania<'$dateR' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu<'$dateR' AND id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (empty($dateL) && !empty($dateR) && empty($class) && !empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 2, 4 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania<'$dateR' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu<'$dateR' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (empty($dateL) && empty($dateR) && !empty($class) && !empty($fname) && empty($lname)) {
        // Zostały wypełnione pola 3 i 4
        $sql = "SELECT * FROM badaniapielegniarskie WHERE id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (empty($dateL) && empty($dateR) && !empty($class) && empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 3 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (empty($dateL) && empty($dateR) && !empty($class) && !empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 3, 4 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE id_klasy='$id_klasa' AND id_ucznia='$id_uczen'";
        $set = 1;
    } elseif (empty($dateL) && empty($dateR) && empty($class) && !empty($fname) && !empty($lname)) {
        // Zostały wypełnione pola 4 i 5
        $sql = "SELECT * FROM badaniapielegniarskie WHERE id_ucznia='$id_uczen'";
        $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE id_ucznia='$id_uczen'";
        $set = 1;
    }

   
    if ($set == 1)
    {
        $result = mysqli_query($conn, $sql);

        // Jeśli znaleziono wydarzenia, wysyłamy opodwiedź "success"
        if(mysqli_num_rows($result)>0) {
            echo "|";
            
            while($row = mysqli_fetch_assoc($result))
            {
                $id_ucznia = $row['id_ucznia'];
                $id_klasy = $row['id_klasy'];
    
                $conn1 = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname_szkola);
    
                $sql_uczen = "SELECT * FROM uczniowie WHERE id_uczen='$id_ucznia'";
                $sql_klasa = "SELECT * FROM klasy WHERE id_klasy='$id_klasy'";
    
                $result_u = mysqli_query($conn1, $sql_uczen);
                $result_k = mysqli_query($conn1, $sql_klasa);
    
                echo "Rodzaj badania - Badanie pielęgniarskie;";
                while($row_u = mysqli_fetch_assoc($result_u))
                {
                    echo 'Imie - '.$row_u['imie'].";";
                    echo 'Nazwisko - '.$row_u['nazwisko'].";";
                }
                while($row_k = mysqli_fetch_assoc($result_k))
                {
                    echo 'Klasa - '.$row_k['nazwaKlasy'].";";
                }
    
                echo 'Data badania - '.$row['dataBadania'].";";
                echo 'Godzina badania - '.$row['godzinaBadania'].";";
                echo 'Powód badania - '.$row['powodBadania'].";";
                echo 'Przeprowadzone czynności - '.$row['przeprowadzoneCzynnosci'].";"; 
                echo 'Uwagi - '.$row['uwagi']."|";
            }
        }
        
    
        // Tworzymy zapytanie do bazy danych
        $result1 = mysqli_query($conn, $sql1);
    
        // Jeśli znaleziono wydarzenia, wysyłamy opodwiedź "success"
        if(mysqli_num_rows($result1)>0) {

            while($row = mysqli_fetch_assoc($result1))
            {
                $id_ucznia = $row['id_ucznia'];
                $id_klasy = $row['id_klasy'];
    
                $conn1 = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname_szkola);
    
                $sql_uczen = "SELECT * FROM uczniowie WHERE id_uczen='$id_ucznia'";
                $sql_klasa = "SELECT * FROM klasy WHERE id_klasy='$id_klasy'";
    
                $result_u = mysqli_query($conn1, $sql_uczen);
                $result_k = mysqli_query($conn1, $sql_klasa);
    
                echo "Rodzaj badania - Badanie przesiewowe;";
                while($row_u = mysqli_fetch_assoc($result_u))
                {   
                    echo 'Imie - '.$row_u['imie'].";";
                    echo 'Nazwisko - '.$row_u['nazwisko'].";";
                }
                while($row_k = mysqli_fetch_assoc($result_k))
                {
                    echo 'Klasa - '.$row_k['nazwaKlasy'].";";
                }
    
                echo 'Data badania - '.$row['dataBilansu'].";";
                echo 'Wzrost - '.$row['wzrost'].";";
                echo 'Waga - '.$row['waga'].";"; 
                echo 'Ciśnienie - '.$row['cisnienie'].";"; 
                echo 'Uwagi - '.$row['inneUwagi']."|"; 
            }
        }
    
        mysqli_close($conn1);
        mysqli_close($conn);
    }
    
?>

