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
    if ($conexion->comprueboUsuario($correo, $pass)) {
        $error = "Ya existe una cuenta asociada a ese correo";
        $smarty->assign('error', $error);
        $smarty->display('login.tpl');
    } else {
        $sentencia = "INSERT INTO USUARIOS ( password, correo, dni, fecha_nac, admin, nombre, apellidos) VALUES ( '$pass', '$correo', '$DNI', '$fechaNac', '$admin', '$name', '$apellidos')";
        try {
            $conexion->ejecutar($sentencia);
            $_SESSION['correo'] = $correo;
            $_SESSION['pass'] = $pass;
            $conexion->cerrar();
            header("Location:tienda.php?usuarioCreado=$usuarioCreado&error=$error");
        } catch (Exception $ex) {
            $error = "Se ha producido el siguiente error: " . $e->getMessage();
        }
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
        $error = "No has iniciado sesión";
    }
    //si se pulsa el boton desconectar del sitio se muestra el mensaje y destruimos la sesion
    if (isset($_POST['desconectar'])) {
        session_destroy();
        $error = "Te has desconectado";
    }
    $smarty->assign('error', $error);
    //Mostramos plantilla
    $smarty->display('contacto.tpl');
}
?>