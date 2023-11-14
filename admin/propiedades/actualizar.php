<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

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

//consultar para obtener a los vendedores

$consulta = "SELECT * FROM vendedores";

$resultado = mysqli_query($conn, $consulta);

// arreglo con mensajes de errores 

$errores = Propiedad::getErrores();

// Ejucta el codigo Despues que el usuario envia en formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   //Asignar los atributos
   $args = $_POST['propiedad'];

   $propiedad->sincronizar($args);
   //Validacion
   $errores = $propiedad->validar();
   //Subida de archivos
   $nombreImagen = md5(uniqid(rand(), true) . '.jpg');
   if ($_FILES['propiedad']['tmp_name']['imagen']) {
      $Image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
      $propiedad->setImagen($nombreImagen);
   }


   if (empty($errores)) {


      exit;
      //my query
      $query = "UPDATE propiedades 
       SET titulo = '${titulo}',precio = '${precio}',imagen = '${nombreImagen}',  descripcion = '${descripcion}',  habitaciones = ${habitaciones}, wc = ${wc},estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id}";

      $resultado = mysqli_query($conn, $query);

      if ($resultado) {
         // redireccionar al usuario
         header('location: /bienesraices/admin/?resultado=2');
      } else {
         echo 'no funcionó: ' . mysqli_error($conn); // Muestra el mensaje de error específico
         echo 'Código de error: ' . mysqli_errno($conn); // Muestra el código de error
      }
   };
}

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

      <?php include '../../includes/templates/formularios_propiedades.php'; ?>

      <input type="submit" class="boton boton-verde" value="Actualizar Propiedad">

   </form>

</main>

<?php
incluirTemplate('footer');
?>