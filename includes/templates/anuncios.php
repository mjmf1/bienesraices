
<?php

$conn = conectarDB();
// Consultar
$query = "SELECT * FROM propiedades LIMIT ${limite}";
//Obtener resultados
$resultado = mysqli_query($conn, $query);

?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)):   ?>
       
                <div class="anuncio">
                    
                        <img loading="lazy" src="/bienesraices/imagenes/<?php echo $propiedad['imagen'];?>" alt="anuncio">
                    
                    <div class="contenido-anuncio">
                        <h3><?php echo $propiedad['titulo'];?></h3>
                        <p><?php echo $propiedad['descripcion'];?></p>
                        <p class="precio">$<?php echo $propiedad['precio'];?></p>
    
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
                        <a href="anuncio.php?id=<?php echo $propiedad['id'];?>" class=" boton-amarillo-block">
                            Ver Propiedad
                        </a>

                         </div>  <!--contenido anuncio -->
                             </div> <!--anuncio -->
                             <?php endwhile; ?>
                                 </div> <!--contenedor anuncios -->
                        
                  <?php
                  // Cerrar la conexion
                  mysqli_close($conn);
                  ?>