<?php 
// Importar conexion
require 'includes/config/database.php';
$conn = conectarDB();

// Autenticar el Usuario

$errores = []; 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
//    echo " <pre>";
//     var_dump($_POST);
//     echo "</pre>";

    $email = mysqli_real_escape_string($conn, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    // var_dump($email);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!$email){
        $errores [] = "El Email es obligatrio o no es valido";
    }

    if(!$password){
        $errores [] = "EL Password  es obligatorio";
    }

    // echo " <pre>";
    // var_dump($errores);
    // echo "</pre>";

    if(empty($errores)){
        //Revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '${email}' ";
        $resultado = mysqli_query($conn,$query);

       

        if($resultado -> num_rows){
            //Revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);
            
            //Verificar si el password es correcto o no
            $auth = password_verify($password, $usuario['password']);
            var_dump($auth);
            if($auth){
                //El usuario esta autenticado
                header('location: /bienesraices/admin');
            }else{
                $errores[] = "El password es incorrecto";
            }

            
        }else{
            $errores [] = "El usuario no existe";
        }

    };
}



// Incluye el Header
    require 'includes/funciones.php';  
    incluirTemplate('header');
 ?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>

            <div class="alerta error">
                <?php echo $error;?>
            </div>

            <?php endforeach?>

        <form method="POST" action="" class="formulario">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-MAIL</label>
                <input type="email" name="email" placeholder="Tu E-MAIL" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required>

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class=" boton boton-verde">

    </main>

    <?php 
 incluirTemplate('footer');
 ?>