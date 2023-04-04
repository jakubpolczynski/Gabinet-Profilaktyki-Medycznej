<?php
    include "../php/config.php";
    // Pobieramy dane z żądania
    $date = $_POST['date'];
    $date = date("Y-m-d", strtotime($date));
    $time = $_POST['time'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pesel = $_POST['pesel'];
    $nurse = $_POST['nurse'];
    $reason = $_POST['reason'];
    $description = $_POST['description'];
    $comments = $_POST['comments'];

    /////////// POBIERAMY ID UCZNIA I ID KLASY Z BAZY SZKOŁY ///////////

    // Tworzymy połączenie z bazą danych szkoły
    $conn_szkola = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname_szkola);

     // Sprawdzamy czy połączenie jest poprawne
    if (!$conn_szkola) {
        die("Connection failed: " . mysqli_connect_error());
    } 
    
    // Tworzymy zapytanie do bazy danych
    $sql_student = "SELECT * FROM uczniowie WHERE imie='$fname' AND nazwisko='$lname'";
    $result_student = mysqli_query($conn_szkola, $sql_student);
    
    // Jeśli znaleziono uczniów, wysyłamy opodwiedź "Znaleziono osoby"
    if(mysqli_num_rows($result_student) > 0) {
        echo "Znaleziono osoby";
        while($row = mysqli_fetch_assoc($result_student))
        {
            echo $row['id_uczen'];
            $id_uczen = $row['id_uczen'];
            $id_klasy = $row['id_klasy'];
        }
    }
    else {
        echo "Brak osób";
    }

    mysqli_close($conn_szkola);



    /////////// DODAJEMY UZYSKANE DANE DO BAZY GABINETU ///////////

    // Tworzymy połączenie z bazą danych gabinetu
    $conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

    // Tworzymy zapytanie o id pielęgniarki
    $sql_nurseID = "SELECT * 
                    FROM pielegniarki 
                    WHERE pielegniarki.login = '$nurse'";

    $result_nurseID = mysqli_query($conn, $sql_nurseID);

    // Jeśli znaleziono pielęgniarkę, wysyłamy opodwiedź "Znaleziono pielęgniarkę"
    if(mysqli_num_rows($result_nurseID) > 0) {
        echo "Znaleziono pielęgniarkę";
        while($row = mysqli_fetch_assoc($result_nurseID))
        {
            $id_pielegniarki = $row['id_pielegniarki'];
        }
    }
    else {
        echo "Brak pielęgniarek";
    }

    // Tworzymy zapytanie do bazy danych
    $sql = "SELECT * FROM badaniapielegniarskie WHERE id_ucznia='$id_uczen' AND dataBadania='$date' AND godzinaBadania='$time'";
    $result = mysqli_query($conn, $sql);

    // Jeśli nie znaleziono badania, wysyłamy opodwiedź "Dodano nowe badanie" oraz dodajemy badanie
    if(mysqli_num_rows($result)>0) {
        echo "Badanie już istnieje";
    }
    else {
        $sql = "INSERT INTO badaniapielegniarskie (
            id_ucznia, 
            id_klasy, 
            id_pielegniarki,
            dataBadania,
            godzinaBadania,
            powodBadania,
            przeprowadzoneCzynnosci,
            uwagi
            ) VALUES (
                '$id_uczen',
                '$id_klasy',
                '$id_pielegniarki',
                '$date',
                '$time',
                '$reason',
                '$description',
                '$comments')";

        if($conn->query($sql) === TRUE){
            echo "Dodano nowe badanie";
        }
        else{
            echo "Błąd dodawania danych";
        }
    }
    mysqli_close($conn);
?>