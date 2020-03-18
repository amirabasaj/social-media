const loginFormBtn=document.querySelector('.loginRegister-container-box_loginForm_registerLink');

const registerFormBtn=document.querySelector('.loginRegister-container-box_registerForm_loginLink');

const loadingBox=document.querySelector('.loader');

const errorBoxParagraph=document.querySelector('.loginRegister-container-box_loginForm_errorBox p')

const registerForm=document.querySelector('.loginRegister-container-box_registerForm');
const loginForm=document.querySelector('.loginRegister-container-box_loginForm');
let registerFormHeight=registerForm.offsetHeight;
let loginFormHeight=loginForm.offsetHeight;

registerForm.style.height=registerFormHeight+'px';
loginForm.style.height=0+'px';


loginFormBtn.addEventListener('click',()=>{
  
  loginForm.style.transitionProperty="height";
  loginForm.style.transitionDuration=500+'ms';
  loginForm.style.height=0+'px';

  window.setTimeout(()=>{

    loginForm.style.removeProperty('transition-duration');
    loginForm.style.removeProperty('transition-property');

    registerForm.style.transitionProperty = "height";
    registerForm.style.transitionDuration = 500 + 'ms';
    registerForm.style.height = registerFormHeight + 'px'

    window.setTimeout( () => {
      registerForm.style.removeProperty('transition-duration');
      registerForm.style.removeProperty('transition-property');
    }, 500);

  },500);

});


registerFormBtn.addEventListener('click',()=>{
  
  registerForm.style.transitionProperty="height";
  registerForm.style.transitionDuration=500+'ms';
  registerForm.style.height=0+'px';

  window.setTimeout(()=>{

    registerForm.style.removeProperty('transition-duration');
    registerForm.style.removeProperty('transition-property');

    loginForm.style.transitionProperty = "height";
    loginForm.style.transitionDuration = 500 + 'ms';
    loginForm.style.height = loginFormHeight + 'px'

    window.setTimeout( () => {
      loginForm.style.removeProperty('transition-duration');
      loginForm.style.removeProperty('transition-property');
    }, 500);

  },500);
  
});


loginForm.addEventListener('submit',function(e){

  e.preventDefault();

  loadingBox.classList.add('loader--active');
   const usernameField=this.querySelector('input[name="login_user"]').value;
   const passwordField=this.querySelector('input[name="login_password"]').value;

   var xmlhttp = new XMLHttpRequest();

   xmlhttp.onreadystatechange = function() {


       window.setTimeout(()=>{

        loadingBox.classList.remove('loader--active');
        if (this.readyState == 4 && this.status == 200) {
          const response=JSON.parse(this.responseText);
          if(response.success==="YES"){
            console.log(location.hostname+':'+location.port+'/home.php');
            location.replace('http://'+location.hostname+':'+location.port+'/home.php');
          }
          else{
            errorBoxParagraph.parentElement.classList.add('loginRegister-container-box_loginForm_errorBox--active')
             errorBoxParagraph.textContent=response.error;
          }
        }

     },1000);
   };

   xmlhttp.open("POST", "../../auth/login_handler.php");
   xmlhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
   xmlhttp.send(JSON.stringify({"login_username":usernameField,"login_password" : passwordField}));
   
});