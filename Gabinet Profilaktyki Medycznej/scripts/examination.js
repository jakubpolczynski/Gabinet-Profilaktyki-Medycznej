
function addExamination() 
{
    // pobierz dane wydarzenia z pól formularza
    const date = document.getElementById("add_examination_date").value;
    const time = document.getElementById("add_examination_time").value;
    const fname = document.getElementById("add_examination_fname").value;
    const lname = document.getElementById("add_examination_lname").value;
    const pesel = document.getElementById("add_examination_pesel").value;
    const nurse = readCookie('username');
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

async function submitAdd(date, time, fname, lname, pesel, nurse, reason, description, comments) {
    var errormsg = "";
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/add_examination.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const data = `date=${date}&time=${time}&fname=${fname}&lname=${lname}&pesel=${pesel}&nurse=${nurse}&reason=${reason}&description=${description}&comments=${comments}`;
    console.log(date, time, fname, lname, pesel, nurse, reason, description, comments)
    xhr.send(data);
    xhr.onreadystatechange = await function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText === "success"){
                    console.log("Dodawanie zakończone pomyślnie")
                    alert("Badanie zostało dodane");
                    // var tcc = document.getElementById("timetable-content-container");
                    // while (tcc.hasChildNodes()) {
                    //     tcc.removeChild(tcc.firstChild);
                    // }
                    // checkEvents(date);
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