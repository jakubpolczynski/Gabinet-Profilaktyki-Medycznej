function addStudentCard(){
    const imie_ucznia = document.getElementById("imie_ucznia").value;
    const nazwisko_ucznia = document.getElementById("nazwisko_ucznia").value;
    const imie_ojca = document.getElementById("imie_ojca").value;
    const imie_matki = document.getElementById("imie_matki").value;
    const wyksztalcenie_ojca = document.getElementById("wyksztalcenie_ojca").value;
    const wyksztalcenie_matki = document.getElementById("wyksztalcenie_matki").value;
    const zawod_ojca = document.getElementById("zawod_ojca").value;
    const zawod_matki = document.getElementById("zawod_matki").value;
    const stan_zdrowia_ojca = document.getElementById("stan_zdrowia_ojca").value;
    const stan_zdrowia_matki = document.getElementById("stan_zdrowia_matki").value;
    const rok_urodzenia_rodzenstwa_dziecka = document.getElementById("rok_urodzenia_rodzenstwa_dziecka").value;
    const stan_zdrowia_rodzenstwa_dziecka = document.getElementById("stan_zdrowia_rodzenstwa_dziecka").value;
    const warunki_mieszkaniowe = document.getElementById("warunki_mieszkaniowe").value;
    const problemy_w_rodzinie = document.getElementById("problemy_w_rodzinie").value;
    const zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie = document.getElementById("zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie").value;
    const przebyte_choroby = document.getElementById("przebyte_choroby").value;
    const uczulenia = document.getElementById("uczulenia").value;
    const objawy_uczulenia = document.getElementById("objawy_uczulenia").value;
    const sluch = document.getElementById("sluch").value;
    const wzrok = document.getElementById("wzrok").value;
    const zez = document.getElementById("zez").value;
    const uzywanie = document.getElementById("uzywanie").value;
    const leki = document.getElementById("leki").value;
    const dolegliwosci_objawy = document.getElementById("dolegliwosci_objawy").value;
    const uwagi_rodzicow = document.getElementById("uwagi_rodzicow").value;
    const inne_uwagi = document.getElementById("inne_uwagi").value;
    const wymowa = document.getElementById("wymowa").value;
    const sprawnosc_fizyczna = document.getElementById("sprawnosc_fizyczna").value;
    const uzdolnienia = document.getElementById("uzdolnienia").value;
    const zachowanie = document.getElementById("zachowanie").value;
    const wyniki_w_nauce = document.getElementById("wyniki_w_nauce").value;
    const absencja_szkolna = document.getElementById("absencja_szkolna").value;
    const trudnosci_szkolne = document.getElementById("trudnosci_szkolne").value;
    const relacje_z_rowiesnikami = document.getElementById("relacje_z_rowiesnikami").value;
    const inne_uwagi_wychowawcy = document.getElementById("inne_uwagi_wychowawcy").value;
    const rozwoj_fizyczny = document.getElementById("rozwoj_fizyczny").value;
    const dojrzewanie_plciowe = document.getElementById("dojrzewanie_plciowe").value;
    const tarczyca = document.getElementById("tarczyca").value;
    const rozwoj_psychospoleczny = document.getElementById("rozwoj_psychospoleczny").value;
    const uklad_ruchu = document.getElementById("uklad_ruchu").value;
    const skora = document.getElementById("skora").value;
    const jama_ustna = document.getElementById("jama_ustna").value;
    const pozostale_uklady = document.getElementById("pozostale_uklady").value;
    const problem_zdrowotny = document.getElementById("problem_zdrowotny").value;
    const grupa_na_wf = document.getElementById("grupa_na_wf").value;
    const moze_uczestniczyc_w_zawodach = document.getElementById("moze_uczestniczyc_w_zawodach").value;
    const ograniczenie_dotyczace_wyboru_i_nauki_zawodu = document.getElementById("ograniczenie_dotyczace_wyboru_i_nauki_zawodu").value;
    const zalecenia = document.getElementById("zalecenia").value;

    //sprawdz czy wszystkie pola formularza sa wypelnione
    if (imie_ucznia && nazwisko_ucznia && imie_ojca && imie_matki && wyksztalcenie_ojca && wyksztalcenie_matki && zawod_ojca && zawod_matki && stan_zdrowia_ojca && stan_zdrowia_matki && rok_urodzenia_rodzenstwa_dziecka && stan_zdrowia_rodzenstwa_dziecka && warunki_mieszkaniowe && problemy_w_rodzinie && zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie && przebyte_choroby && uczulenia && objawy_uczulenia && sluch && wzrok && zez && uzywanie && leki && dolegliwosci_objawy && uwagi_rodzicow && inne_uwagi && wymowa && sprawnosc_fizyczna && uzdolnienia && zachowanie && wyniki_w_nauce && absencja_szkolna && trudnosci_szkolne && relacje_z_rowiesnikami && inne_uwagi_wychowawcy && rozwoj_fizyczny && dojrzewanie_plciowe && tarczyca && rozwoj_psychospoleczny && uklad_ruchu && skora && jama_ustna && pozostale_uklady && problem_zdrowotny && grupa_na_wf && moze_uczestniczyc_w_zawodach && ograniczenie_dotyczace_wyboru_i_nauki_zawodu && zalecenia ){
        // wszystko wypelnione
        submitAdd(imie_ojca,imie_matki,wyksztalcenie_ojca,wyksztalcenie_matki,zawod_ojca,zawod_matki,stan_zdrowia_ojca,stan_zdrowia_matki,rok_urodzenia_rodzenstwa_dziecka,stan_zdrowia_rodzenstwa_dziecka,warunki_mieszkaniowe,problemy_w_rodzinie,zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie,przebyte_choroby,uczulenia,objawy_uczulenia,sluch,wzrok,zez,uzywanie,leki,dolegliwosci_objawy,uwagi_rodzicow,inne_uwagi,wymowa,sprawnosc_fizyczna,uzdolnienia,zachowanie,wyniki_w_nauce,absencja_szkolna,trudnosci_szkolne,relacje_z_rowiesnikami,inne_uwagi_wychowawcy,rozwoj_fizyczny,dojrzewanie_plciowe,tarczyca,rozwoj_psychospoleczny,uklad_ruchu,skora,jama_ustna,pozostale_uklady,problem_zdrowotny,grupa_na_wf,moze_uczestniczyc_w_zawodach,ograniczenie_dotyczace_wyboru_i_nauki_zawodu,zalecenia,imie_ucznia,nazwisko_ucznia)
    }
    else{
        //nie wypelnione
        alert("Wypełnij wszystkie pola formularza");
    }

    async function submitAdd(imie_ojca,imie_matki,wyksztalcenie_ojca,wyksztalcenie_matki,zawod_ojca,zawod_matki,stan_zdrowia_ojca,stan_zdrowia_matki,rok_urodzenia_rodzenstwa_dziecka,stan_zdrowia_rodzenstwa_dziecka,warunki_mieszkaniowe,problemy_w_rodzinie,zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie,przebyte_choroby,uczulenia,objawy_uczulenia,sluch,wzrok,zez,uzywanie,leki,dolegliwosci_objawy,uwagi_rodzicow,inne_uwagi,wymowa,sprawnosc_fizyczna,uzdolnienia,zachowanie,wyniki_w_nauce,absencja_szkolna,trudnosci_szkolne,relacje_z_rowiesnikami,inne_uwagi_wychowawcy,rozwoj_fizyczny,dojrzewanie_plciowe,tarczyca,rozwoj_psychospoleczny,uklad_ruchu,skora,jama_ustna,pozostale_uklady,problem_zdrowotny,grupa_na_wf,moze_uczestniczyc_w_zawodach,ograniczenie_dotyczace_wyboru_i_nauki_zawodu,zalecenia,imie_ucznia,nazwisko_ucznia){
        var errormsg = "";
        const xhr = new XMLHttpRequest();
        xhr.open('POST','../php/add_student_card.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        const data = `imie_ojca=${imie_ojca}&imie_matki=${imie_matki}&wyksztalcenie_ojca=${wyksztalcenie_ojca}&wyksztalcenie_matki=${wyksztalcenie_matki}&zawod_ojca=${zawod_ojca}&zawod_matki=${zawod_matki}&stan_zdrowia_ojca=${stan_zdrowia_ojca}&stan_zdrowia_matki=${stan_zdrowia_matki}&rok_urodzenia_rodzenstwa_dziecka=${rok_urodzenia_rodzenstwa_dziecka}&stan_zdrowia_rodzenstwa_dziecka=${stan_zdrowia_rodzenstwa_dziecka}&warunki_mieszkaniowe=${warunki_mieszkaniowe}&problemy_w_rodzinie=${problemy_w_rodzinie}&zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie=${zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie}&przebyte_choroby=${przebyte_choroby}&uczulenia=${uczulenia}&objawy_uczulenia=${objawy_uczulenia}&sluch=${sluch}&wzrok=${wzrok}&zez=${zez}&uzywanie=${uzywanie}&leki=${leki}&dolegliwosci_objawy=${dolegliwosci_objawy}&uwagi_rodzicow=${uwagi_rodzicow}&inne_uwagi=${inne_uwagi}&wymowa=${wymowa}&sprawnosc_fizyczna=${sprawnosc_fizyczna}&uzdolnienia=${uzdolnienia}&zachowanie=${zachowanie}&wyniki_w_nauce=${wyniki_w_nauce}&absencja_szkolna=${absencja_szkolna}&trudnosci_szkolne=${trudnosci_szkolne}&relacje_z_rowiesnikami=${relacje_z_rowiesnikami}&inne_uwagi_wychowawcy=${inne_uwagi_wychowawcy}&rozwoj_fizyczny=${rozwoj_fizyczny}&dojrzewanie_plciowe=${dojrzewanie_plciowe}&tarczyca=${tarczyca}&rozwoj_psychospoleczny=${rozwoj_psychospoleczny}&uklad_ruchu=${uklad_ruchu}&skora=${skora}&jama_ustna=${jama_ustna}&pozostale_uklady=${pozostale_uklady}&problem_zdrowotny=${problem_zdrowotny}&grupa_na_wf=${grupa_na_wf}&moze_uczestniczyc_w_zawodach=${moze_uczestniczyc_w_zawodach}&ograniczenie_dotyczace_wyboru_i_nauki_zawodu=${ograniczenie_dotyczace_wyboru_i_nauki_zawodu}&zalecenia=${zalecenia}&imie_ucznia=${imie_ucznia}&nazwisko_ucznia=${nazwisko_ucznia}`
        console.log(imie_ojca,imie_matki,wyksztalcenie_ojca,wyksztalcenie_matki,zawod_ojca,zawod_matki,stan_zdrowia_ojca,stan_zdrowia_matki,rok_urodzenia_rodzenstwa_dziecka,stan_zdrowia_rodzenstwa_dziecka,warunki_mieszkaniowe,problemy_w_rodzinie,zachowanie_zdrowotne_i_antyzdrowotne_w_rodzinie,przebyte_choroby,uczulenia,objawy_uczulenia,sluch,wzrok,zez,uzywanie,leki,dolegliwosci_objawy,uwagi_rodzicow,inne_uwagi,wymowa,sprawnosc_fizyczna,uzdolnienia,zachowanie,wyniki_w_nauce,absencja_szkolna,trudnosci_szkolne,relacje_z_rowiesnikami,inne_uwagi_wychowawcy,rozwoj_fizyczny,dojrzewanie_plciowe,tarczyca,rozwoj_psychospoleczny,uklad_ruchu,skora,jama_ustna,pozostale_uklady,problem_zdrowotny,grupa_na_wf,moze_uczestniczyc_w_zawodach,ograniczenie_dotyczace_wyboru_i_nauki_zawodu,zalecenia,imie_ucznia,nazwisko_ucznia)
        xhr.send(data);
        xhr.onreadystatechange = await function(){
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText)
                    if (xhr.responseText === "Dodano karte ucznia"){

                        console.log("Dodawanie zakończone pomyślnie")
                        alert("Badanie zostało dodane");
                    }
                    else {
                        errormsg += xhr.responseText;
                    }
                }
                else{
                    errormsg += xhr.responseText;
                }
            }
            else{
                errormsg += xhr.responseText;
            }
        }   
        console.log(errormsg);
    }
}