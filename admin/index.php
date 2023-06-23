<?php

$resultado = $_GET['resultado'] ?? null;

    require '../includes/funciones.php';  
    incluirTemplate('header');
 ?>
    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>

        <?php if($resultado == 1): ?>

            <p class="alerta exito">Anuncio Creado Correctamente</p>

            <?php endif; ?>



        <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propieda</a>

        <table class="propiedades">
            <thead>

            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
                
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Casa en la Playa</td>
                    <td><img src="/bienesraices/imagenes/1be769320b0cb66e1fecdad94e3f950d.jpg" class="imagen-tabla" alt="imagenes"></td>
                    <td>$1200000</td>
                    <td>
                    <a href="#" class="boton-rojo-block">Eliminar</a>
                    <a href="#" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
        </table>

    </main>

    <?php 
 incluirTemplate('footer');
 ?>