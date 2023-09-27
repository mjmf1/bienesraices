<?php

$id = $_GET['id'];

$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('location: /bienesraices');
}

require 'includes/app.php';  

$conn = conectarDB();
// Consultar
$query = "SELECT * FROM propiedades WHERE id =  ${id}";
//Obtener resultados
$resultado = mysqli_query($conn, $query);

// Validar que existe el resgistro con una id correcto
if(!$resultado->num_rows){
    header('location: /bienesraices');
}

$propiedad = mysqli_fetch_assoc($resultado);

    incluirTemplate('header');
 ?>

    <main class="contenedor seccion contenido-centrado">
   
        <h1><?php echo $propiedad['titulo'];?></h1>

        

        <img loading="lazy" src="/bienesraices/imagenes/<?php echo $propiedad['imagen'];?>" alt="anuncio">

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad['precio'];?></p>
            <ul class="icono-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                    <p><?php echo $propiedad['wc'];?></p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                    <p><?php echo $propiedad['estacionamiento'];?></p>

                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="icono habitaciones" loading="lazy">
                    <p><?php echo $propiedad['habitaciones'];?></p>
                </li>

            </ul>
            <p><?php echo $propiedad['descripcion'];?></p>


        </div>
    </main>

    <?php 

     // Cerrar la conexion
     mysqli_close($conn);
     ?>

 incluirTemplate('footer');
 ?>