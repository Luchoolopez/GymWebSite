document.getElementById("btn__iniciar-sesion").addEventListener("click", IniciarSesion);
document.getElementById("btn__registrarse").addEventListener("click", Register);
window.addEventListener("resize", AnchoPagina);


//variables
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");


//Movimiento de pagina
function AnchoPagina(){
    if(window.innerWidth > 850){
        caja_trasera_login.style.display = "block";
        caja_trasera_register.style.display = "block";
    }else{
        caja_trasera_register.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.display = "none";
        formulario_login.style.display = "block";
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0";
    }
}

AnchoPagina();


function IniciarSesion(){
    if(window.innerWidth > 850){
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "10px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    }else {
        formulario_register.style.display = "none";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "block";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }

}


function Register(){
    if(window.innerWidth > 850){
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    }else{
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }
}

//validacion de formulario
document.addEventListener("DOMContentLoaded", function(){
    //captura los formularios
    const loginForm = document.querySelector(".formulario__login");
    const registerForm = document.querySelector(".formulario__register");

    //validacion del login
    loginForm.addEventListener("submit", function(event){
        let email = loginForm.querySelector("input[placeholder='Correo Electronico']").value.trim();
        let password = loginForm.querySelector("input[placeholder='Contraseña']").value.trim();

        if(email === "" || password === ""){
            alert("Todos los campos son obligatorios en el Login");
            event.preventDefault(); //evita que se envie el formulario
        }
    });

    //Validacion del registro
    registerForm.addEventListener("submit", function(event){
        let nombre = loginForm.querySelector("input[placeholder='nombre_completo']").value.trim();
        let email = loginForm.querySelector("input[placeholder='correo']").value.trim();
        let usuario = loginForm.querySelector("input[placeholder='usuario']").value.trim();
        let contrasenia = loginForm.querySelector("input[placeholder='contrasenia']").value.trim();

        if(nombre === "" || email === "" || usuario === "" || contrasenia === ""){
            alert("Todos los campos son obligatorios en el Registro");
            event.preventDefault();
        }
    });
});