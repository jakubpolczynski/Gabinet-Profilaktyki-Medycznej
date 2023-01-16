let dataAlreadySent = false;
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
                    var date = "0" + this.textContent + ".0" + currMonth + "." + currYear;
                    document.getElementById("timetable-day").innerHTML = date;
                }
                else {
                    var date = "0" + this.textContent + "." + currMonth + "." + currYear;
                    document.getElementById("timetable-day").innerHTML = date;
                }
            }
            else {
                if (currMonth < 10) {
                    var date = this.textContent + ".0" + currMonth + "." + currYear
                    document.getElementById("timetable-day").innerHTML = date;
                }
                else {
                    var date = this.textContent + "." + currMonth + "." + currYear;
                    document.getElementById("timetable-day").innerHTML = date;
                }
            }
            var tcc = document.getElementById("timetable-content-container");
            while (tcc.hasChildNodes()) {
                tcc.removeChild(tcc.firstChild);
              }
            checkEvents(date);
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
    var errormsg = "";
    console.log("Tworzenie nowego rządania")
    const xhr = new XMLHttpRequest();
    console.log("Otwieramy połączenie z serwerem")
    xhr.open('POST', '../php/add_event_calendar.php');
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
                    var tcc = document.getElementById("timetable-content-container");
                    while (tcc.hasChildNodes()) {
                        tcc.removeChild(tcc.firstChild);
                    }
                    checkEvents(date);
                }
                else {
                    errormsg += xhr.responseText;
                }
            } 
            else {
                errormsg += xhr.responseText;
            }
        }
        else {
            errormsg += xhr.responseText;
        }
        console.log(errormsg);
    }
}
async function checkEvents(date) {
    var errormsg = "";
    // Tworzenie nowego rządania
    const xhr = new XMLHttpRequest();
    // Otwieramy połączenie z serwerem
    xhr.open('POST', '../php/print_event_calendar.php');
    // Ustawiamy nagłówki
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Przygotowanie danych
    const data = `date=${date}`;
    // console.log(date)
    // Wysłanie żądania
    if(!dataAlreadySent){
        xhr.send(data);
        dataAlreadySent = true;
    }
    // Oczekiwanie na odpowiedz
    xhr.onreadystatechange = await function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                var status = cutStatus(response);
                if (status === "success"){
                    events = cutEvent(response);
                    var timetable_content_container = document.getElementById("timetable-content-container");
                    for (let item of events)
                    {
                        var timetable_content = document.createElement("div")
                        timetable_content.id = "timetable-content";

                        var event_paragraph = document.createElement("p");
                        event_paragraph.innerText = item;

                        timetable_content.appendChild(event_paragraph)
                        timetable_content_container.appendChild(timetable_content);
                    }
                }
                else {
                    errormsg += xhr.responseText;
                }
            } 
            else {
                errormsg += xhr.responseText;
            }
        }
        else {
            errormsg += xhr.responseText;
        }
        console.log(errormsg);
        errormsg = "";
        xhr.responseText = null;
        dataAlreadySent= false;
    }
}

function cutStatus(response)
{
    var index = response.indexOf("|");
    if(index != -1)
    {
        return response.substring(0, index);
    }
    return response;
}

function cutEvent(response)
{
    var parts = response.split("|");
    parts.shift();
    parts.pop();
    var i = 0;
    for (let part of parts)
    {
        var time = part.substring(0, part.lastIndexOf(":"))
        var name = part.substring(part.indexOf(" ")) 
        parts[i] =  time + " " + name;
        i++;
    }
    console.log(parts)
    return parts;
}