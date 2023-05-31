    // pobierz aktualną datę
    const now = new Date();
    // oblicz numer aktualnego dnia tygodnia (0 = niedziela, 1 = poniedziałek itd.)
    const currentDay = now.getDay();
    // oblicz numer aktualnego miesiąca (0 = styczeń, 1 = luty itd.)
    const currentMonth = now.getMonth();
    // oblicz aktualny rok
    const currentYear = now.getFullYear();
    // oblicz liczbę dni w aktualnym miesiącu
    const daysInMonth = new Date(currentYear, currentMonth+1, 0).getDate();

    // zrobione to tylko po to zeby miec dostep do aktualnego miesiaca i roku z pliku html
    document.getElementById("currMonthValue").innerHTML = currentMonth+1;
    document.getElementById("currYearValue").innerHTML = currentYear;

function createCalendar(now, currentDay, currentMonth, currentYear, daysInMonth, counter) 
{
    // utwórz tabelę z kalendarzem
    const calendar = document.createElement("table");
    calendar.setAttribute("id", "calendar");

    // utwórz nagłówek tabeli z nazwami dni tygodnia
    const weekdays = ["PON", "WTO", "ŚRO", "CZW", "PIĄ", "SOB", "NIE"];
    const months = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"];
    const header = document.createElement("thead");
    const headerRow = document.createElement("tr");

    // utwórz nazwę miesiąca na samej górze
    month_container = document.getElementById("months")
    month_container.innerHTML = "";
    celltxt = document.createTextNode(months[currentMonth]);
    month_container.appendChild(celltxt);

    // utwórz nagłówek z nazwami dni tygodnia
    weekdays.forEach(function(day) 
    {
        const th = document.createElement("th");
        th.textContent = day;
        headerRow.appendChild(th);
    });
    header.appendChild(headerRow);
    calendar.appendChild(header);
    if (counter > 10) {
        document.getElementById("btn-month-next").style.display = "none";
    }
    else {
        document.getElementById("btn-month-next").style.display = "inline";
    }

    if (counter == 0){
        document.getElementById("btn-month-prev").style.display = "none";
    }
    else {
        document.getElementById("btn-month-prev").style.display = "inline";
    }

    let firstDay = (new Date(currentYear, currentMonth)).getDay() - 1;

    let date = 1;
    for (let i = 0; i < 6; i++) {
        // Utwórz nowy wiersz dla nowego tygodnia
        let row = document.createElement("tr");

        // Wypełnij cały tydzień odpowiednimi datami
        for (let j = 0; j < 7; j++) {
            // Jeśli pierwszy dzień miesiąca zaczyna się w inny dzień niż poniedziałek wstaw puste pole
            if (i === 0 && j < firstDay) {
                cell = document.createElement("td");
                cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            }

            else if (date > daysInMonth) {
                 break;
            }

            else {
                cell = document.createElement("td");
                
                cellText = document.createTextNode(date);
                //Zaznaczenie dnia dzisiejszego
                if (date === now.getDate() && currentYear === now.getFullYear() && currentMonth === now.getMonth()) {
                    cell.classList.add("today");
                } 
                //Zaznaczenie weekendu
                if (j == 5) {
                    cell.classList.add("saturday")
                }

                if (j == 6)
                {
                    cell.classList.add("sunday")
                }
                cell.appendChild(cellText);
                row.appendChild(cell);
                date++;
            }
        }
        calendar.appendChild(row);
    }
    

    // wstaw tabelę z kalendarzem do dokumentu
    const calendarContainer = document.getElementById("calendar-container");
    calendarContainer.innerHTML = "";
    calendarContainer.appendChild(calendar);
}

counter = currentMonth;

// utwórz kalendarz po załadowaniu strony
window.addEventListener("load", createCalendar(now, currentDay, currentMonth, currentYear, daysInMonth, counter));

document.getElementById("btn-month-prev").onclick = function() {
    // jezeli klikam poprzedni miesiac, zmniejsza sie licznik ktory dodaje sie do zmiennej currentMonth
    counter--;

    const now = new Date();
    const currentDay = now.getDay();
    const currentMonth = counter;
    const currentYear = now.getFullYear();
    const daysInMonth = new Date(currentYear, currentMonth+1, 0).getDate();
    createCalendar(now, currentDay, currentMonth, currentYear, daysInMonth, counter);

    // zrobione to tylko po to zeby miec dostep do aktualnego miesiaca i roku z pliku html
    document.getElementById("currMonthValue").innerHTML = currentMonth+1;
    document.getElementById("currYearValue").innerHTML = currentYear;
}

document.getElementById("btn-month-next").onclick = function() {
    // jezeli klikam kolejny miesiac, zwieksza sie licznik ktory dodaje sie do zmiennej currentMonth
    counter++;

    const now = new Date();
    const currentDay = now.getDay();
    const currentMonth = counter;
    const currentYear = now.getFullYear();
    const daysInMonth = new Date(currentYear, currentMonth+1, 0).getDate();
    createCalendar(now, currentDay, currentMonth, currentYear, daysInMonth, counter);

    // zrobione to tylko po to zeby miec dostep do aktualnego miesiaca i roku z pliku html
    document.getElementById("currMonthValue").innerHTML = currentMonth+1;
    document.getElementById("currYearValue").innerHTML = currentYear;
}