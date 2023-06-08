<?php 
    require '../../includes/funciones.php';  
    incluirTemplate('header');
 ?>
    <main class="contenedor seccion">
        <h1>crear</h1>

        <a href="/bienesraices/admin" class="boton boton-verde">Volver</a>
    <form action="" class="formulario">
     <fieldset>
        <legend>Información General</legend>

        <label for="titulo">Titulo:</label>
        <input type="text" id="tiutlo" placeholder="Titulo de la Propiedad">

        <label for="precio">Precio:</label>
        <input type="number" id="precio" placeholder="Precio de la Propiedad">

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" accept="image/jpeg, image/png">

        <label for="descripcion">descripción:</label>
        <textarea  id="descripcion" ></textarea>


     </fieldset>
    </form>

    </main>

    <?php 
 incluirTemplate('footer');
 ?>