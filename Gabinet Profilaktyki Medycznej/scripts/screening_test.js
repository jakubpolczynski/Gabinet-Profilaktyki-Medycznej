
function addScreening() 
{
    // pobierz dane wydarzenia z pól formularza
    const date = document.getElementById("add_screening_date").value;
    const fname = document.getElementById("add_screening_fname").value;
    const lname = document.getElementById("add_screening_lname").value;
    const pesel = document.getElementById("add_screening_pesel").value;
    const nurse = readCookie('username');
    const height = document.getElementById("add_screening_height").value;
    const weight = document.getElementById("add_screening_weight").value;
    const BMI = weight/height^2;
    const sight = document.getElementById("add_screening_sight").value;
    const hearing = document.getElementById("add_screening_hearing").value;
    const bloodPressure = document.getElementById("add_screening_bloodPressure").value;
    const statics = document.getElementById("add_screening_statics").value;
    const speech = document.getElementById("add_screening_speech").value;
    const comments = document.getElementById("add_screening_comments").value;
    const presence = document.getElementById("add_screening_presence").value;

    

    // sprawdź, czy wszystkie pola formularza są wypełnione
    if (date && fname && lname && nurse && height && weight && BMI && sight && hearing && bloodPressure && statics && speech && comments && presence) 
    {
        // wszystkie pola są wypełnione, więc można dodać wydarzenie
        submitAdd(date, fname, lname, pesel, nurse, height, weight, BMI, sight, hearing, bloodPressure, statics, speech, comments, presence);
    } 
    else 
    {
        // w przeciwnym razie wyświetl komunikat o błędzie
        alert("Wypełnij wszystkie pola formularza");
    }
}

async function submitAdd(date, fname, lname, pesel, nurse, height, weight, BMI, sight, hearing, bloodPressure, statics, speech, comments, presence) {
    var errormsg = "";
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/add_screening_test.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const data = `date=${date}&fname=${fname}&lname=${lname}&pesel=${pesel}&nurse=${nurse}&height=${height}&weight=${weight}&BMI=${BMI}&sight=${sight}&hearing=${hearing}&bloodPressure=${bloodPressure}&statics=${statics}&speech=${speech}&comments=${comments}&presence=${presence}`;
    console.log(date, fname, lname, pesel, nurse, height, weight, BMI, sight, hearing, bloodPressure, statics, speech, comments, presence)
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