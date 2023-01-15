<?php
session_start();

if (isset($_POST['submit'])) {
    include "php/config.php";
    $link = mysqli_connect($host, $username, $password, $dbname);
    if (!$link) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $query = "SELECT * FROM admini WHERE login = '$username' AND haslo = '$password'";

    $result = mysqli_query($link, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header('Location: pages/start_page.html');
    } else 
    {
        header('Location: index.php?error=1');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gabinet Profilaktyki Medycznej</title>
    <link rel="shortcut icon" href="logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700;900&display=swap"
      rel="stylesheet"
    />
</head>
<body>
<p>Logowanie</p>
<form method="post" action="">
    <label for="username">Nazwa użytkownika:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Hasło:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <input type="submit" name="submit" value="Zaloguj">
</form>
<?php
    if (isset($_GET['error'])) {
        echo '<p> Błędny login lub hasło. </p>';
    }
?>
</body>
</html>
