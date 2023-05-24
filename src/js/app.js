
document.addEventListener('DOMContentLoaded', function () {
    EventListener();

    darkMode();
});

function darkMode(){ // darkmode

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

   // console.log(prefiereDarkMode);

   if(prefiereDarkMode.matches){
    document.body.classList.add('dark-mode');
   }else{
    document.body.classList.remove('dark-mode');
   }
   prefiereDarkMode.addEventListener('change', function(){

    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
       }else{
        document.body.classList.remove('dark-mode');
       }
   });


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