<?php

//error_reporting(0);
//Añadimos las clases
require_once "Smarty.class.php";
spl_autoload_register(function($clase) {
    include "$clase.php";
});

session_start();

//establecemos conexion
$conexion = new BD();
//Creamos un objeto para gestionar plantillas
$smarty = new Smarty();
//Configuramos los directorios
$smarty->template_dir = "./template";
$smarty->compile_dir = "./template_c";

//si tenemos guardados las variables de sesion usuario y contraseña 
if (isset($_SESSION['correo']) && isset($_SESSION['pass'])) {
//las guardamos en variables
    $correo = $_SESSION['correo'];
    $pass = $_SESSION['pass'];
}

//creamos o recogemos cesta
$cesta = Cesta::generaCesta();
//recojo el contenido de la cesta con los productos que vayamos añadiendo y lo mostramos en la plantilla
$carrito = $cesta->mostrarIcono();
$smarty->assign('carrito', $carrito);

$usuario = Usuario::generaUsuario();
$gestorAdmin = $usuario->mostrarBarraAdmin($conexion, $correo);
$smarty->assign('gestorAdmin', $gestorAdmin);
//se muestra la plantilla del sitio 

if (isset($_POST['botonGestor'])) {
    $gestor = $_POST['botonGestor'];
    header("Location:gestor.php?gestor=$gestor");
}

$smarty->display("gestorAdmin.tpl");
