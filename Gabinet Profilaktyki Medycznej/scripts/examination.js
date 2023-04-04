
function addExamination() 
{
    // pobierz dane wydarzenia z pól formularza
    const date = document.getElementById("add_examination_date").value;
    const time = document.getElementById("add_examination_time").value;
    const fname = document.getElementById("add_examination_fname").value;
    const lname = document.getElementById("add_examination_lname").value;
    const pesel = document.getElementById("add_examination_pesel").value;
    const nurse = document.getElementById("add_examination_nurse").value;
    const reason = document.getElementById("add_examination_reason").value;
    const description = document.getElementById("add_examination_description").value;
    const comments = document.getElementById("add_examination_comments").value;

    // sprawdź, czy wszystkie pola formularza są wypełnione
    if (date && time && fname && lname && nurse && reason && description && comments) 
    {
        // wszystkie pola są wypełnione, więc można dodać wydarzenie
        submitAdd(date, time, fname, lname, pesel, nurse, reason, description, comments);
    } 
    else 
    {
        // w przeciwnym razie wyświetl komunikat o błędzie
        alert("Wypełnij wszystkie pola formularza");
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