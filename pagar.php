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
    if (!$conexion->comprueboUsuario($correo, $pass)) {
        header("Location:login.php&error");
    }
} else {
    header("Location:login.php&error");
}

//recogemos la variable de sesion cesta
$cesta = $_SESSION['cesta'];
//recojo el contenido de la cesta con los productos que vayamos añadiendo y lo mostramos en la plantilla
$carrito = $cesta->mostrarIcono();
$smarty->assign('carrito', $carrito);

mostrarTablasResumen();

$usuario = Usuario::generaUsuario();

//comprobamos si no hemos pulsado el boton de los datos o si sí que lo hemos pulsado y queremos saber en que estado estaba
if (isset($_POST['botonDatos']) && ($_POST['botonDatos'] === 'Guardar datos')) {
    $correo = $_SESSION['correo'];
    mostrarDatosUser($correo);

    $textoBoton = "Editar datos";
    $smarty->assign('textoBoton', $textoBoton);

    $formularioEditorUsuario = "";
    $smarty->assign('formularioEditorUsuario', $formularioEditorUsuario);

    $idUser = (integer) $usuario->getID($conexion, $correo);
    $correo = $_SESSION['correo'];

    $datosUser = [':nombre' => $_POST['nombre'], ':apellidos' => $_POST['apellidos'], ':correo' => $_POST['correo'], ':dni' => $_POST['dni'], ':fechaNac' => $_POST['fechaNac']];
    $sentenciaUpdate = "UPDATE USUARIOS SET correo = :correo, nombre = :nombre, apellidos = :apellidos, dni = :dni, fecha_nac = :fechaNac WHERE correo = '" . $correo . "'";
    $conexion->ejecutarPS($datosUser, $sentenciaUpdate);

    $datosDir = [':provincia' => $_POST['provincia'], ':ciudad' => $_POST['ciudad'], ':calle' => $_POST['calle'], ':numero' => $_POST['num'], ':piso' => $_POST['piso'], ':cod_postal' => $_POST['cod_postal']];
    if ($conexion->comprueboDireccion($idUser)) {
        $sentenciaUpdate = "UPDATE DIRECCIONES SET provincia = :provincia, ciudad = :ciudad, calle = :calle, numero = :numero, piso = :piso, cod_postal = :cod_postal WHERE id_dir = (SELECT id_dir FROM VIVE_EN WHERE id_user ='" . $idUser . "');";
        $conexion->ejecutarPS($datosDir, $sentenciaUpdate);
    } else {
        $sentenciaInsert = "INSERT INTO DIRECCIONES (provincia, ciudad, calle, numero, piso, cod_postal) VALUES (:provincia, :ciudad, :calle, :numero, :piso, :cod_postal)";
        $conexion->ejecutarPS($datosDir, $sentenciaInsert);
        $id_dir = $conexion->conexion->lastInsertId();

        $sentencia = "INSERT INTO VIVE_EN (id_user, id_dir) VALUES ($idUser, $id_dir)";
        $conexion->ejecutar($sentencia);
    }
    $_SESSION['correo'] = $_POST['correo'];
    $correo = $_SESSION['correo'];
    mostrarDatosUser($correo);
} else if (isset($_POST['botonDatos']) && ($_POST['botonDatos'] === 'Editar datos')) {
    $correo = $_SESSION['correo'];
    formularioEdiciónUser($correo);
    mostrarDatosUser($correo);

    $textoBoton = "Guardar datos";
    $smarty->assign('textoBoton', $textoBoton);
} else if (!isset($_POST['botonDatos'])) {
    $correo = $_SESSION['correo'];
    mostrarDatosUser($correo);

    $textoBoton = "Editar datos";
    $smarty->assign('textoBoton', $textoBoton);
}

//mostramos plantilla
$smarty->display("pagar.tpl");

/** Función que recibiendo el correo del usuario logeado muestra 
 * un formulario de edición de sus datos mostrando por defecto los 
 * valores actuales de sus campos
 * @global Smarty $smarty
 * @global BD $conexion
 * @param type $correo
 */
function formularioEdiciónUser($correo) {
    global $smarty, $conexion;
    $sentencia = "SELECT * FROM USUARIOS WHERE correo = '" . $correo . "'";
    $valores = $conexion->seleccion($sentencia);
    foreach ($valores as $valor) {
        $id = $valor['id_user'];
        $nombre = $valor['nombre'];
        $apellidos = $valor['apellidos'];
        $correo = $valor['correo'];
        $dni = $valor['dni'];
        $fechaNac = $valor['fecha_nac'];
    }

    $sentencia = "SELECT * FROM VIVE_EN AS V JOIN DIRECCIONES AS D ON V.id_dir = D.id_dir WHERE id_user = '" . $id . "'";
    $valores = $conexion->seleccion($sentencia);
    foreach ($valores as $valor) {
        $provincia = $valor['provincia'];
        $ciudad = $valor['ciudad'];
        $calle = $valor['calle'];
        $numero = $valor['numero'];
        $piso = $valor['piso'];
        $cod_postal = $valor['cod_postal'];
    }

    $formularioEditorUsuario = "<div class = 'col-lg-6 float-left'>"
            . " <label>Nombre: </label> <input class = 'inputData' type = 'text' name = 'nombre' value = '$nombre'> </br>"
            . " <label>Apellidos: </label> <input class = 'inputData' type = 'text' name = 'apellidos' value = '$apellidos'></br>"
            . " <label>Correo: </label> <input class = 'inputData' type = 'text' name = 'correo' value = '$correo' > </br>"
            . " <label>DNI: </label> <input class = 'inputData' type = 'text' name = 'dni' value = '$dni'> </br>"
            . " <label>Fecha de nacimiento: </label> <input class = 'inputData' type = 'date' name = 'fechaNac' value = '$fechaNac'/><br/></br>"
            . " </div>"
            . " <div class = 'col-lg-6 float-left'>"
            . " <label>Calle: </label> <input class = 'inputData' type = 'text' name = 'calle' value = '$calle'> </br>"
            . " <label>Número: </label> <input class = 'inputData' type = 'text' name = 'num' value = '$numero'> </br>"
            . " <label>Piso: </label> <input class = 'inputData' type = 'text' name = 'piso' value = '$piso'></br>"
            . " <label>Código postal: </label> <input class = 'inputData' type = 'text' name = 'cod_postal' value = '$cod_postal'></br>"
            . " <label>Provincia: </label> <input class = 'inputData' type = 'text' name = 'provincia' value = '$provincia'></br>"
            . " <label>Ciudad: </label> <input class = 'inputData' type = 'text' name = 'ciudad' value = '$ciudad'></br>"
            . " </div>";

    $smarty->assign('formularioEditorUsuario', $formularioEditorUsuario);
}

/** Función que muestra los datos del usuario logeado con un formato determinado
 * @global type $usuario
 * @global BD $conexion
 * @global Smarty $smarty
 * @param type $correo
 */
function mostrarDatosUser($correo) {
    global $usuario, $conexion, $smarty;
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
}

/** Función que muestra el resumen del pago con todos los valores almacenados en la cesta
 * @global Smarty $smarty
 * @global type $cesta
 */
function mostrarTablasResumen() {
    global $smarty, $cesta;
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
}
?>

