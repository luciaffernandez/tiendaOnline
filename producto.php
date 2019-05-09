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

//si tenemos guardados las variables de sesion usuario y contraseña
if (isset($_SESSION['user']) && isset($_SESSION['pass'])) {
    $nombre = $_SESSION['user'];
    $pass = $_SESSION['pass'];
} else {
    //sino, esque no nos hemos legueado y nos devuelve al login con un error
    header("Location:login.php?error");
}

//seleccionamos todos los ordenadores
$ordenadores = $conexion->seleccion("SELECT * FROM ordenador");
//recorremos el array que ha devuelto y vamos recogiendo los datos que queremos
foreach ($ordenadores as $datos) {
    $codigo = $datos['cod'];
    $procesador = $datos['procesador'];
    $RAM = $datos['RAM'];
    $disco = $datos['disco'];
    $grafica = $datos['gráfica'];
    $SO = $datos['unidadoptica'];
    $optica = $datos['unidadoptica'];
    $otros = $datos['otros'];
}
//hacemos un select con todos los productos
$productos = $conexion->seleccion("SELECT * FROM producto");
//recorremos el array devuelto y sacamos lo valores que nos interesen
foreach ($productos as $valores) {
    $descripcion = $valores['descripcion'];
    $PVP = $valores['PVP'];
    $nombre = $valores['nombre_corto'];
}
//asignamos todos esas variables a la plantilla 
$smarty->assign('codigo', $codigo);
$smarty->assign('otros', $otros);
$smarty->assign('procesador', $procesador);
$smarty->assign('RAM', $RAM);
$smarty->assign('disco', $disco);
$smarty->assign('grafica', $grafica);
$smarty->assign('SO', $SO);
$smarty->assign('optica', $optica);
$smarty->assign('descripcion', $descripcion);
$smarty->assign('PVP', $PVP);
$smarty->assign('nombre', $nombre);

//mostramos la plantilla
$smarty->display("ordenador.tpl");
?>
