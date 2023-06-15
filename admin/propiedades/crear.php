<?php 
  // base de datos
 
   require '../../includes/config/database.php';

   $conn = conectarDB();

         //consultar para obtener a los vendedores

         $consulta = 'SELECT * FROM vendedores';

         $resultado = mysqli_query($conn, $consulta);

         // arreglo con mensajes de errores 

         $errores = [];

         $titulo = '';
      $precio = '';
      $descripcion = '';
      $habitaciones = '';
      $wc = '';
      $estacionamiento = '';
      $vendedorId = '';

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
      $fecha = date('y/m/d');
      
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

   $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, fecha, vendedorId)
   VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$fecha', '$vendedorId')";

   //echo $query;

   $resultado = mysqli_query($conn, $query);

   if($resultado){
     // redireccionar al usuario
      header('location: /bienesraices/admin');

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
        <input type="text" id="tiutlo" name="titulo" placeholder="Titulo de la Propiedad" value="<?php echo $titulo;?>">

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad" value="<?php echo $precio;?>">

        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" accept="image/jpeg, image/png">

        <label for="descripcion">descripción:</label>
        <textarea  id="descripcion" name="descripcion"><?php echo $descripcion;?></textarea>

     </fieldset>
     
     <fieldset>
      <legend>Información Propiedades</legend>

      <label for="habitaciones">Habitaciones:</label>
        <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej:5" min="1" max="6" value="<?php echo $habitaciones;?>">

        <label for="wc">Baños:</label>
        <input type="number" id="wc" name="wc" placeholder="Ej:2" min="1" max="4" value="<?php echo $wc;?>">

        <label for="estacionamiento">Estacionamiento:</label>
        <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej:3" min="1" max="3" value="<?php echo $estacionamiento;?>">

     </fieldset>

     <fieldset>
      <legend>Vendedor</legend>

      <select name="vendedorId" id="vendedorId" value="<?php echo $vendedorId;?>">
         <option value="">--Selecione--</option>
         <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
            <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?>  value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido'];?></option>
            <?php endwhile; ?>
      </select>

     </fieldset>

     <input type="submit" class="boton boton-verde" value="Crear Propiedad">

    </form>

    </main>

    <?php 
 incluirTemplate('footer');
 ?>