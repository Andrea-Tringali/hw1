
function inputValidationU(){
  console.log('ciao');
        if(loginform.username.value === ''){
            loginform.username.classList.add('error');
            errorMessageU.classList.remove('hidden');
        }
        else{
            loginform.username.classList.remove('error');
            errorMessageU.classList.add('hidden');
        }
}

function inputValidationP(){
    console.log('ciao');
          if(loginform.password.value === ''){
              loginform.password.classList.add('error');
              errorMessageP.classList.remove('hidden');
          }
          else{
              loginform.password.classList.remove('error');
              errorMessageP.classList.add('hidden');
          }
}

function inputValidation(event){
    if(loginform.username.value === '' || loginform.password.value === '' ){
        event.preventDefault;
    }
}

const loginform = document.querySelector('form');
loginform.addEventListener('submit', inputValidation);

const errorMessageU = document.querySelector('.erroreU');
const errorMessageP = document.querySelector('.erroreP');

const formStatus = {'upload': true};
document.querySelector('#username').addEventListener('blur', inputValidationU);
document.querySelector('#password').addEventListener('blur', inputValidationP);
  
