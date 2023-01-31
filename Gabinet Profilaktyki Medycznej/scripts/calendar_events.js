let dataAlreadySent = false;
let eventDeleted = false;
let currentDate = 1;
let currentTime;
function loadCurrentDay()
{
    let date = new Date();
    let cDay = date.getDate();
    currMonth = document.getElementById("currMonthValue").textContent;
    currYear = document.getElementById("currYearValue").textContent;
    if (cDay < 10) {
        if (date < 10) {
            var d = "0" + cDay + ".0" + currMonth + "." + currYear;
            document.getElementById("timetable-day").innerHTML = d;
        }
        else {
            var d = "0" + cDay + "." + currMonth + "." + currYear;
            document.getElementById("timetable-day").innerHTML = d;
        }
    }
    else {
        if (currMonth < 10) {
            var d = cDay + ".0" + currMonth + "." + currYear
            document.getElementById("timetable-day").innerHTML = d;
        }
        else {
            var d = cDay + "." + currMonth + "." + currYear;
            document.getElementById("timetable-day").innerHTML = d;
        }
    }
    checkEvents(d)
}

function loadTimetable()
{
    // pobierz wszystkie komórki z kalendarza
    const cells = document.querySelectorAll("#calendar td")
    // pobierz okno modalne
    const modal_add = document.getElementById("add-event-modal")
    const modal_edit = document.getElementById("edit-event-modal");
    // pobierz przycisk zamykania okna modalnego
    const add_modal_close = document.querySelector(".add-event-modal-close")
    const edit_modal_close = document.querySelector(".edit-event-modal-close")
    // pobierz przycisk edytowania zdarzen 
    const btn_add = document.getElementById("btn-add")
    // dodaj obsługę kliknięcia na komórki kalendarza
    btn_add.addEventListener("click", function() 
    {
        // ustaw wartość pola formularza "event-date" na wybrany dzień
        document.getElementById("add-event-date").value = document.getElementById("timetable-day").textContent;

        // pokaż okno modalne
        modal_add.style.display = "block"
    })

    // dodaj obsługę kliknięcia na komórki kalendarza
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
            
            checkEvents(date);
        });
    });


    // dodaj obsługę kliknięcia na przycisk zamykania okna modalnego
    add_modal_close.addEventListener("click", function(event) 
    {
        // ukryj okno modalne
        modal_add.style.display = "none";
    });

    edit_modal_close.addEventListener("click", function(event)
    {
        // ukryj okno modalne
        modal_edit.style.display = "none";
    })

    // dodaj obsługę kliknięcia poza oknem modalnym
    window.addEventListener("click", function(event) 
    {
        if (event.target == modal_add) {
            // ukryj okno modalne
            modal_add.style.display = "none";

        }
        if (event.target == modal_edit) {
            // ukryj okno modalne
            modal_edit.style.display = "none";
        }
    });
}

window.addEventListener("click", loadTimetable())

function addEvent(event) 
    {
        const modal_add = document.getElementById("add-event-modal");
        // pobierz dane wydarzenia z pól formularza
        const name = document.getElementById("add-event-name").value;
        const date = document.getElementById("add-event-date").value;
        const time = document.getElementById("add-event-time").value;

        // sprawdź, czy wszystkie pola formularza są wypełnione
        if (name && date && time) 
        {
            // wszystkie pola są wypełnione, więc można dodać wydarzenie
            submitAdd(name, date, time);
            // ukryj okno modalne
            modal_add.style.display = "none";
        } 
        else 
        {
            // w przeciwnym razie wyświetl komunikat o błędzie
            alert("Wypełnij wszystkie pola formularza");
        }
    }
function editEventBtn(this_,date)
{   
    var timetable_content = this_.parentElement;
    var time_name = timetable_content.querySelector("p")
    temp = String(time_name.innerText)
    temp = temp.split(" ")
    time = temp[0] + ":00"
    console.log(time)

    currentTime = time;
    currentDate = date;
}

