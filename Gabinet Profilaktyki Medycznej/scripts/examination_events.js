window.onload = async function checkNurse() {
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

                var nurse_info_container = document.getElementById("nurse_info");
                nurse_info_container.value = '';
                nurse_info_container.value = response;
                nurse_info_container.setAttribute('disabled', '');
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