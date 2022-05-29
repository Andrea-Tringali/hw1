function controllaNome(event){
    const input = event.currentTarget;

    if(formStatus[input.name] = input.value.length > 0){
        input.parentNode.parentNode.classList.remove('errore');
    } else {
        input.parentNode.parentNode.classList.add('errore');
    }

    controllaForm();
}

function controllaUsername(event){
    const input = document.querySelector('.username input');

    if(!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)){
        input.parentNode.parentNode.querySelector('span').textContent = "Inserisci solo lettere, numeri e underscore";
        input.parentNode.parentNode.classList.add('errore');
        formStatus.username = false;
        controllaForm();
    } else {
        // Controlliamo che non ci sia un altro username uguale nel database
        fetch("check_username.php?q=" + encodeURIComponent(input.value)).then(fetchResponse).then(jsonControllaUsername);
    }
}

function controllaEmail(event){
    const input = document.querySelector('.email input');

if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(input.value).toLowerCase())){
    document.querySelector('.email span').textContent = "Email non valida";
    document.querySelector('.email').classList.add('errore');
    formStatus.email = false;
    controllaForm();
} else {
    fetch("check_email.php?q=" + encodeURIComponent(String(input.value).toLowerCase())).then(fetchResponse).then(jsonControllaEmail);
}
}

function fetchResponse(response){
    if(!response.ok) return null; 
    return response.json();
}

function jsonControllaUsername(json){
    // Controllo il campo exists ritornato dal JSON
    if(formStatus.username = !json.exists){
        document.querySelector('.username').classList.remove('errore');
    } else { 
        document.querySelector('.username span').textContent = "Nome utente già utilizzato";
        document.querySelector('.username').classList.add('errore');
    }

    controllaForm();
}

function jsonControllaEmail(json){
    // Controllo il campo exists ritornato dal JSON
    if(formStatus.email = !json.exists){
        document.querySelector('.email').classList.remove('errore');
    } else { 
        document.querySelector('.email span').textContent = "Email già utilizzata";
        document.querySelector('.email').classList.add('errore');
    }

    controllaForm();
}

function controllaPassword(event){
    const input = document.querySelector('.password input');
    if(formStatus.password = input.value.length >= 8) {
            if(/[0-9]/.test(input.value)) {
                document.querySelector('.password').classList.remove('errore');
            } else {
                document.querySelector('.password span').textContent = "Inserisci almeno un numero";
                document.querySelector('.password').classList.add('errore');
            }
    } else { 
        document.querySelector('.password').classList.add('errore');
    }

    controllaForm();
}

function controllaConfermaPassword(event){
    const input = document.querySelector('.conferma_password input');
    if(formStatus.conferma_password = input.value === document.querySelector('.password input').value){
        document.querySelector('.conferma_password').classList.remove('errore');
    }
    else { 
        document.querySelector('.conferma_password').classList.add('errore');
    }

    controllaForm();
}

function controllaForm(){
    /* Questa funzione viene chiamata ad ogni funzione di controllo, è la funzione generale che dà il controllo definitivo al form, 
    cioè controlla che sia stato riempito correttamente*/

    // Controllo il consenso al trattamento dei dati
    document.getElementById('submit').disabled = !document.querySelector('.allow input').checked ||
    // Controlla che tutti i campi siano pieni
    Object.keys(formStatus).length !== 7 ||
    // Controlla che i campi non siano false 
    Object.values(formStatus).includes(false);
}


const formStatus = {'upload': true};
document.querySelector('.nome input').addEventListener('blur', controllaNome);
document.querySelector('.cognome input').addEventListener('blur', controllaNome);
document.querySelector('.username input').addEventListener('blur', controllaUsername);
document.querySelector('.email input').addEventListener('blur', controllaEmail);
document.querySelector('.password input').addEventListener('blur', controllaPassword);
document.querySelector('.conferma_password input').addEventListener('blur', controllaConfermaPassword);
document.querySelector('.allow input').addEventListener('change', controllaForm);

//Controllo gli elementi con classe .error

if(document.querySelector('.error') !== null){
    controllaUsername(); 
    controllaPassword(); 
    controllaConfermaPassword();
    controllaEmail();
    document.querySelector('.nome input').dispatchEvent(new Event('blur'));
    document.querySelector('.cognome input').dispatchEvent(new Event('blur'));
}
