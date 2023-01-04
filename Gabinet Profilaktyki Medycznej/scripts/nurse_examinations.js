function addExamination()
{
    // pobierz dane wydarzenia z pól formularza
    const student = document.getElementById("student-id").value;
    const date = document.getElementById("examination-date").value;
    const time = document.getElementById("examination-time").value;
    const activities = document.getElementById("examination-activities").value;
    const occasion = document.getElementById("examination-occasion").value;
    const remarks = document.getElementById("examination-remarks").value;

    // sprawdź, czy wszystkie pola formularza są wypełnione
    if (student && date && time && activities && occasion && remarks)
    {
        // wszystkie pola są wypełnione, więc można dodać wydarzenie
        // tutaj można dodać kod, który wysyła dane wydarzenia do bazy danych lub zapisuje je w pliku
        // ...

        // wyświetl komunikat o pomyślnym dodaniu wydarzenia
        alert("Badanie zostało dodane")
    }
    else
    {
        // w przeciwnym razie wyświetl komunikat o błędzie
        alert("Wypełnij wszystkie pola formularza")
    }
}