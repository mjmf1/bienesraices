<?php 
  // base de datos
 
   require '../../includes/config/database.php';

   $conn = conectarDB();

   var_dump($conn);

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
     
     <fieldset>
      <legend>Información Propiedades</legend>

      <label for="habitaciones">Habitaciones:</label>
        <input type="number" id="habitaciones" placeholder="Ej:5" min="1" max="6">

        <label for="wc">Baños:</label>
        <input type="number" id="wc" placeholder="Ej:2" min="1" max="4">

        <label for="estacionamiento">Estacionamiento:</label>
        <input type="number" id="estacionamiento" placeholder="Ej:3" min="1" max="3">

     </fieldset>

     <fieldset>
      <legend>Vendedor</legend>

      <select name="" id="">
         <option value="1">Marlon</option>
         <option value="2">Juan</option>
         <option value="3">Karen</option>
      </select>

     </fieldset>

     <input type="submit" class="boton boton-verde" value="Crear Propiedad">

    </form>

    </main>

    <?php 
 incluirTemplate('footer');
 ?>