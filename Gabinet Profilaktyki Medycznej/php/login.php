<?php
include "../php/config.php";
$link = mysqli_connect($host, $username, $password, $dbname);
if(!$link)
{
    die("Błąd połączenia z bazą danych".mysqli_connect_error());
}
if(isset($_POST['submit']))
{
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $query = "SELECT * FROM admini WHERE login = '$username' AND haslo = '$password'";
    
    $result = mysqli_query($link, $query);

    if(mysqli_num_rows($result) == 1)
    {
        session_start();
        $_SESSION['username'] = $username;
        header('Location: ../pages/start_page.html');
    }
    else
    {
        setcookie("error","Błąd");
    }
}
?>