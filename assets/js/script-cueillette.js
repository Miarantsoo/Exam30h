import {fetchData, submitData, submitOneData, submitThenFetchData } from "./ajaxFunctions.js";

const form = document.getElementById("form");

console.log(form);


window.onload = async e => {
    try {
        const dataSelect = await fetchData("traitement-insert-cueilleur.php");
        const select = document.getElementById("select");
        for (let i = 0; i < dataSelect.length; i++) {
            const element = dataSelect[i];
            const option = document.createElement("option");
            option.value = element["idCueilleur"];
            option.innerHTML = element["nom"];
            select.appendChild(option);
        }

        const dataParcelle = await fetchData("traitement-insert-parcelle.php");
        console.log(dataParcelle);
        const selectParcelle = document.getElementById("select-parcelle");
        for (let i = 0; i < dataParcelle.length; i++) {
            const element = dataParcelle[i];
            const option = document.createElement("option");
            option.value = element["numeroParcelle"];
            option.innerHTML = element["numeroParcelle"];
            selectParcelle.appendChild(option);
        }

    } catch (error) {
        console.log(error);
    }
}

form.addEventListener("submit", async e => {
    e.preventDefault();
    try {
        await submitData(form, "traitement-insert-cueillette.php");
    } catch (error) {
        console.log(error);
    }
});