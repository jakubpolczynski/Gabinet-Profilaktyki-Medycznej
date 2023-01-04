function createCalendar() 
{
    // pobierz aktualną datę
    const now = new Date();
    // oblicz numer aktualnego dnia tygodnia (0 = niedziela, 1 = poniedziałek itd.)
    const currentDay = now.getDay();
    // oblicz numer aktualnego miesiąca (0 = styczeń, 1 = luty itd.)
    const currentMonth = now.getMonth();
    // oblicz aktualny rok
    const currentYear = now.getFullYear();
    // oblicz liczbę dni w aktualnym miesiącu
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    // utwórz tabelę z kalendarzem
    const calendar = document.createElement("table");
    calendar.setAttribute("id", "calendar");

    // utwórz nagłówek tabeli z nazwami dni tygodnia
    const weekdays = ["Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota", "Niedziela"];
    const months = ["Styczeń", "Luty", "Marzec", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień"];
    const header = document.createElement("thead");
    const headerRow = document.createElement("tr");

    // utwórz nazwę miesiąca na samej górze
    month_container = document.getElementById("months") 
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

    // utwórz ciało tabeli z dniami miesiąca
    // const body = document.createElement("tbody");
    // let day = 1;
    // let row;
    // while (day <= daysInMonth) 
    // {
    //     if (day == 1 || day % 7 == 1) 
    //     {
    //         // utwórz nowy wiersz tabeli co niedziele
    //         row = document.createElement("tr");
    //     }
    //     // utwórz komórkę z numerem dnia
    //     const cell = document.createElement("td");
    //     cell.textContent = day;
    //     row.appendChild(cell);
    //     if (day == daysInMonth || (day + 1) % 7 == 1) 
    //     {
    //         // dodaj wiersz do tabeli, jeśli jest to ostatni dzień miesiąca lub następny dzień to poniedziałek
    //         body.appendChild(row);
    //     }
    //     day++;
    // }

    let firstDay = (new Date(currentYear, currentMonth)).getDay() - 1;
    if (firstDay <= 0) {
        firstDay = 6
    } 

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
                if (j > 4) {
                    cell.classList.add("weekend")
                }
                cellText = document.createTextNode(date);
                if (date === now.getDate() && currentYear === now.getFullYear() && currentMonth === now.getMonth()) {
                    cell.classList.add("today");
                } // color today's date
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

// utwórz kalendarz po załadowaniu strony
window.addEventListener("load", createCalendar);
