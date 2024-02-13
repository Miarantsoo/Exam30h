import {fetchData, submitData, submitOneData, submitThenFetchData } from "./ajaxFunctions.js";
import { appendTable, refreshForm, resetTable } from "./table.js";

const form = document.getElementById("form");
const table = document.getElementById("tbody-variete");


window.onload = async e => {
    try {
        const data = await fetchData("traitement-insert-variete.php");
        console.log(data);
        appendTable(data, table, "traitement-insert-variete.php");
    } catch (error) {
        console.log(error);
    }
}

form.addEventListener("submit", async e => {
    e.preventDefault();
    try {
        resetTable(table);
        await submitData(form, "traitement-insert-variete.php");
        const data = await fetchData("traitement-insert-variete.php");
        console.log(data);
        appendTable(data, table, "traitement-insert-variete.php");
    } catch (error) {
        console.log(error);
    }
});

document.getElementById("refresh").onclick = () => {
    refreshForm(form);
}