async function submitAdd(name, date, time) {
    var errormsg = "";
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/add_event_calendar.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const data = `name=${name}&date=${date}&time=${time}`;
    console.log(name, date, time)
    xhr.send(data);
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
    var tcc = document.getElementById("timetable-content-container");
            while (tcc.hasChildNodes()) {
                tcc.removeChild(tcc.firstChild);
              }
    var errormsg = "";
    // Tworzenie nowego rządania
    const xhr = new XMLHttpRequest();
    // Otwieramy połączenie z serwerem
    xhr.open('POST', '../php/print_event_calendar.php');
    // Ustawiamy nagłówki
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Przygotowanie danych
    const data = `date=${date}`;
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

                        // przycisk do usuniecia zdarzenia
                        var deleteButton = document.createElement("button");
                        deleteButton.id = "delete-event";
                        deleteButton.innerText = "X"
                        deleteButton.onclick = function() {
                            this_ = this
                            deleteEvent(this_, date);
                        };
                        var editButton = document.createElement("button");
                        editButton.id = "edit-event-btn";
                        // editButton.innerHTML = "<img src='../images/edit-icon.png' alt='edit'>"
                        editButton.innerText = '\u21BA'
                        editButton.onclick = function() {
                            this_ = this
                            const modal_edit = document.getElementById("edit-event-modal");
                            modal_edit.style.display = "block"
                            editEventBtn(this_,date)
                        }
                        timetable_content.appendChild(deleteButton);
                        timetable_content.appendChild(editButton);
                        var event_paragraph = document.createElement("p");
                        event_paragraph.id = "p_content";
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
    return parts;
}

function deleteEvent(this_, date) {
    var timetable_content = this_.parentElement;
    var time_name = timetable_content.querySelector("p")
    temp = String(time_name.innerText)
    temp = temp.split(" ")
    var time = temp[0] + ":00"
    console.log(date, time)
    var errormsg = "";
    // Tworzenie nowego rządania
    const xhr = new XMLHttpRequest();
    // Otwieramy połączenie z serwerem
    xhr.open('POST', '../php/delete_event_calendar.php');
    // Ustawiamy nagłówki
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Przygotowanie danych
    const data = `date=${date}&time=${time}`;
    // Wysłanie żądania
    if(!dataAlreadySent){
        xhr.send(data);
        dataAlreadySent = true;
    }
    // Oczekiwanie na odpowiedz
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                var status = cutStatus(response);
                if (status === "success"){
                    eventDeleted = true;
                    if (eventDeleted)
                    {
                        console.log("Data:", date);
                        checkEvents(date);
                        eventDeleted = false;
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
function editEvent(event)
{
    const modal_edit = document.getElementById("edit-event-modal");
    // pobierz dane wydarzenia z pól formularza
    const name = document.getElementById("edit-event-name").value;
    const time = document.getElementById("edit-event-time").value;

    // sprawdź, czy wszystkie pola formularza są wypełnione
    if (name && time) 
    {
        // wszystkie pola są wypełnione, więc można dodać wydarzenie
        submitEdit(name, time);
        // ukryj okno modalne
        modal_edit.style.display = "none";
    } 
    else 
    {
        // w przeciwnym razie wyświetl komunikat o błędzie
        alert("Wypełnij wszystkie pola formularza");
    }
}
function submitEdit(name, time)
{
    var errormsg = "";
    // Tworzenie nowego rządania
    const xhr = new XMLHttpRequest();
    // Otwieramy połączenie z serwerem
    xhr.open('POST', '../php/edit_event_calendar.php');
    // Ustawiamy nagłówki
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Przygotowanie danych
    const data = `currentDate=${currentDate}&currentTime=${currentTime}&newName=${name}&newTime=${time}`;
    console.log(currentDate)
    // Wysłanie żądania
    if(!dataAlreadySent){
        xhr.send(data);
        dataAlreadySent = true;
    }
    // Oczekiwanie na odpowiedz
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                console.log(response)
                var status = cutStatus(response);
                if (status === "success"){
                    console.log("Data:", currentDate);
                    checkEvents(currentDate);
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
