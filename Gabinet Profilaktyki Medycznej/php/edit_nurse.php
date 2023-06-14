<?php
    include "../php/config.php";
    //pobieranie danych
    $username=$_POST['username'];
    $newFirstname=$_POST['newFirstname'];
    $newSurname=$_POST['newSurname'];
    $newUsername=$_POST['newUsername'];
    $newPassword=$_POST['newPassword'];

    //polaczenie z baza
    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

    //sprawdzamy polaczenie
    if (!$conn) {
        die("Connection failed:" . mysqli_connect_error());
    }        
    //Sprawdzamy czy pielegniarka istnieje
    $sql = "SELECT imie, nazwisko FROM pielegniarki WHERE login='$username'";
    $result = mysqli_query($conn, $sql);
    if(!mysqli_num_rows($result)>0) {
        echo "Pielegniarka nie istnieje";
    }
    else {
        //Towrzymy zapytanie do bazy danych
        $sql = "UPDATE pielegniarki SET imie='$newFirstname', nazwisko='$newSurname', login='$newUsername', haslo='$newPassword' WHERE login='$username'";
        $result = mysqli_query($conn, $sql);
        if($result != 1) {
            echo "Błąd edycji";
        }
        else
            $sql = "UPDATE logowanie SET login='$newUsername', haslo='$newPassword'";
            $result = mysqli_query($conn, $sql);
            if($result != 1) {
                echo "Błąd edycji";
            }
            else {
                echo "success";
            }
    }


?>