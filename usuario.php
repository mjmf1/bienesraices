<?php

// Importar conexion
require 'includes/config/database.php';
$conn = conectarDB();

// Email y contraseña
$email = "correo@correo.com";
$password = "123456";

//Query para crear el usuario

$query = "INSERT INTO usuarios (email, password) VALUES ('${email}', '${password}') ";

echo $query;

//Agregarlo a la base de datos
mysqli_query($conn,$query);