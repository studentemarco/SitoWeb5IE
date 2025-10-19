let submit = document.getElementById("submitBtn");
let visualizzaArticoli = document.getElementById("visualizza");
let form = document.getElementById("form");

let prezzo = document.getElementById("prezzo");
let idInput = document.getElementById("id");
let titolo = document.getElementById("titolo");

submit.addEventListener("click", function(){
    // resetto eventuali errori vecchi
    prezzo.classList.remove("is-invalid");
    idInput.classList.remove("is-invalid");
    titolo.classList.remove("is-invalid");

    let isValid = true;

    if(prezzo.value <= 0){
        prezzo.classList.add("is-invalid");
        isValid = false;
    } 
    if(idInput.value.length == 0 || idInput.value < 0){
        idInput.classList.add("is-invalid");
        isValid = false;
    } 
    if(titolo.value.length == 0){
        titolo.classList.add("is-invalid");
        isValid = false;
    }
    if(isValid){
        form.submit();
    }
})

visualizzaArticoli.addEventListener("click", function(){
    // apre una nuova finestra con la lista degli articoli
    window.open("show.php", "_blank");
});