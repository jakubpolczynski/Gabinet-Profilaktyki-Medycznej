function createEvents()
{
    // pobierz wszystkie komórki z kalendarza
    const cells = document.querySelectorAll("#calendar td");
    console.log(cells)
    // pobierz okno modalne
    const modal = document.getElementById("event-modal");
    // pobierz przycisk zamykania okna modalnego
    const closeButton = document.querySelector(".close");

    // dodaj obsługę kliknięcia na komórki kalendarza
    cells.forEach(function(cell) 
    {
        cell.addEventListener("click", function() 
        {
            // ustaw wartość pola formularza "event-date" na wybrany dzień
            document.getElementById("event-date").value = this.textContent;
            // pokaż okno modalne
            modal.style.display = "block";
        });
    });

    // dodaj obsługę kliknięcia na przycisk zamykania okna modalnego
    closeButton.addEventListener("click", function() 
    {
        // ukryj okno modalne
        modal.style.display = "none";
    });

    // dodaj obsługę kliknięcia poza oknem modalnym
    window.addEventListener("click", function(event) 
    {
        if (event.target == modal) {
            // ukryj okno modalne
            modal.style.display = "none";
        }
    });

    
}

window.addEventListener("load", createEvents)

function addEvent() 
    {
        const modal = document.getElementById("event-modal");
        // pobierz dane wydarzenia z pól formularza
        const name = document.getElementById("event-name").value;
        const date = document.getElementById("event-date").value;
        const time = document.getElementById("event-time").value;

        // sprawdź, czy wszystkie pola formularza są wypełnione
        if (name && date && time) 
        {
            // wszystkie pola są wypełnione, więc można dodać wydarzenie
            // tutaj możesz dodać kod, który wysyła dane wydarzenia do bazy danych lub zapisuje je w pliku
            // ...

            // ukryj okno modalne
            modal.style.display = "none";
            // wyświetl komunikat o pomyślnym dodaniu wydarzenia
            alert("Wydarzenie zostało dodane");
        } 
        else 
        {
            // w przeciwnym razie wyświetl komunikat o błędzie
            alert("Wypełnij wszystkie pola formularza");
        }
    }