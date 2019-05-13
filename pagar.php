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

//si tenemos guardados las variables de sesion usuario y contraseña 
if (isset($_SESSION['correo']) && isset($_SESSION['pass'])) {
//las guardamos en variables
    $correo = $_SESSION['correo'];
    $pass = $_SESSION['pass'];
} else {
//las guardamos en variables
    header("Location:login.php?error");
}

//recogemos la variable de sesion cesta
$cesta = $_SESSION['cesta'];
//recogemos el array productos de la cesta
$productos = $cesta->getProductos();


//establecemos conexion
$conexion = new BD();
//creamos o recogemos cesta

$usuario = Usuario::generaUsuario();

$nombre = $usuario->getNombreCompleto($conexion, $correo);
$DNI = $usuario->getDNI($conexion, $correo);
//mostramos en la plantilla la variable usuario o nombre
$smarty->assign('usuario', $nombre);
$smarty->assign('correo', $correo);

$direccionCompleta = $usuario->getDireccion($conexion, $correo);

if ($direccionCompleta === false) {
    $direccionUsuario = "<p>No hay ninguna dirección guardada para este usuario<p> <input type='submit' value='Editar datos' action='pagar.php'/>";
} else {
    foreach ($direccionCompleta as $dato) {
        $calle = $dato[2];
        $provincia = $dato[0];
        $ciudad = $dato[1];
        $numero = $dato[3];
        $piso = $dato[4];
        $cod_postal = $dato[5];
        $direccionUsuario = "$calle $numero, $piso, $ciudad, $provincia, $cod_postal";
    }
}
$datosUsuario = "$DNI </br> $direccionUsuario";



$smarty->assign('datosUsuario', $datosUsuario);
//creamos la variable fecha actual con el siguiente formato para mostrarla en la plantilla
$fecha = date("d-m-y");
$smarty->assign('fecha', $fecha);
//recorremos el array productos de cesta para ir construyendo las filas de 
//la tabla de la plantilla y los hiddens necesarios para paypal
$contador = 1;
foreach ($productos as $producto => $valores) {
    $resumenPago .= "<tr class = 'pago'>"
            . "<td class = 'pago'>" . $valores[0] . "</td>"
            . "<td class = 'pago'><img src='./img/" . $valores[3] . "' class='imagenCesta'/></td>"
            . "<td class = 'pago'>$valores[2]</td>"
            . "<td class = 'pago'>$producto</td>"
            . "<td class = 'pago'>$valores[1]</td>"
            . "</tr>"
            . "<input name='item_name_$contador' type = 'hidden' value = '$valores[2]]' />"
            . "<input name='item_number_$contador' type = 'hidden' value = '$producto' />"
            . "<input name='amount_$contador' type='hidden' value='$valores[1]' />"
            . "<input name='quantity_$contador' type='hidden' value='$valores[0]' />";
    $contador++;
}

//guardamos y mostramos datos de la segunda tabla de la plantilla
$cantidadProductos = $cesta->contarProductos();
$smarty->assign('cantidadProductos', $cantidadProductos);
$total = $cesta->getTotal();
$smarty->assign('total', $total);
$IVA = $cesta->calculoIVA();
$smarty->assign('IVA', $IVA);
$totalIVA = $total + $IVA;
$smarty->assign('totalIVA', $totalIVA);

//añadimos a los hiddens anteriores los hiddens del IVA
$resumenPago .= "<input name='item_name_$contador' type = 'hidden' value ='IVA' />"
        . "<input name='item_number_$contador' type = 'hidden' value = 'IVA' />"
        . "<input name='amount_$contador' type='hidden' value='$IVA' />"
        . "<input name='quantity_$contador' type='hidden' value='1' />";

//se muestra en la plantilla el contenido de la primera tabla guardado en la variable resumenPago
$smarty->assign('resumenPago', $resumenPago);


//mostramos plantilla
$smarty->display("pagar.tpl");
?>

