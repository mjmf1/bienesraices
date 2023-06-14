<?php 
  // base de datos
 
   require '../../includes/config/database.php';

   $conn = conectarDB();

         // arreglo con mensajes de errores 

         $errores = [];

         // Ejucta el codigo Despues que el usuario envia en formulario
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
      
     // Validación de campos requeridos
   $camposRequeridos = [
      'titulo' => 'Debes añadir un título',
      'precio' => 'Debes añadir una cantidad de precio válida',
      'descripcion' => 'La descripción debe tener al menos 50 caracteres',
      'habitaciones' => 'Debes añadir una cantidad de habitaciones validas',
      'wc' => 'El numero de baños es obligatorio',
      'estacionamiento' => 'Debes añadir una cantidad de estacionamientos validos',
      'vendedorId' => 'Seleccione un vendedor',

      // Agrega los demás campos requeridos aquí
   ];

   foreach ($camposRequeridos as $campo => $mensaje) {
      if (empty($_POST[$campo])) {
         $errores[] = $mensaje;
      }
      else if ($campo === 'descripcion' && strlen($_POST[$campo]) < 50) {
         $errores[] = $mensaje;
      }
   }


      // revisar que el arreglo de erroes este vacio

      if(empty($errores)){
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
      };

      // echo '<pre>';
      // var_dump($errores);
      // echo '</pre>';
      
      // exit;

    
       
    }

   //var_dump($conn);

    require '../../includes/funciones.php';  
    incluirTemplate('header');
 ?>
    <main class="contenedor seccion">
        <h1>crear</h1>

        <a href="/bienesraices/admin" class="boton boton-verde">Volver</a>

      <?php foreach($errores as $error): ?>
        
         <div class="alerta error">
          <?php echo $error; ?>
         </div>
         <?php endforeach; ?>

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
         <option value="">--Selecione--</option>
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