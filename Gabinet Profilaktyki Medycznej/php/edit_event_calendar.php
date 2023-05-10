<?php
    include "../php/config.php";
    // Pobieramy dane z żądania
    $currentDate = $_POST['currentDate'];
    $currentDate = date("Y-m-d", strtotime($currentDate));
    $currentTime = $_POST['currentTime'];
    $newName = $_POST['newName'];
    $newTime = $_POST['newTime'];

    // Tworzymy połączenie z bazą danych
    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

    // Sprawdzamy czy połączenie jest poprawne
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    } 

    // Tworzymy zapytanie do bazy danych
    $sql = "SELECT id FROM terminarz WHERE data='$currentDate' AND godzina='$newTime'";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0)
    {
        echo "Wydarzenie już istnieje";
    }
    else{
        $sql = "UPDATE terminarz SET godzina='$newTime', opisWydarzenia='$newName' WHERE data='$currentDate' AND godzina='$currentTime'";
        $result=mysqli_query($conn, $sql);
        // Jeśli usunięto wydarzenie, wysyłamy opodwiedź "success"
        if($result != 1) {
            echo "Błąd usuwania wydarzenia";
        }
        else {
            echo "success|";
        }
    }
    
    mysqli_close($conn);
?>