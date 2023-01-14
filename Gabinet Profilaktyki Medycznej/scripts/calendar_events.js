function createEvents()
{
    // pobierz wszystkie komórki z kalendarza
    const cells = document.querySelectorAll("#calendar td");
    // pobierz okno modalne
    const modal = document.getElementById("event-modal");
    // pobierz przycisk zamykania okna modalnego
    const closeButton = document.querySelector(".close");
    // pobierz przycisk edytowania zdarzen 
    const btn = document.getElementById("btn-edit");

    // pobierz akutalny miesiac i rok na podstawie naszego kalendarza
    currMonth = document.getElementById("currMonthValue").textContent;
    currYear = document.getElementById("currYearValue").textContent;

    // dodaj obsługę kliknięcia na komórki kalendarza
    btn.addEventListener("click", function() 
    {
        // ustaw wartość pola formularza "event-date" na wybrany dzień
        document.getElementById("event-date").value = document.getElementById("timetable-day").textContent;

        // pokaż okno modalne
        modal.style.display = "block";
    });

    cells.forEach(function(cell) 
    {   
        cell.addEventListener("click", function() 
        {

            // ustaw wartość pola formularza "event-date" na wybrany dzień
            if (this.textContent < 10) {
                if (currMonth < 10) {
                    document.getElementById("timetable-day").innerHTML = "0" + this.textContent + ".0" + currMonth + "." + currYear;
                }
                else {
                    document.getElementById("timetable-day").innerHTML = "0" + this.textContent + "." + currMonth + "." + currYear;
                }
            }
            else {
                if (currMonth < 10) {
                    document.getElementById("timetable-day").innerHTML = this.textContent + ".0" + currMonth + "." + currYear;
                }
                else {
                    document.getElementById("timetable-day").innerHTML = this.textContent + "." + currMonth + "." + currYear;
                }
            }
            
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

window.addEventListener("click", createEvents)

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