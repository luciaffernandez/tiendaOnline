<?php
/* Smarty version 3.1.33, created on 2019-05-14 13:33:03
  from 'C:\xampp\htdocs\tiendaOnline\head_header.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cdaa76fa14059_39291655',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a44afdeedf32425e73263ed5bd2e7716912d0c8e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\head_header.php',
      1 => 1557833386,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cdaa76fa14059_39291655 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?php

';?>//error_reporting(0);
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
if (isset($_SESSION['correo']) && isset($_SESSION['pass'])) {
    $hidden = "style='display:none;'";
    $smarty->asign("hidden", $hidden);
} else {
    $hidden = "";
    $smarty->asign("hidden", $hidden);
}
$smarty->display('head_header.tpl');
<?php }
}
