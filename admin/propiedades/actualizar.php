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
    exit;
}

// obtener los datos de la propiedad
$propiedad = Propiedad::find($id);

// consultar para obtener a los vendedores
$conn = conectarDB();
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($conn, $consulta);

// arreglo con mensajes de errores
$errores = Propiedad::getErrores();

// Ejecuta el código después que el usuario envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los atributos
    $args = $_POST['propiedad'];
    $propiedad->sincronizar($args);

    // Validación
    $errores = $propiedad->validar();

    // Subida de archivos
    $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
        $image->save(CARPETA_IMAGENES . $nombreImagen);
    } else {
        $nombreImagen = $propiedad->imagen;
    }

    if (empty($errores)) {
      $propiedad->guardar();

        // Actualizar DB
        $query = "UPDATE propiedades 
                  SET titulo = ?, precio = ?, imagen = ?, descripcion = ?, habitaciones = ?, wc = ?, estacionamiento = ?, vendedorId = ?
                  WHERE id = ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssiiiii', 
                          $propiedad->titulo, 
                          $propiedad->precio, 
                          $nombreImagen, 
                          $propiedad->descripcion, 
                          $propiedad->habitaciones, 
                          $propiedad->wc, 
                          $propiedad->estacionamiento, 
                          $propiedad->vendedorId, 
                          $id);

        $resultado = $stmt->execute();

        if ($resultado) {
            // Redireccionar al usuario
            header('location: /bienesraices/admin/?resultado=2');
            exit;
        } else {
            echo 'No funcionó: ' . $stmt->error; // Muestra el mensaje de error específico
        }
    }
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
