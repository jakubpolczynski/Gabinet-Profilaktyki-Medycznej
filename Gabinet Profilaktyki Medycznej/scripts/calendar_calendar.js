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
    const weekdays = ["Niedziela", "Poniedziałek", "Wtorek", "Środa", "Czwartek", "Piątek", "Sobota"];
    const header = document.createElement("thead");
    const headerRow = document.createElement("tr");
    weekdays.forEach(function(day) 
    {
        const th = document.createElement("th");
        th.textContent = day;
        headerRow.appendChild(th);
    });
    header.appendChild(headerRow);
    calendar.appendChild(header);

    // utwórz ciało tabeli z dniami miesiąca
    const body = document.createElement("tbody");
    let day = 1;
    let row;
    while (day <= daysInMonth) 
    {
        if (day == 1 || day % 7 == 1) 
        {
            // utwórz nowy wiersz tabeli co niedziele
            row = document.createElement("tr");
        }
        // utwórz komórkę z numerem dnia
        const cell = document.createElement("td");
        cell.textContent = day;
        row.appendChild(cell);
        if (day == daysInMonth || (day + 1) % 7 == 1) 
        {
            // dodaj wiersz do tabeli, jeśli jest to ostatni dzień miesiąca lub następny dzień to poniedziałek
            body.appendChild(row);
        }
        day++;
    }
    calendar.appendChild(body);

    // wstaw tabelę z kalendarzem do dokumentu
    const calendarContainer = document.getElementById("calendar-container");
    calendarContainer.innerHTML = "";
    calendarContainer.appendChild(calendar);
}
// utwórz kalendarz po załadowaniu strony
window.addEventListener("load", createCalendar);
