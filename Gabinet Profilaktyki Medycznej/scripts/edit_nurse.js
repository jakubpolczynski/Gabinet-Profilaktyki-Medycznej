async function  editNurse()
{
    const username = document.getElementById("edit_nurse_username").value
    const newFirstname = document.getElementById("edit_nurse_new_firstname").value
    const newSurname = document.getElementById("edit_nurse_new_surname").value
    const newUsername = document.getElementById("edit_nurse_new_username").value
    const newPassword = document.getElementById("edit_nurse_new_password").value
    
    var errormsg = ""
    const xhr = new XMLHttpRequest()
    xhr.open('POST','../php/edit_nurse.php')
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
    const data = `username=${username}&newFirstname=${newFirstname}&newSurname=${newSurname}&newUsername=${newUsername}&newPassword=${newPassword}
        `
    console.log(data)
    xhr.send(data)
    xhr.onreadystatechange = await function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if(xhr.responseText === "success") {
                    console.log("Edycja zakończona pomyślnie")
                    alert("Edycja zakończona")
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