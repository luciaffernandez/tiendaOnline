<?php

error_reporting(0);
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

//creamos o recogemos cesta
$cesta = Cesta::generaCesta();
//recojo el contenido de la cesta con los productos que vayamos añadiendo y lo mostramos en la plantilla
$carrito = $cesta->mostrarIcono();
$smarty->assign('carrito', $carrito);


$correo = $_SESSION['correo'];
$usuario = Usuario::generaUsuario();
$gestorAdmin = $usuario->mostrarBarraAdmin($conexion, $correo);
$smarty->assign('gestorAdmin', $gestorAdmin);
//cuando se pulse el boton enviar en el login
if (isset($_POST['enviarMensaje'])) {
    //recogemos los datos
    $correo = $_POST['correo'];
    $nombre = $_POST['name'];
    $asunto = $_POST['asunto'];
    $mensaje = $_POST['mensaje'];
    $usuario = Usuario::generaUsuario();
    $id = $usuario->getID($conexion, $correo);
    $fecha = date('Y-m-d');
    $datos = array(':fecha_creacion' => $fecha, ':id_user' => $id);
    $sentencia = "INSERT INTO REGISTROS (fecha_creacion, id_user) VALUES (:fecha_creacion, :id_user)";
    $conexion->ejecutarPS($datos, $sentencia);

    $id_registro = $conexion->conexion->lastInsertId();
    $datos = array(':id_mensaje' => $id_registro, ':contenido' => $mensaje, ':correo' => $correo, ':asunto' => $asunto, ':nombre' => $nombre);
    $sentencia = "INSERT INTO MENSAJES (id_mensaje, contenido, correo, asunto, nombre) VALUES (:id_mensaje, :contenido, :correo, :asunto, :nombre)";

    $conexion->ejecutarPS($datos, $sentencia);
    $error = $conexion->getInfo();
    $smarty->assign('error', $error);

    $smarty->display('contacto.tpl');
} else {
    //cuando no se haya pulsado ningún botón (estado inicial)
    $error = "";
    $smarty->assign('error', $error);

    //Mostramos plantilla
    $smarty->display('contacto.tpl');
}
