<?php

error_reporting(0);

//Añadimos las clases
require_once "Smarty.class.php";
spl_autoload_register(function($clase) {
    include $clase . '.php';
});

//establecemos conexion
$conexion = new BD();
session_start();

//Creamos un objeto para gestionar plantillas
$smarty = new Smarty();
//Configuramos los directorios
$smarty->template_dir = "./template";
$smarty->compile_dir = "./template_c";

//recogemos la cesta de la variable de sesion
$cesta = $_SESSION['cesta'];
//recogemos los productos de la cesta (array)
$productos = $cesta->getProductos();

//creamos un objeto pdf y llamamos a algunas funciones predefinidas y otras
//de nuestra clase propia para construir el PDF a nuestro gusto
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Ln(15);
$pdf->SetFont('Times', 'B', 12);
$header = array("codigo", "cantidad", "precio");
$pdf->tablaBasica1($header, $productos);
$header2 = array("Cantidad", "Total sin IVA", "IVA", "Total con IVA");
$cantidad = $cesta->contarProductos();
$total = $cesta->getTotal();
$pdf->tablaBasica2($header2, $cantidad, $total);
$pdf->Output();
?>