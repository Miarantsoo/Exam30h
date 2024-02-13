import {fetchData, submitData, submitOneData, submitThenFetchData } from "./ajaxFunctions.js";
import { appendTable, resetTable } from "./table.js";

const form = document.getElementById("form");
const table = document.getElementById("tbody-categorie");


window.onload = async e => {
    try {
        const data = await fetchData("traitement-insert-categorie.php");
        console.log(data);

        appendTable(data, table, "traitement-insert-categorie.php");
    } catch (error) {
        console.log(error);
    }
}

form.addEventListener("submit", async e => {
    e.preventDefault();
    try {
        resetTable(table);
        await submitData(form, "traitement-insert-categorie.php");
        const data = await fetchData("traitement-insert-categorie.php");
        console.log(data);
        appendTable(data, table, "traitement-insert-categorie.php");
    } catch (error) {
        console.log(error);
    }
});
