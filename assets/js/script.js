import {fetchData, submitData, submitThenFetchData } from "./ajaxFunctions.js";

const form = document.getElementById("form-admin");
const body = document.querySelector("body");

console.log(form);
console.log("hoho");

function showErrors(messageErreur){
    const div = document.createElement("div");
    // div.class = "alert alert-danger";
    div.classList.add("alert");
    div.classList.add("alert-danger");
    div.classList.add("position-error");
    const message = document.createElement("h3");
    message.innerHTML = messageErreur;
    div.appendChild(message);
    body.appendChild(div);
}


form.addEventListener("submit",async e => {
    e.preventDefault();
    try {
        const data =await submitThenFetchData(form, "traitementConnexionAdmin.php");
        if (data != "") {
            showErrors(data);
        }
    } catch (error) {
        console.log(error);
    }
});
