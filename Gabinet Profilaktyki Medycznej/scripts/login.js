function login() {
    //Pobieranie danych
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    
    //Sprawdzenie danych
    if (username == "admin" && password == "admin") {
      //Jeśli poprawne to odpal strone startowa
      window.location.href = "pages/start_page.html";
    } else {
      //Jeśli niepoprawne to wyświetl błąd
      document.getElementById("message").innerHTML = "Błędna nazwa użytkownika lub hasło";
    }
  }