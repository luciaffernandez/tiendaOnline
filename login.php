<?php

//error_reporting(0);
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

//cuando se pulse el boton enviar en el login
if (isset($_POST['iniciarSesion'])) {
    //recogemos los datos
    $correo = $_POST['correo'];
    $pass = $_POST['pass'];
    //establecemos conexion
    $conexion = new BD();
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
    //establecemos conexion
    $conexion = new BD();
    //recogemos los datos
    $name = $_POST['name'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $fechaNac = $_POST['fechaNac'];
    $pass = $_POST['pass'];
    $DNI = "LALALALA";
    $cod = 4;
    $admin = 0;
    $sentencia = "INSERT INTO USUARIOS (id_user, password, correo, dni, fecha_nac, admin, nombre, apellidos) VALUES ($cod, $pass, $correo, $DNI, $fechaNac, $admin, $nombre, $apellidos)";
    try{
       $conexion->ejecutar($sentencia); 
    } catch (Exception $ex) {
        $error= "Se ha producido el siguiente error: ".$e->getMessage();
    }
    
    $_SESSION['correo'] = $correo;
    $_SESSION['pass'] = $pass;
    $conexion->cerrar();
    header("Location:tienda.php?usuarioCreado=$usuarioCreado&error=$error");
} else {
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
    $smarty->display('login.tpl');
}
?>