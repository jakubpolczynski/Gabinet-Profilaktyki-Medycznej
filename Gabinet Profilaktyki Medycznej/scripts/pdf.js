async function  createPDF()
{
    const Firstname = document.getElementById("add_screening_fname").value
    const Surname = document.getElementById("add_screening_lname").value
    const height = document.getElementById("add_screening_height").value
    const weight = document.getElementById("add_screening_weight").value

    const sight = document.getElementById("add_screening_sight").value
    const hearing = document.getElementById("add_screening_hearing").value
    const bloodPressure = document.getElementById("add_screening_bloodPressure").value

    const statics = document.getElementById("add_screening_statics").value
    const speach = document.getElementById("add_screening_speech").value
    const comments = document.getElementById("add_screening_comments").value

    var bmi = weight/(height^2)
    bmi = bmi.toFixed(2)


    var errormsg = ""
    const xhr = new XMLHttpRequest()
    xhr.open('POST','../php/pdf.php')
    xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded')
    const data = `Firstname=${Firstname}&Surname=${Surname}&height=${height}&weight=${weight}&sight=${sight}&hearing=${hearing}&bloodPressure=${bloodPressure}&statics=${statics}&speach=${speach}&comments=${comments}&bmi=${bmi}
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