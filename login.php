<?php 
    require 'includes/funciones.php';  
    incluirTemplate('header');
 ?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <form action="" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-MAIL</label>
                <input type="email" placeholder="Tu E-MAIL" id="email">

                <label for="password">Password</label>
                <input type="password" placeholder="Tu Password" id="password">

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class=" boton boton-verde">

    </main>

    <?php 
 incluirTemplate('footer');
 ?>