<?php
    include "../php/config.php";
    // Pobieramy dane z żądania
    $date = $_POST['date'];
    $date = date("Y-m-d", strtotime($date));


    // Tworzymy połączenie z bazą danych
    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

    // Sprawdzamy czy połączenie jest poprawne
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    } 

    // Tworzymy zapytanie do bazy danych
    $sql = "SELECT * FROM terminarz WHERE data='$date'";
    $result = mysqli_query($conn, $sql);

    // Jeśli znaleziono wydarzenia, wysyłamy opodwiedź "success"
    if(mysqli_num_rows($result)>0) {
        echo "success|";
        while($row = mysqli_fetch_assoc($result))
        {
            sendEvent($row);
        }
    }
    else {
        echo "Brak wydarzeń";
    }
    function sendEvent($row)
    {
       echo $row["godzina"]." ";
       echo $row['opisWydarzenia']."|"; 
    }
    mysqli_close($conn);
?>

