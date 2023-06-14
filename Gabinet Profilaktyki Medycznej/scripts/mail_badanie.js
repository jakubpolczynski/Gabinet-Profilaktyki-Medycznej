function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function  sendMail()
{
    await sleep(3000);
    const Firstname = document.getElementById("add_examination_fname").value
    const Surname = document.getElementById("add_examination_lname").value
    const date = document.getElementById("add_examination_date").value
    const nurse = readCookie('username');
    const type = " ";
    const type_shortcut = "B";
    
    var errormsg = ""
    const xhr = new XMLHttpRequest()
    xhr.open('POST','../php/mail.php')
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
    const data = `Firstname=${Firstname}&Surname=${Surname}&date=${date}&nurse=${nurse}&type=${type}&type_shortcut=${type_shortcut}
        `
    console.log(data)
    xhr.send(data)
    xhr.onreadystatechange = await function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if(xhr.responseText === "success") {
                    console.log("Mail wysłany")
                    alert("Wiadomość email została wsyłana")
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
}