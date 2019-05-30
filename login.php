<?php

error_reporting(0);
//Añadimos las clases
require_once "Smarty.class.php";
spl_autoload_register(function($clase) {
    include "$clase.php";
});

session_start();
//Creamos un objeto para gestionar plantillas
$smarty = new Smarty();

//Configuramos los directorios
$smarty->template_dir = "./template";
$smarty->compile_dir = "./template_c";

//establecemos conexion
$conexion = new BD();

//cuando se pulse el boton enviar en el login
if (isset($_POST['iniciarSesion'])) {
    //recogemos los datos
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];

    //comprobamos los datos
    if ($conexion->comprueboUsuario($correo, $pass)) {
        //si es true los guardamos en sesiones y pasamos al sitio.php
        $_SESSION['correo'] = $correo;
        $_SESSION['pass'] = $pass;
        $conexion->cerrar();
        header("Location:tienda.php");
        exit();
    } else {
        //si es false mostramos el mensaje de error y mostramos el login.tpl
        $error = "Datos incorrectos";
        $smarty->assign('error', $error);
        $smarty->display('login.tpl');
    }
} else if (isset($_POST['crearUsuario'])) {
    //recogemos los datos
    $name = $_POST['name'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $fechaNac = $_POST['fechaNac'];
    $pass = $_POST['pass'];
    $DNI = $_POST['dni'];
    $admin = 0;
    $datos = array(':pass' => $pass, ':correo' => $correo, ':dni' => $DNI, ':fechaNac' => $fechaNac, ':admin' => $admin, ':name' => $name, ':apellidos' => $apellidos);
    if ($conexion->comprueboUsuario($correo, $pass)) {
        $error = "Ya existe una cuenta asociada a ese correo";
        $smarty->assign('error', $error);
        $smarty->display('login.tpl');
    } else {
        $sentencia = "INSERT INTO USUARIOS ( password, correo, dni, fecha_nac, admin, nombre, apellidos) VALUES ( :pass , :correo , :dni , :fechaNac, :admin, :name, :apellidos)";
        $conexion->ejecutarPS($datos, $sentencia);
        $error = $conexion->getInfo();
        $smarty->assign('error', $error);
        $_SESSION['correo'] = $correo;
        $_SESSION['pass'] = $pass;
        $conexion->cerrar();
        header("Location:tienda.php?usuarioCreado=$usuarioCreado&error=$error");
    }
} else {
    //creamos o recogemos cesta
    $cesta = Cesta::generaCesta();
//recojo el contenido de la cesta con los productos que vayamos añadiendo y lo mostramos en la plantilla
    $carrito = $cesta->mostrarIcono();
    $smarty->assign('carrito', $carrito);
    //cuando no se haya pulsado ningún boton
    $error = "";
    $smarty->assign('error', $error);
    //si se recibe un error por metodo GET (enviado desde el sitio)
    if (isset($_GET['error'])) {
        $error = "Debes iniciar sesión con una cuenta.";
    }

    //si se pulsa el boton desconectar del sitio se muestra el mensaje y destruimos la sesion
    if (isset($_POST['desconectar'])) {
        session_destroy();
        $error = "Te has desconectado";
    } else if (isset($_POST['eliminarCuenta'])) {
        $usuario = Usuario::generaUsuario();
        $correo = $_SESSION['correo'];
        $idUser = (integer) $usuario->getID($conexion, $correo);
        $sentenciaUpdate = "UPDATE USUARIOS SET pass = NULL, correo = NULL, nombre = NULL, apellidos = NULL, dni = NULL, fecha_nac = NULL WHERE correo = '" . $correo . "'";
        $conexion->ejecutar($sentenciaUpdate);
        $sentenciaDelete = "DELETE FROM DIRECCIONES WHERE id_dir = (SELECT id_dir FROM VIVE_EN WHERE id_user ='" . $idUser . "');";
        $conexion->ejecutar($sentenciaDelete);
        $sentenciaDelete = "DELETE FROM VIVE_EN WHERE id_dir = '" . $idUser . "';";
        $conexion->ejecutar($sentenciaDelete);
        session_destroy();
        $error = "Has eliminado tu cuenta de usuario";
    }
    $smarty->assign('error', $error);
    //Mostramos plantilla
    $smarty->display('login.tpl');
}
?>