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


if (isset($_POST['areaClientes'])) {
    if (isset($_SESSION['correo']) && isset($_SESSION['pass'])) {
        header("Location:tienda.php");
    } else {
//sino, esque no nos hemos legueado y nos devuelve al login con un error
        header("Location:login.php?error");
    }
    
}
 $smarty->display('head_header.tpl');