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

//establecemos conexion
$conexion = new BD();

//creamos o recogemos cesta
$cesta = Cesta::generaCesta();
//recojo el contenido de la cesta con los productos que vayamos añadiendo y lo mostramos en la plantilla
$carrito = $cesta->mostrarIcono();
$smarty->assign('carrito', $carrito);
//cuando no se haya pulsado ningún boton
//
//cuando se pulse el boton enviar en el login
if (isset($_POST['enviarMensaje'])) {
    //recogemos los datos
    $correo = $_POST['correo'];
    $nombre = $_POST['name'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];
    $sentencia = "INSERT INTO MENSAJES (contenido, correo, asunto, nombre) VALUES (?,?,?,?)";
    $datos = [$correo, $nombre, $asunto, $mensaje, $sentencia];
    try {
        $conexion->ejecutarPS($datos);
        $conexion->cerrar();
        $error = "El mensaje ha sido enviado con exito. Gracias, le contestaremos lo antes posible.";
    } catch (Exception $ex) {
        $error = "Se ha producido el siguiente error: " . $e->getMessage();
    }
    $smarty->asign('error', $error);
    $smarty->display('login.tpl');
} else {
    $error = "";
    $smarty->assign('error', $error);

    $smarty->assign('error', $error);
    //Mostramos plantilla
    $smarty->display('contacto.tpl');
}
?>