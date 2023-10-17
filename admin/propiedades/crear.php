<?php

require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$conn = conectarDB();

//consultar para obtener a los vendedores

$consulta = 'SELECT * FROM vendedores';

$resultado = mysqli_query($conn, $consulta);

// arreglo con mensajes de errores 

$errores = Propiedad::getErrores();

// debuguear($errores);

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

// Ejucta el codigo Despues que el usuario envia en formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Crea una nueva instancia
   $propiedad = new Propiedad($_POST);

   // Generar un Nombre Unico para la imagen
   $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

   // Establecer la ruta completa de la imagen en la carpeta de destino
   $rutaImagen = CARPETA_IMAGENES . $nombreImagen;

   //Setear la imagen
   // Realzia un resize  a la imagen con intervation
   if($_FILES['imagen']['tmp_name']){
      $Image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
      $propiedad->setImagen($nombreImagen);

   }
   
   //Validar
   $errores = $propiedad->validar();

   if (empty($errores)) {

      

      if(!is_dir(CARPETA_IMAGENES)){
         mkdir(CARPETA_IMAGENES);
      }
     
      //Guarda la imagen en el servidor
      $Image->save(CARPETA_IMAGENES . $nombreImagen);
      //Guarda en la base de datos
     $resultado = $propiedad->guardar();
      //Mensaje de exito o Error
      if ($resultado) {
         // redireccionar al usuario
         header('location: /bienesraices/admin/?resultado=1');
      }else {
         echo 'no funcionó: ' . mysqli_error($conn); // Muestra el mensaje de error específico
         echo 'Código de error: ' . mysqli_errno($conn); // Muestra el código de error
      }
   }
}

incluirTemplate('header');
?>
<main class="contenedor seccion">
   <h1>crear</h1>

   <a href="/bienesraices/admin" class="boton boton-verde">Volver</a>

   <?php foreach ($errores as $error) : ?>

      <div class="alerta error">
         <?php echo $error; ?>
      </div>
   <?php endforeach; ?>

   <form action="/bienesraices/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
      <!-- enctype="multipart/form-data" necesario para leer los datelles de los file -->

      <fieldset>
         <legend>Información General</legend>

         <label for="titulo">Titulo:</label>
         <input type="text" id="tiutlo" name="titulo" placeholder="Titulo de la Propiedad" value="<?php echo $titulo; ?>">

         <label for="precio">Precio:</label>
         <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad" value="<?php echo $precio; ?>">

         <label for="imagen">Imagen:</label>
         <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

         <label for="descripcion">descripción:</label>
         <textarea id="descripcion" name="descripcion"><?php echo $descripcion; ?></textarea>

      </fieldset>

      <fieldset>
         <legend>Información Propiedades</legend>

         <label for="habitaciones">Habitaciones:</label>
         <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej:5" min="1" max="6" value="<?php echo $habitaciones; ?>">

         <label for="wc">Baños:</label>
         <input type="number" id="wc" name="wc" placeholder="Ej:2" min="1" max="4" value="<?php echo $wc; ?>">

         <label for="estacionamiento">Estacionamiento:</label>
         <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej:3" min="1" max="3" value="<?php echo $estacionamiento; ?>">

      </fieldset>

      <fieldset>
         <legend>Vendedor</legend>

         <select name="vendedorId" id="vendedorId" value="<?php echo $vendedorId; ?>">
            <option value="">--Selecione--</option>
            <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
               <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
            <?php endwhile; ?>
         </select>

      </fieldset>

      <input type="submit" class="boton boton-verde" value="Crear Propiedad">

   </form>

</main>

<?php
incluirTemplate('footer');
?>