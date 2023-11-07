<?php

require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$conn = conectarDB();

$propiedad = new Propiedad();

//consultar para obtener a los vendedores

$consulta = 'SELECT * FROM vendedores';

$resultado = mysqli_query($conn, $consulta);

// arreglo con mensajes de errores 

$errores = Propiedad::getErrores();


// Ejucta el codigo Despues que el usuario envia en formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Crea una nueva instancia
   $propiedad = new Propiedad($_POST['propiedad']);

   // Generar un Nombre Unico para la imagen
   $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

   // Establecer la ruta completa de la imagen en la carpeta de destino
   $rutaImagen = CARPETA_IMAGENES . $nombreImagen;

   //Setear la imagen
// Realiza un resize a la imagen con Intervention
if(isset($_FILES['propiedad']['tmp_name']['imagen'])){
   $nombreImagen = md5(uniqid(rand(), true) . '.jpg');
   $rutaImagen = CARPETA_IMAGENES . $nombreImagen;

   $Image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
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

      <?php include '../../includes/templates/formularios_propiedades.php'; ?>

      <input type="submit" class="boton boton-verde" value="Crear Propiedad">

   </form>

</main>

<?php
incluirTemplate('footer');
?>