<?php 
  // base de datos
 
   require '../../includes/config/database.php';

   $conn = conectarDB();


   if ($_SERVER['REQUEST_METHOD'] === 'POST'){
      
      // echo '<pre>';
      // var_dump($_POST);
      // echo '</pre>';

      $titulo = $_POST['titulo'];
      $precio = $_POST['precio'];
      $descripcion = $_POST['descripcion'];
      $habitaciones = $_POST['habitaciones'];
      $wc = $_POST['wc'];
      $estacionamiento = $_POST['estacionamiento'];
      $vendedorId = $_POST['vendedorId'];

       // insertar en la base de datos 

       $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorId)
       VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$vendedorId')";

       //echo $query;

       $resultado = mysqli_query($conn, $query);

       if($resultado){
         echo 'insertado correctamente';
       }else{
         echo 'no funcionó: ' . mysqli_error($conn); // Muestra el mensaje de error específico
    echo 'Código de error: ' . mysqli_errno($conn); // Muestra el código de error
       }
       
    }

   //var_dump($conn);

    require '../../includes/funciones.php';  
    incluirTemplate('header');
 ?>
    <main class="contenedor seccion">
        <h1>crear</h1>

        <a href="/bienesraices/admin" class="boton boton-verde">Volver</a>
    <form action="/bienesraices/admin/propiedades/crear.php" class="formulario" method="POST">
     <fieldset>
        <legend>Información General</legend>

        <label for="titulo">Titulo:</label>
        <input type="text" id="tiutlo" name="titulo" placeholder="Titulo de la Propiedad">

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad">

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" accept="image/jpeg, image/png">

        <label for="descripcion">descripción:</label>
        <textarea  id="descripcion" name="descripcion" ></textarea>

     </fieldset>
     
     <fieldset>
      <legend>Información Propiedades</legend>

      <label for="habitaciones">Habitaciones:</label>
        <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej:5" min="1" max="6">

        <label for="wc">Baños:</label>
        <input type="number" id="wc" name="wc" placeholder="Ej:2" min="1" max="4">

        <label for="estacionamiento">Estacionamiento:</label>
        <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej:3" min="1" max="3">

     </fieldset>

     <fieldset>
      <legend>Vendedor</legend>

      <select name="vendedorId" id="vendedorId">
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