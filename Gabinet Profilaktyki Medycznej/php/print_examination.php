<?php
    include "../php/config.php";
    // Pobieramy dane z żądania
    $dateL = $_POST['dateL'];
    $dateL = date("Y-m-d", strtotime($dateL));
    $dateR = $_POST['dateR'];
    $dateR = date("Y-m-d", strtotime($dateR));
    $class = $_POST['stClass'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    // Tworzymy połączenie z bazą danych
    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

    // Sprawdzamy czy połączenie jest poprawne
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    } 

//     // Tworzymy zapytanie do bazy danych
// // Sprawdź, ile pól formularza zostało wypełnionych
// if (!empty($pole1) && empty($pole2) && empty($pole3) && empty($pole4)) {
//     // Zostało wypełnione tylko pole 1
//     $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL'";
// } elseif (empty($pole1) && !empty($pole2) && empty($pole3) && empty($pole4)) {
//     // Zostało wypełnione tylko pole 2
//     $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania<'$dateR'";
// } elseif (empty($pole1) && empty($pole2) && !empty($pole3) && empty($pole4)) {
//     // Zostało wypełnione tylko pole 3
//     $sql = "SELECT * FROM badaniapielegniarskie WHERE imie='$fname'";
// } elseif (empty($pole1) && empty($pole2) && empty($pole3) && !empty($pole4)) {
//     // Zostało wypełnione tylko pole 4
//     // ...
// } elseif (!empty($pole1) && !empty($pole2) && empty($pole3) && empty($pole4)) {
//     // Zostały wypełnione pola 1 i 2
//     // ...
// } elseif (!empty($pole1) && empty($pole2) && !empty($pole3) && empty($pole4)) {
//     // Zostały wypełnione pola 1 i 3
//     // ...
// } elseif (!empty($pole1) && empty($pole2) && empty($pole3) && !empty($pole4)) {
//     // Zostały wypełnione pola 1 i 4
//     // ...
// } elseif (empty($pole1) && !empty($pole2) && !empty($pole3) && empty($pole4)) {
//     // Zostały wypełnione pola 2 i 3
//     // ...
// } elseif (empty($pole1) && !empty($pole2) && empty($pole3) && !empty($pole4)) {
//     // Zostały wypełnione pola 2 i 4
//     // ...
// } elseif (empty($pole1) && empty($pole2) && !empty($pole3) && !empty($pole4)) {
//     // Zostały wypełnione pola 3 i 4
//     // ...
// } elseif (!empty($pole1) && !empty($pole2) && !empty($pole3) && empty($pole4)) {
//     // Zostały wypełnione pola 1, 2 i 3
//     // ...
// } elseif (!empty($pole1) && !empty($pole2) && empty($pole3) && !empty($pole4)) {
//     // Zostały wypełnione pola 1, 2 i 4
//     //
// }
// elseif (!empty($pole1) && !empty($pole2) && !empty($pole3) && !empty($pole4)) {
//     // Zostały wypełnione pola 1, 2 i 4
//     //
// }

    $sql = "SELECT * FROM badaniapielegniarskie WHERE dataBadania>'$dateL'";
    

    $result = mysqli_query($conn, $sql);



    // Jeśli znaleziono wydarzenia, wysyłamy opodwiedź "success"
    if(mysqli_num_rows($result)>0) {
        echo "success|";
        
        while($row = mysqli_fetch_assoc($result))
        {
            $id_ucznia = $row['id_ucznia'];
            $id_klasy = $row['id_klasy'];

            $conn1 = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname_szkola);

            $sql_uczen = "SELECT * FROM uczniowie WHERE id_uczen='$id_ucznia'";
            $sql_klasa = "SELECT * FROM klasy WHERE id_klasy='$id_klasy'";

            $result_u = mysqli_query($conn1, $sql_uczen);
            $result_k = mysqli_query($conn1, $sql_klasa);
            while($row_u = mysqli_fetch_assoc($result_u))
            {
                echo $row_u['imie'].";";
                echo $row_u['nazwisko'].";";
            }
            while($row_k = mysqli_fetch_assoc($result_k))
            {
                echo $row_k['nazwaKlasy'].";";
            }

            echo $row['dataBadania'].";";
            echo $row['godzinaBadania'].";";
            echo $row['powodBadania']."|"; 
        }
    }
    else {
        echo "Brak wydarzeń";
    }

    // Tworzymy zapytanie do bazy danych
    $sql1 = "SELECT * FROM badaniaprzesiewowe WHERE dataBilansu>'$dateL'";
    $result1 = mysqli_query($conn, $sql1);

    // Jeśli znaleziono wydarzenia, wysyłamy opodwiedź "success"
    if(mysqli_num_rows($result1)>0) {
        echo "success|";

        while($row = mysqli_fetch_assoc($result1))
        {
            $id_ucznia = $row['id_ucznia'];
            $id_klasy = $row['id_klasy'];

            $conn1 = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname_szkola);

            $sql_uczen = "SELECT * FROM uczniowie WHERE id_uczen='$id_ucznia'";
            $sql_klasa = "SELECT * FROM klasy WHERE id_klasy='$id_klasy'";

            $result_u = mysqli_query($conn1, $sql_uczen);
            $result_k = mysqli_query($conn1, $sql_klasa);
            while($row_u = mysqli_fetch_assoc($result_u))
            {
                echo $row_u['imie'].";";
                echo $row_u['nazwisko'].";";
            }
            while($row_k = mysqli_fetch_assoc($result_k))
            {
                echo $row_k['nazwaKlasy'].";";
            }

            echo $row['dataBilansu'].";";
            echo $row['wzrost'].";";
            echo $row['waga']."|"; 
        }
    }
    else {
        echo "Brak wydarzeń";
    }


    function sendEvent($row)
    {
      
    }
    mysqli_close($conn1);
    mysqli_close($conn);
?>

