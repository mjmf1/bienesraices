<?php

use App\Propiedad;

require '../../includes/app.php';

estaAutenticado();


// validar por URL que la Id sea valido
$id = $_GET['id'];

$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
   header('location: /bienesraices/admin');
}

// obtener los datos de la propiedad

$propiedad = Propiedad::find($id);
// debuguear($propiedad);


//consultar para obtener a los vendedores

$consulta = "SELECT * FROM vendedores";

$resultado = mysqli_query($conn, $consulta);

// arreglo con mensajes de errores 

$errores = [];

$titulo = $propiedad->titulo;

// Ejucta el codigo Despues que el usuario envia en formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {



   $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
   $precio = mysqli_real_escape_string($conn, $_POST['precio']);
   $descripcion  = mysqli_real_escape_string($conn, $_POST['descripcion']);
   $habitaciones = mysqli_real_escape_string($conn,  $_POST['habitaciones']);
   $wc = mysqli_real_escape_string($conn, $_POST['wc']);
   $estacionamiento = mysqli_real_escape_string($conn, $_POST['estacionamiento']);
   $vendedorId = mysqli_real_escape_string($conn, $_POST['vendedorId']);
   $fecha = mysqli_real_escape_string($conn, date('y/m/d'));

   //asignar files hacia una variable

   $imagen = $_FILES['imagen'];

   //validar por tamaño (1mb maximo)

   $media = 1000 * 1000;

   // Validación de campos requeridos
   $camposRequeridos = [
      'titulo' => 'Debes añadir un título',
      'precio' => 'Debes añadir una cantidad de precio válida',
      'descripcion' => 'La descripción debe tener al menos 50 caracteres',
      'habitaciones' => 'Debes añadir una cantidad de habitaciones validas',
      'wc' => 'El numero de baños es obligatorio',
      'estacionamiento' => 'Debes añadir una cantidad de estacionamientos validos',
      'vendedorId' => 'Seleccione un vendedor',

   ];

   foreach ($camposRequeridos as $campo => $mensaje) {
      if (empty($_POST[$campo])) {
         $errores[] = $mensaje;
      } else if ($campo === 'descripcion' && strlen($_POST[$campo]) < 50) {
         $errores[] = $mensaje;
      }
   }

   // Validar solo el tamaño de la imagen
   if ($_FILES['imagen']['size'] > $media) {
      $errores[] = 'La imagen es muy pesada';
   }

   // revisar que el arreglo ó (array) de erroes este vacio

   if (empty($errores)) {
      // Definir la ruta de la carpeta de destino
      $carpetaImagenes = '/bienesraices/imagenes/';

      // Verificar si la carpeta ya existe o crearla
      if (!is_dir($carpetaImagenes)) {
         mkdir($carpetaImagenes);
      }

      if ($imagen['name']) {

         //eliminar imagen previa
         $respuesta = unlink($_SERVER['DOCUMENT_ROOT'] . $carpetaImagenes . $propiedad['imagen']);

         // Generar un Nombre Unico para la imagen
         $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

         // Establecer la ruta completa de la imagen en la carpeta de destino
         $rutaImagen = $carpetaImagenes . $nombreImagen;

         // Mover la imagen a la carpeta de destino
         move_uploaded_file($_FILES['imagen']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $rutaImagen);
      } else {
         $nombreImagen = $propiedad['imagen'];
      }
      //my query
      $query = "UPDATE propiedades 
       SET titulo = '${titulo}',precio = '${precio}',imagen = '${nombreImagen}',  descripcion = '${descripcion}',  habitaciones = ${habitaciones}, wc = ${wc},estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id}";

      //  echo $query;

      //  exit;

      $resultado = mysqli_query($conn, $query);

      if ($resultado) {
         // redireccionar al usuario
         header('location: /bienesraices/admin/?resultado=2');
      } else {
         echo 'no funcionó: ' . mysqli_error($conn); // Muestra el mensaje de error específico
         echo 'Código de error: ' . mysqli_errno($conn); // Muestra el código de error
      }
   };

   // echo '<pre>';
   // var_dump($errores);
   // echo '</pre>';


}

//var_dump($conn);


incluirTemplate('header');
?>
<main class="contenedor seccion">
   <h1>Actualizar Propiedades</h1>

   <a href="/bienesraices/admin" class="boton boton-verde">Volver</a>

   <?php foreach ($errores as $error) : ?>

      <div class="alerta error">
         <?php echo $error; ?>
      </div>
   <?php endforeach; ?>

   <form class="formulario" method="POST" enctype="multipart/form-data">
      <!-- enctype="multipart/form-data" necesario para leer los datelles de los file -->

      <?php include '../../includes/templates/formularios_propiedades.php'; ?>

      <input type="submit" class="boton boton-verde" value="Actualizar Propiedad">

   </form>

</main>

<?php
incluirTemplate('footer');
?>