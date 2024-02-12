import {fetchData, submitData, submitThenFetchData } from "./ajaxFunctions.js";

const form = document.getElementById("form-admin");

console.log(form);

form.addEventListener("submit",async e => {
    e.preventDefault();
    const data = await submitThenFetchData(form, "traitementConnexionAdmin.php");
    console.log(data);
})