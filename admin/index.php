<?php
//Muestra un mensaje condicional


    //Importar la Conexion
    require '../includes/config/database.php';

    $conn = conectarDB();

    //Escribir la Query
    $query = "SELECT * FROM propiedades";

   //Consultar la BD 
   $resultadoConsulta = mysqli_query($conn , $query);


   $resultado = $_GET['resultado'] ?? null;

// incluye un template
require '../includes/funciones.php';
incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php if ($resultado == 1) : ?>

        <p class="alerta exito">Anuncio Creado Correctamente</p>

        <?php elseif ($resultado == 2) : ?>

<p class="alerta exito">Anuncio Actualizado Correctamente</p>

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
         <tbody>  <!--Mostrar los resultados -->
         <?php while($propiedad = mysqli_fetch_assoc($resultadoConsulta)): ?>
            <tr>
                <td><?php echo $propiedad['id'];?></td>
                <td><?php echo $propiedad['titulo'];?></td>
                <td><img src="/bienesraices/imagenes/<?php echo $propiedad['imagen'];?>" class="imagen-tabla" alt="imagenes"></td>
                <td>$<?php echo $propiedad['precio'];?></td>
                <td>
                    <a href="#" class="boton-rojo-block">Eliminar</a>
                    <a href="/bienesraices/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id'];?> " class="boton-amarillo-block">Actualizar</a>
                </td>
            </tr>
            <?php endwhile; ?>
    </table>

</main>

<?php

//   Cerrar la conexion
    mysqli_close($conn);

incluirTemplate('footer');
?>