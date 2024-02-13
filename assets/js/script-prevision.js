function getXhr ()
{
    var xhr; 
    try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   return xhr;}
    catch (e) 
    {
        try {   xhr = new ActiveXObject('Microsoft.XMLHTTP'); return xhr;}
        catch (e2) 
        {
        try {  xhr = new XMLHttpRequest();  return xhr;}
        catch (e3) {  xhr = false;   }
        }
    }
}

function getMessage(xhr)
{
    var form = document.getElementById("form");
    var formData = new FormData(form);
    xhr.onreadystatechange  = function()
    { 
        if(xhr.readyState  == 4){
            if(xhr.status  == 200) {
                var retour = xhr.responseText;
                var resteTotal = document.getElementById("poid-total");
                var montant = document.getElementById("montant-depense");
                console.log(retour);
                var tableRetour = retour.split("//");
                resteTotal.innerHTML = tableRetour[0];
                montant.innerHTML = tableRetour[1];
            } else {
                document.dyn="Error code " + xhr.status;
            }
        }
    }; 
    //XMLHttpRequest.open(method, url, async)
    xhr.open("POST", "traitement-prevision.php",  true); 
    
    //XMLHttpRequest.send(body)
    xhr.send(formData);
}
window.addEventListener("load", function () {

function sendData() {
    var xhr = getXhr(); 

    var formData = new FormData(form);

}

    // Accédez à l'élément form …
    var form = document.getElementById("form");

    // … et prenez en charge l'événement submit.
    form.addEventListener("submit", function (event) {
    event.preventDefault(); // évite de faire le submit par défaut
        // alert(getMessage(getXhr()));
        getMessage(getXhr());
        sendData();
    });
});