import {submitOneData, fetchData} from "./ajaxFunctions.js"; 

async function supprElement(idElement, fileName, table){
    try {
        await submitOneData(idElement, fileName);
        const data = await fetchData(fileName);
        resetTable(table);
        appendTable(data, table, fileName);
    } catch (error) {
        console.log(error);
    }
}

async function modifElement(idElement, fileName){
    const data = await fetchData(fileName);
    const keys = [];
    for(const key in data[0]) keys.push(key); 

    console.log(keys);

    for (let i = 0; i < data.length; i++) {
        const element = data[i];
        for(const key in element){
            if (element[key] == idElement) {
                const form = document.getElementById("form");
                if (form) {
                    let inputs = document.querySelectorAll(":scope input");
                    console.log(inputs.length);
                    for (let j = 0; j < inputs.length; j++) {
                        const element2 = inputs[j];
                        element2.value = element[keys[j]];
                    }
                }
            }
        }
    }
}

export function appendTable(data, table, fileName){
    for (let i = 0; i < data.length; i++) {
        const element = data[i];
        const th = document.createElement("tr");
        console.log(element.length);
        let keys = null;
        let index = 0;
        for (const key in element) {
            if (index==0) {
                keys = key;
            } else {
                const columns = element[key];
                const td = document.createElement("td");
                td.innerHTML = columns;
                
                th.appendChild(td);
            }
            index++;
        }
        const lastTd = document.createElement("td");
        const divContainerSpan = document.createElement("div");
        divContainerSpan.classList.add("col-12"); 
        divContainerSpan.classList.add("d-flex"); 
        divContainerSpan.classList.add("justify-content-around"); 
    
        const spanModif = document.createElement("span");
        spanModif.classList.add("bi");
        spanModif.classList.add("bi-pencil");
        spanModif.id = "icon";
        spanModif.onclick =async () => {
            await modifElement(data[i][keys], fileName);
        } 
    
        const spanSuppr = document.createElement("span");
        spanSuppr.classList.add("bi");
        spanSuppr.classList.add("bi-trash");
        spanSuppr.id = "icon";
        // spanSuppr.setAttribute("onclick", "supprElement("+data[i][keys]+")");
        spanSuppr.onclick = async () => {
            await supprElement(data[i][keys], fileName, table);
        } 

        divContainerSpan.appendChild(spanModif);
        divContainerSpan.appendChild(spanSuppr);
        lastTd.appendChild(divContainerSpan);
        th.appendChild(lastTd);
        table.appendChild(th);
    }
}

export function resetTable(tbody){
    tbody.innerHTML = "";
}

export function refreshForm(form){
    for (let i = 0; i < form.elements.length; i++) {
        const element = form.elements[i];
        if (element.type !== "button" && element.type !== "submit" && element.type !== "reset") {
            element.value = "";
        }
        
    }
} 