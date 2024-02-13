import {fetchData, submitData, submitOneData, submitThenFetchData } from "./ajaxFunctions.js";
import { appendTable, resetTable } from "./table.js";

const form = document.getElementById("form");
//const table = document.getElementById("tbody-parcelle");


window.onload = async e => {
    try {
        const data = await fetchData("traitement-insert-depense.php");
        console.log(data);

        const dataSelect = await fetchData("traitement-insert-categorie.php");
        const select = document.getElementById("select");
        for (let i = 0; i < dataSelect.length; i++) {
            const element = dataSelect[i];
            const option = document.createElement("option");
            option.value = element["idCategorie"];
            option.innerHTML = element["categorie"];
            select.appendChild(option);
        }

        //appendTable(data, table, "traitement-insert-depense.php");
    } catch (error) {
        console.log(error);
    }
}

form.addEventListener("submit", async e => {
    e.preventDefault();
    try {
       // resetTable(table);
        await submitData(form, "traitement-insert-depense.php");
        const data = await fetchData("traitement-insert-depense.php");
        console.log(data);
        //appendTable(data, table, "traitement-insert-parcelle.php");
    } catch (error) {
        console.log(error);
    }
});