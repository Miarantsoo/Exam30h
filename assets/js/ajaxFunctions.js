export function fetchData (fileName) {
    return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();

        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const values = JSON.parse(xhr.responseText);
                    resolve(values);
                } else {
                    reject("Error");
                }
            }
        }

        xhr.open("GET", "treatments/"+fileName);
        xhr.send(null);
    });
}

export function submitData(data, fileName){
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
    
        const formData = new FormData(data);
    
        console.log(formData);
        xhr.onload =async e => {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const msg = (e.target.responseText != "") ? e.target.responseText : "OK";
                    resolve(msg);
                } 
            }
        }
    
        xhr.open("POST", "treatments/"+fileName);
        xhr.send(formData);
    });
}

export function submitDataWithSpecificKey(data, key, fileName){
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
    
        const formData = new FormData(data);
    
        console.log(formData);
        xhr.onload =async e => {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const msg = (e.target.responseText != "") ? e.target.responseText : "OK";
                    resolve(msg);
                } 
            }
        }
    
        xhr.open("GET", "treatments/"+fileName+"?id="+key);
        xhr.send(formData);
    });   
}

export function submitOneData(data, fileName){
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();

        console.log(fileName);
        xhr.onreadystatechange =async e => {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const msg = (e.target.responseText != "") ? e.target.responseText : "OK";
                    resolve(msg);
                } else {
                    reject("Error");
                }
            }
        }
    
        xhr.open("GET", "treatments/"+fileName+"?id="+data);
        xhr.send(null);
    });
}

export async function submitThenFetchData (data, fileName){
    return new Promise((resolve, reject) => {
        let xhr = new XMLHttpRequest();
        const formData = new FormData(data);
        console.log(formData);
    
        xhr.onload = e => {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    const res =  (xhr.responseText == "True" || xhr.responseText == "False") ? xhr.responseText :JSON.parse(xhr.responseText);
                    console.log(res);
                    resolve(res);
                } else {
                    reject("Error");
                }
            }
        }
        console.log(fileName);
        xhr.open("POST", "treatments/"+fileName);
        xhr.send(formData);
    });
}