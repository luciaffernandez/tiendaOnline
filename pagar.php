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
$conexion = new BD();

//si tenemos guardados las variables de sesion usuario y contraseña 
if (isset($_SESSION['correo']) && isset($_SESSION['pass'])) {
//las guardamos en variables
    $correo = $_SESSION['correo'];
    $pass = $_SESSION['pass'];
}

//recogemos la variable de sesion cesta
$cesta = $_SESSION['cesta'];
//recojo el contenido de la cesta con los productos que vayamos añadiendo y lo mostramos en la plantilla
$carrito = $cesta->mostrarIcono();
$smarty->assign('carrito', $carrito);

//DATOS USUARIO/////////////////////////////////////////////
$usuario = Usuario::generaUsuario();

$nombre = $usuario->getNombreCompleto($conexion, $correo);
$DNI = $usuario->getDNI($conexion, $correo);
//mostramos en la plantilla la variable usuario o nombre

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

$datosUsuario = "<label>Nombre y apellidos: </label> $nombre</br> <label>Correo electrónico: </label> $correo </br><label>DNI: </label> $DNI</br><label>Dirección: </label> $direccionUsuario";
$smarty->assign('datosUsuario', $datosUsuario);
//DATOS USUARIO//////////////////////////////////////////////
//creamos la variable fecha actual con el siguiente formato para mostrarla en la plantilla
$fecha = date("d-m-y");
$smarty->assign('fecha', $fecha);

$productos = $cesta->getProductos();
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


if (isset($_POST['botonDatos']) && ($_POST['botonDatos'] === 'Guardar datos')) {
    $textoBoton = "Editar datos";
    $smarty->assign('textoBoton', $textoBoton);

    $formularioEditorUsuario = "";
    $smarty->assign('formularioEditorUsuario', $formularioEditorUsuario);

    $nombreNew = $_POST['nombre'];
    $apellidosNew = $_POST['apellidos'];
    $correoNew = $_POST['correo'];
    $DNINew = $_POST['dni'];
    $fechaNacNew = $_POST['fecha'];
    $calleNew = $_POST['calle'];
    $numeroNew = $_POST['numero'];
    $pisoNew = $_POST['piso'];
    $codPostalNew = $_POST['cod_postal'];
    $provinciaNew = $_POST['provincia'];
    $ciudadNew = $_POST['ciudad'];
    $datosUser = [$nombreNew, $apellidosNew, $correoNew, $DNINew, $fechaNacNew];
    $datosDir = [$calleNew, $numeroNew, $pisoNew, $codPostalNew, $provinciaNew, $ciudadNew];
    $sentenciaUpdate = "UPDATE USUARIOS SET correo = :correo', nombre = :nombre, apellidos = :apellidos, dni = :dni WHERE correo = '" . $correo . "'";
    
    $conexion->ejecutarPS($datosUser, $sentenciaUpdate);
   
    $smarty->assign('mensaje', $mensaje);
} else if (isset($_POST['botonDatos'])) {
    $textoBoton = "Guardar datos";
    $sentencia = "SELECT * FROM USUARIOS WHER correo ='".$correo."'";
    $valores = $conexion->seleccion($sentencia);
    foreach($valores as $valor){
        $nombre = $valor['nombre'];
        $apellidos = $valor['apellidos'];
        $correo = $valor['correo'];
        $dni = $valor['dni'];
    }
    $formularioEditorUsuario = "<div class='col-lg-6 float-left'>"
            . "<label>Nombre: </label> <input class='inputData' type='text' name='nombre' value=''> </br>"
            . "<label>Apellidos: </label> <input class='inputData' type='text' name='apellidos' value=''></br>"
            . "<label>Correo: </label> <input class='inputData' type='text' name='correo' value='' > </br>"
            . "<label>DNI: </label> <input class='inputData' type='text' name='dni' value=''> </br>"
            . "<label>Fecha de nacimiento: </label> <input class='inputData' type='date' name='fechaNac' value=''/><br/></br>"
            . "</div>"
            . "<div class='col-lg-6 float-left'>"
            . "<label>Calle: </label> <input class='inputData' type='text' name='calle' value=''> </br>"
            . "<label>Número: </label> <input class='inputData' type='text' name='num' value=''> </br>"
            . "<label>Piso: </label> <input class='inputData' type='text' name='piso' value=''></br>"
            . "<label>Código postal: </label> <input class='inputData' type='text' name='cod_postal' value=''></br>"
            . "<label>Provincia: </label> <input class='inputData' type='text' name='provincia' value=''></br>"
            . "<label>Ciudad: </label> <input class='inputData' type='text' name='ciudad' value=''></br>"
            . "</div>";
    $smarty->assign('textoBoton', $textoBoton);
    $smarty->assign('formularioEditorUsuario', $formularioEditorUsuario);
} else if (!isset($_POST['botonDatos'])) {
    $textoBoton = "Editar datos";
    $smarty->assign('textoBoton', $textoBoton);
}

//mostramos plantilla
$smarty->display("pagar.tpl");
?>

