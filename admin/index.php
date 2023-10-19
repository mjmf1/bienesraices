<?php

require '../includes/app.php';

estaAutenticado();

use App\Propiedad;

$conn = conectarDB();

//Implementar un metodo para traer todas las propiedades

$propiedades = Propiedad::all();

// Muestra mensaje condicional
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {

        // Elimnar el archivo
        $query = "SELECT imagen FROM propiedades WHERE id = ${id}";
        $resultado = mysqli_query($conn, $query);
        $propiedad = mysqli_fetch_assoc($resultado);


        unlink('../imagenes/' . $propiedad['imagen']);


        // Eliminar la propiedad
        $query = "DELETE FROM propiedades WHERE id = ${id}";
        // echo $query;
        $resultado = mysqli_query($conn, $query);
        if ($resultado) {
            header('location: /bienesraices/admin?resultado=3');
        }
    }
}

// incluye un template

incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php if ($resultado == 1) : ?>

        <p class="alerta exito">Anuncio Creado Correctamente</p>

    <?php elseif ($resultado == 2) : ?>

        <p class="alerta exito">Anuncio Actualizado Correctamente</p>

    <?php elseif ($resultado == 3) : ?>

        <p class="alerta exito">Anuncio Eliminado Correctamente</p>

    <?php endif; ?>



    <a href="/bienesraices/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propieda</a>

    <table class="propiedades">
        <thead>

            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>

        </thead>
        <tbody> <!--Mostrar los resultados -->
            <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img src="/bienesraices/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla" alt="imagenes"></td>
                    <td>$<?php echo $propiedad['precio']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $propiedad['id']; ?>">

                            <input type="submit" class="boton-rojo-block " value="Eliminar">

                        </form>

                        <a href="/bienesraices/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?> " class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
    </table>

</main>

<?php

//   Cerrar la conexion
mysqli_close($conn);

incluirTemplate('footer');
?>