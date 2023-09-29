<?php

function conectarDB() : mysqli
{
   $conn = new mysqli('127.0.0.1', 'root', '0000', 'bienesraices');

// define('DB_USUARIO', 'root');
// define('DB_PASSWORD', '0000');
// define('DB_HOST', '127.0.0.1');
// define('DB_NOMBRE', 'bienesraices');

// $conn = mysqli_connect(DB_HOST, DB_USUARIO, DB_PASSWORD, DB_NOMBRE , 3306);

   if(!$conn){
    echo "Error no se conecto";
    exit;
   }
   return $conn;
}