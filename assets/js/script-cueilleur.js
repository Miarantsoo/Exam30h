import {fetchData, submitData, submitOneData, submitThenFetchData } from "./ajaxFunctions.js";
import { appendTable, resetTable } from "./table.js";

const form = document.getElementById("form");
const table = document.getElementById("tbody-cueilleur");


window.onload = async e => {
    try {
        const data = await fetchData("traitement-insert-cueilleur.php");
        console.log(data);

        const dataSelect = await fetchData("traitement-genre.php");
        const select = document.getElementById("select-genre");
        for (let i = 0; i < dataSelect.length; i++) {
            const element = dataSelect[i];
            const option = document.createElement("option");
            option.value = element["idGenre"];
            option.innerHTML = element["nom"];
            select.appendChild(option);
        }


        appendTable(data, table, "traitement-insert-cueilleur.php");
    } catch (error) {
        console.log(error);
    }
}

form.addEventListener("submit", async e => {
    e.preventDefault();
    try {
        resetTable(table);
        await submitData(form, "traitement-insert-cueilleur.php");
        const data = await fetchData("traitement-insert-cueilleur.php");
        console.log(data);
        appendTable(data, table, "traitement-insert-cueilleur.php");
    } catch (error) {
        console.log(error);
    }
});



document.getElementById("refresh").onclick = () => {
    refreshForm(form);
}
