const form = document.querySelector('form');
form.addEventListener('submit', validateForm);

username = document.querySelector('#username');
password = document.querySelector('#password');

function validateForm(event) {
    event.preventDefault();
    if (!username.value) {
        alert('Nazwa użytkownika jest wymagana!');
        return;
    }
    if (!password.value) {
        alert('Hasło jest wymagane!');
        return;
    }
    // jeśli walidacja przeszła pomyślnie, wyślij formularz
    console.log("Walidacja danych poprawna")
    submitForm(event);
}

function submitForm(event) {
    event.preventDefault();
    console.log("Tworzenie nowego rządania")
    const xhr = new XMLHttpRequest();
    console.log("Otwieramy połączenie z serwerem")
    xhr.open('POST', '../php/login.php');
    console.log("Ustawiamy nagłówki")
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    console.log("Przygotowanie danych")
    const data = `username=${username.value}&password=${password.value}`;
    console.log(username.value, password.value)
    console.log("Wysłanie żądania")
    xhr.send(data);
    console.log("Oczekiwanie na odpowiedz")
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                if (xhr.responseText === "success"){
                    console.error("Logowanie powiodło się")
                    window.location.href = '../pages/start_page.html';
                }
                else {
                    console.error(xhr.responseText)
                    console.error("Błąd logowania")
                    document.getElementById("error").innerText = "Błędny login lub hasło"
                }
            } else {
                console.error("Błąd logowania")
                document.getElementById("error").innerText = "Błędny login lub hasło"
            }
        }
    }
}
  