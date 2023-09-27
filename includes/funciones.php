<?php

// include 'app.php';


define('FUNCIONES_URL', __DIR__ . "/funciones/funciones.php");
define('TEMPLATES_URL', __DIR__ . "/templates");


function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() : void {
    session_start();
    
    if(!$_SESSION['login']) {
        header('location:/');
    } 
}

function debuguear($variable)  {
    echo '<pre>';
    var_dump($variable);
     echo '</pre>';
     exit;
    
}