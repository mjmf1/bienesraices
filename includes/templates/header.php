<?php

if(!isset($_SESSION)){
    session_start();
}

 $auth = $_SESSION['login'] ?? false;

//  var_dump($auth);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/bienesraices/build/css/app.css">
   
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio': ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/bienesraices/index.php">
                    <img src="/bienesraices/build/img/logo.svg" alt="logo tipo de bienes raices">
                    
                </a>

                <div class="mobilne-menu">
                    <img src="/bienesraices/build/img/barras.svg" alt="icono menu responsive">
                   
                </div>

                <div class="derecha">
                    <img src="/bienesraices/build/img/dark-mode.svg" alt="" class="dark-mode-boton">
                    
                    <nav class="navegacion">
                        <a href="nosotros.php">Nosotros</a>
                        <a href="anuncios.php">Anuncios</a>
                        <a href="blog.php">Blog</a>
                        <a href="contacto.php">contacto</a>

                        <?php if($auth): ?>
                            <a href="cerrar-sesion.php">Cerrar Sesión</a>
                            <?php endif?>

                            <?php if(!$auth): ?>
                            <a href="login.php">Iniciar Sesión</a>
                            <?php endif?>
                    </nav>
                </div>

                
                
            </div> <!-- barra-->
            <?php if($inicio){?>
                <h1>Venta de Casas y Departamentos Esclusivos de Lujos</h1>
            <?php }?>
            

        </div>
    </header>