async function printStudentCard(){
    const fname = document.getElementById('fname').value;
    const lname = document.getElementById('lname').value;

    if (fname && lname){
        var ecc = document.getElementById('student_card-content-container');
            while(ecc.hasChildNodes()) {
                ecc.removeChild(ecc.firstChild);
            }
        var errormsg = "";
        const xhr = new XMLHttpRequest();
        xhr.open('POST','../php/print_student_card.php');
        xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        const data = `fname=${fname}&lname=${lname}`;
        dataAlreadySent = false;
        if(!dataAlreadySent){
            xhr.send(data);
            dataAlreadySent = true;
        }
        xhr.onreadystatechange = await function() {
            if(xhr.readyState === 4){
                if(xhr.status === 200) {
                    var response = xhr.responseText;
                    events = cutEvent(response);
                    var ecc = document.getElementById('student_card-content-container')
                    for (let items of events){
                        var student_card_names = document.createElement("div");
                        student_card_names.id = "student_card-names";

                        var student_card_content = document.createElement("div");
                        student_card_content.id = "student_card-content";
                        arr = cutParts(items);
                        for (let item of arr){
                            var student_card_paragraph1 = document.createElement('p');
                            student_card_paragraph1.id = "student_card_paragraph";
                            student_card_paragraph1.innerText = item.split(" - ")[0];

                            var student_card_paragraph2 = document.createElement('p');
                            student_card_paragraph2.id = "student_card_paragraph";
                            student_card_paragraph2.innerText = item.split(" - ")[1];

                            student_card_names.appendChild(student_card_paragraph1);
                            student_card_content.appendChild(student_card_paragraph2);

                            ecc.appendChild(student_card_names);
                            ecc.appendChild(student_card_content);
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
            errormsg = '';
            xhr.responseText = null;
            dataAlreadySent = false;
        }
    }
    else{
        alert("Wypełnij wszystkie pola formularza")
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