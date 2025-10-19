let div = document.getElementById("div");
let divContenuto = document.querySelector(".contenuto");
let GET = document.getElementById("get");
let POST = document.getElementById("post");
let PUT = document.getElementById("put");
let DELETE = document.getElementById("delete");
let dataForm = document.getElementById("data-form");
let table = document.getElementsByClassName("table");
let tableBody = document.getElementById("table-body");
const baseUrl = "https://cad80e9da0df594c6373.free.beeceptor.com/api/users/";
let maxId = 0;


/*GET.addEventListener("click", get);
POST.addEventListener("click", post);
PUT.addEventListener("click", put);
DELETE.addEventListener("click", del);*/

function get() {
    const requestOptions = {
    method: "GET",
    redirect: "follow"
    };

    fetch(`${baseUrl}`, requestOptions)
    .then((response) => response.text())
    .then((result) => {
        console.log(result);
        const tableBody = document.getElementById("table-body");
        tableBody.innerHTML = "";
        const data = JSON.parse(result);
        let rowsHtml = "";
        data.forEach(item => {
            maxId = Math.max(maxId, item.id);
            rowsHtml += `<tr>
            <td>${item.id}</td>
            <td>${item.nome}</td>
            <td>${item.cognome}</td>
            <td>${item.email}</td>
            <td>
                <button class="btn btn-primary modifica-btn" data-id="${item.id}">Modifica</button>
                <button class="btn btn-danger elimina-btn" data-id="${item.id}">Elimina</button>
            </td>
            </tr>`;
        });
        tableBody.innerHTML = rowsHtml;

        // Aggiungi event listener ai bottoni dopo aver inserito le righe
        document.querySelectorAll('.modifica-btn').forEach(btn => {
            btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            modifica(id);
            console.log('Modifica', id);
            });
        });
        document.querySelectorAll('.elimina-btn').forEach(btn => {
            btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            del(id);
            console.log('Elimina', id);
            });
        });
    })
    .catch((error) => console.error(error));
};

function post(raw) {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const requestOptions = {
    method: "POST",
    headers: myHeaders,
    body: raw,
    redirect: "follow"
    };

    fetch(`${baseUrl}`, requestOptions)
    .then((response) => response.text())
    .then((result) => console.log(result))
    .catch((error) => console.error(error));

    console.log(raw);
};

function put(raw, id) {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    const requestOptions = {
        method: "PUT",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };

    fetch(`${baseUrl}${id}`, requestOptions)
    .then((response) => response.text())
    .then((result) => console.log(result))
    .catch((error) => console.error(error));
};

async function del(id) {
    const requestOptions = {
        method: "DELETE",
        redirect: "follow"
    };

    /*fetch(`${baseUrl}${id}`, requestOptions)
        .then((response) => response.text())
        .then((result) => console.log(result))
        .catch((error) => console.error(error));*/

    let response = await fetch(`${baseUrl}${id}`, requestOptions);
    let result = await response.text();
    console.log(result);
    
    location.reload();
};

dataForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Impedisce il comportamento predefinito del form

    const formData = new FormData(dataForm);
    const data = {};
    data.id = ++maxId;
    formData.forEach((value, key) => {
        data[key] = value;
    });

    const raw = JSON.stringify(data);

    post(raw);
    
    /*
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");
    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };

    fetch(`${baseUrl}`, requestOptions)
        .then((response) => response.text())
        .then((result) => console.log(result))
        .catch((error) => console.error(error));*/

    //location.reload();
});


document.addEventListener("DOMContentLoaded", get);

function modifica(id) {
    // Trova la riga corrispondente all'ID
    const row = document.querySelector(`button[data-id='${id}']`).closest('tr');
    const cells = row.querySelectorAll('td');

    // Crea un form di modifica
    const formHtml = `
        <form id="edit-form">
            <input type="text" name="nome" value="${cells[1].innerText}" required />
            <input type="text" name="cognome" value="${cells[2].innerText}" required />
            <input type="email" name="email" value="${cells[3].innerText}" required />
            <button type="submit">Salva</button>
            <button type="button" id="cancel-btn">Annulla</button>
        </form>
    `;
    cells[1].innerHTML = formHtml;
    cells[2].innerHTML = '';
    cells[3].innerHTML = '';
    cells[4].innerHTML = '';

    // Aggiungi event listener per il form di modifica
    const editForm = document.getElementById('edit-form');
    editForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(editForm);
        const updatedData = {};
        formData.forEach((value, key) => {
            updatedData[key] = value;
        });
        updatedData.id = id; // Mantieni l'ID originale

        const raw = JSON.stringify(updatedData);
        put(raw, id);

        location.reload();
    });

    // Aggiungi event listener per il bottone Annulla
    document.getElementById('cancel-btn').addEventListener('click', function() {
        get(); // Ricarica i dati originali
    });
}