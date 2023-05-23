
document.addEventListener('DOMContentLoaded', function () {
    EventListener();

    darkMode();
});

function darkMode(){

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    });
}

function EventListener(){
    const mobileMenu = document.querySelector('.mobilne-menu');

    mobileMenu.addEventListener('click', navegacionResponsive)
}

function navegacionResponsive (){
    const navegacion = document.querySelector('.navegacion');

     /*otra forma de hacer es 
    navegacion.classList.toggle('mostrar') */

    if(navegacion.classList.contains('mostrar')){

        navegacion.classList.remove('mostrar');
    }else{
        navegacion.classList.add('mostrar');
    }
}