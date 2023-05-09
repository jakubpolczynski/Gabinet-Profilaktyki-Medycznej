async function startPageNurse() {
    username = readCookie('username')

    var errormsg = "";
    // Tworzenie nowego rządania
    const xhr = new XMLHttpRequest();
    // Otwieramy połączenie z serwerem
    xhr.open('POST', '../php/get_nurse_info.php');
    // Ustawiamy nagłówki
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // Przygotowanie danych
    const data = `login=${username}`;
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

                const node = document.createElement("p");
                const textnode = document.createTextNode("Witaj " + response);
                node.appendChild(textnode);
                document.getElementById("nurse_info_startPage").appendChild(node);
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