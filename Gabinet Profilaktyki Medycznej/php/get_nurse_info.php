<?php
    include "../php/config.php";
    // Pobieramy dane z żądania
    $username = $_POST['login'];


    // Tworzymy połączenie z bazą danych
    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

    // Sprawdzamy czy połączenie jest poprawne
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    } 

    // Tworzymy zapytanie do bazy danych
    $sql = "SELECT * FROM pielegniarki WHERE login='$username'";
    $result = mysqli_query($conn, $sql);

    // Jeśli znaleziono pielęgniarkę"
    if(mysqli_num_rows($result)>0) {
        while($row = mysqli_fetch_assoc($result))
        {
            echo $row['imie']." ".$row['nazwisko'];
        }
    }
    else {
        echo "Brak pielęgniarek";
    }

    mysqli_close($conn);
?>

