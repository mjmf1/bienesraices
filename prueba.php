<!DOCTYPE html>
<html>
<head>
  <title>Formulario de carga de imagen</title>
</head>
<body>
  <h2>Formulario de carga de imagen</h2>
  <form method="POST" action="" enctype="multipart/form-data">
    <input type="file" name="imagen" />
    <input type="submit" name="submit" value="Cargar imagen" />
  </form>

  <?php
  // Verificar si se ha enviado el formulario
  if(isset($_POST["submit"])) {
    // Carpeta de destino para guardar la imagen
    $carpeta_destino = "imagenes/";

    // Obtener información sobre el archivo
    $nombre_archivo = $_FILES["imagen"]["name"];
    $tipo_archivo = $_FILES["imagen"]["type"];
    $tamano_archivo = $_FILES["imagen"]["size"];
    $temp_archivo = $_FILES["imagen"]["tmp_name"];
    $error_archivo = $_FILES["imagen"]["error"];

    // Mover la imagen a la carpeta de destino si no hay errores
    if ($error_archivo === UPLOAD_ERR_OK) {
      move_uploaded_file($temp_archivo, $carpeta_destino . $nombre_archivo);
      echo "La imagen se ha cargado correctamente.";
    } else {
      echo "Error al cargar la imagen. Código de error: " . $error_archivo;
    }
  }
  ?>
</body>
</html>