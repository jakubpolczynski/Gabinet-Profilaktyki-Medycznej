async function  createPDF()
{
    const date = document.getElementById("add_examination_date").value;
    const time = document.getElementById("add_examination_time").value;
    const Firstname = document.getElementById("add_examination_fname").value;
    const Surname = document.getElementById("add_examination_lname").value;
    const nurse = readCookie('username');
    const reason = document.getElementById("add_examination_reason").value;
    const description = document.getElementById("add_examination_description").value;
    const comments = document.getElementById("add_examination_comments").value;
 

    var errormsg = ""
    const xhr = new XMLHttpRequest()
    xhr.open('POST','../php/pdf_badanie.php')
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
    const data = `Firstname=${Firstname}&Surname=${Surname}&date=${date}&time=${time}&nurse=${nurse}&reason=${reason}&description=${description}&comments=${comments}
        `
    console.log(data)
    xhr.send(data)
    xhr.onreadystatechange = await function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if(xhr.responseText === "success") {
                    console.log("Stworzono plik pdf")
                    alert("Stworzono plik pdf")
                }
                else{
                    errormsg += xhr.responseText
                }
            }
            else {
                errormsg += xhr.responseText
            }
        }
        else {
            errormsg += xhr.responseText
        }
        console.log(errormsg);
    }
    window.open("../pdfFile/"+Firstname+Surname+".pdf")
}