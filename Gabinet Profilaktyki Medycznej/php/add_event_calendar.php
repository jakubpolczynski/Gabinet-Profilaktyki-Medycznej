<?php
    include "../php/config.php";
    // Pobieramy dane z żądania
    $name = $_POST['name'];
    $date = $_POST['date'];
    $date = date("Y-m-d", strtotime($date));
    $time = $_POST['time'];


    // Tworzymy połączenie z bazą danych
    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

    // Sprawdzamy czy połączenie jest poprawne
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    } 

    // Tworzymy zapytanie do bazy danych
    $sql = "SELECT * FROM terminarz WHERE data='$date' AND godzina='$time'";
    $result = mysqli_query($conn, $sql);

    // Jeśli nie znaleziono wydarzenia, wysyłamy opodwiedź "success" oraz dodajemy wydarzenie
    if(mysqli_num_rows($result)>0) {
        echo "Wydarzenie już istnieje";
    }
    else {
        $sql = "INSERT INTO terminarz (
            data, 
            godzina, 
            opisWydarzenia
            ) VALUES (
                '$date',
                '$time',
                '$name')";
        if($conn->query($sql) === TRUE){
            echo "success";
        }
        else{
            echo "Błąd dodawania danych";
        }
    }
    mysqli_close($conn);
?>