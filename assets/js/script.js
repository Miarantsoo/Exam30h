import {fetchData, submitData, submitThenFetchData } from "./ajaxFunctions.js";

const form = document.getElementById("form-admin");
const body = document.querySelector("body");

console.log(form);
console.log("hoho");

function showErrors(messageErreur){
    const div = document.createElement("div");
    div.classList.add("alert");
    div.classList.add("alert-danger");
    div.classList.add("position-error");
    const message = document.createElement("h3");
    message.innerHTML = messageErreur;
    div.appendChild(message);
    body.appendChild(div);

    setTimeout(() => {
        body.removeChild(div);
    }, 3000);
}


form.addEventListener("submit",async e => {
    e.preventDefault();
    const button = document.getElementById("connect-admin");
    button.disabled = true;
    button.innerHTML = "";
    const span = document.createElement("span");
    span.classList.add("spinner-border");
    span.classList.add("spinner-border-sm");
    span.role = "status";
    span.ariaHidden = "true";
    const strong = document.createElement("strong");
    strong.innerHTML = "  Loading...";
    button.appendChild(span);
    button.appendChild(strong);
    try {
        const data =await submitThenFetchData(form, "traitement-connexion-admin.php");
        if (data != "Mety") {
            button.innerHTML = "Se Connecter";
            const dataWithoutQuotes = data.replace(/"/g, "");
            showErrors(dataWithoutQuotes);
            button.disabled = false;
        } else {
            window.location.href = "accueil-admin.php";
        }
    } catch (error) {
        console.log(error);
    }
});
