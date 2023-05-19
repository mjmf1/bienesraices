
document.addEventListener('DOMContentLoaded', function () {
    EventListener();
});

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