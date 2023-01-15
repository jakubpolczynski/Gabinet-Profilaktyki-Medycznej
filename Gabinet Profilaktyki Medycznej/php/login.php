<?php
    include "../php/config.php";
    // Pobieramy dane z żądania
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Tworzymy połączenie z bazą danych
    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

    // Sprawdzamy czy połączenie jest poprawne
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    } 

    // Tworzymy zapytanie do bazy danych
    $sql = "SELECT * FROM admini WHERE login='$username' AND haslo='$password'";
    $result = mysqli_query($conn, $sql);

    // Jeśli znaleziono użytkownika, ustawiamy sesję i wysyłamy odpowiedź "success"
    if (mysqli_num_rows($result) > 0) {
    session_start();
    $_SESSION['logged_in'] = true;
    $_SESSION['username'] = $username;
    echo "success";
    } else {
    // W przeciwnym razie wyświetlamy błąd
    echo "error: Invalid username or password";
    }
    mysqli_close($conn);
?>
