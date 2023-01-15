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

function addEvent(event) 
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
            submitForm(name, date, time);
            // ukryj okno modalne
            modal.style.display = "none";
            // wyświetl komunikat o pomyślnym dodaniu wydarzenia
        } 
        else 
        {
            // w przeciwnym razie wyświetl komunikat o błędzie
            alert("Wypełnij wszystkie pola formularza");
        }
    }

async function submitForm(name, date, time) {
    console.log("Tworzenie nowego rządania")
    const xhr = new XMLHttpRequest();
    console.log("Otwieramy połączenie z serwerem")
    xhr.open('POST', '../php/calendar.php');
    console.log("Ustawiamy nagłówki")
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    console.log("Przygotowanie danych")
    const data = `name=${name}&date=${date}&time=${time}`;
    console.log(name, date, time)
    console.log("Wysłanie żądania")
    xhr.send(data);
    console.log("Oczekiwanie na odpowiedz")
    xhr.onreadystatechange = await function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText === "success"){
                    console.log("Dodawanie zakończone pomyślnie")
                    alert("Wydarzenie zostało dodane");
                }
                else {
                    console.error(xhr.responseText)
                    alert(xhr.responseText)
                }
            } 
            else {
                console.error(xhr.responseText)
                alert(xhr.responseText)
            }
        }
        else {
            console.error(xhr.responseText)
            alert(xhr.responseText)
        }
    }
}