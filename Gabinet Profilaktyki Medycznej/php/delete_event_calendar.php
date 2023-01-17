<?php
    include "../php/config.php";
    // Pobieramy dane z żądania
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
    $sql = "SELECT id FROM terminarz WHERE data='$date' AND godzina='$time'";
    $result=mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $id = $row['id'];
    }
    $sql = "DELETE FROM terminarz WHERE id='$id'";
    $result=mysqli_query($conn, $sql);
    // Jeśli usunięto wydarzenie, wysyłamy opodwiedź "success"
    if($result != 1) {
        echo "Błąd usuwania wydarzenia";
    }
    else {
        echo "success|";
    }
    mysqli_close($conn);
?>

