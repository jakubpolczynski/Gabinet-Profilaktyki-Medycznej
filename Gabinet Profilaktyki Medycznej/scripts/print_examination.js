async function printExaminations() {
    const dateL = document.getElementById("print_examination_dateL").value;
    const dateR = document.getElementById("print_examination_dateR").value;
    const stClass = document.getElementById("print_examination_class").value;
    const fname = document.getElementById("print_examination_fname").value;
    const lname = document.getElementById("print_examination_lname").value;

    // sprawdź, czy wszystkie pola formularza są wypełnione
    if (dateL || dateR || stClass || fname || lname) 
    {
        var ecc = document.getElementById("examination-content-container");
            while (ecc.hasChildNodes()) {
                ecc.removeChild(ecc.firstChild);
              }

        var errormsg = "";
        // Tworzenie nowego rządania
        const xhr = new XMLHttpRequest();
        // Otwieramy połączenie z serwerem
        xhr.open('POST', '../php/print_examination.php');
        // Ustawiamy nagłówki
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        // Przygotowanie danych
        const data = `dateL=${dateL}&dateR=${dateR}&stClass=${stClass}&fname=${fname}&lname=${lname}`;
        // Wysłanie żądania
        dataAlreadySent = false;
        if(!dataAlreadySent){
            xhr.send(data);
            dataAlreadySent = true;
        }
        // Oczekiwanie na odpowiedz
        xhr.onreadystatechange = await function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    events = cutEvent(response);
                    var ecc = document.getElementById("examination-content-container");
                    for (let items of events)
                    {
                        var examination_content = document.createElement("div")
                        examination_content.id = "examination-content";
                        arr = cutParts(items);
                        for (let item of arr)
                        {

    
                            var examination_paragraph = document.createElement("p");
                            examination_paragraph.id = "examination_p_content";
                            examination_paragraph.innerText = item;
    
                            examination_content.appendChild(examination_paragraph)
                            ecc.appendChild(examination_content);
                        }
                           
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
    else 
    {
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

    return parts;
}

function cutParts(response)
{
    var parts = response.split(";");

    return parts;
}