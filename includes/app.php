<?php

namespace App;

use App\Propiedad;

include 'funciones.php';
include 'config/database.php';
include __DIR__ . '/../vendor/autoload.php';

$conn = conectarDB();

Propiedad::setDB($conn);