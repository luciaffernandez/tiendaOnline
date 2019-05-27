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

//creamos o recogemos cesta
$cesta = Cesta::generaCesta();
//recojo el contenido de la cesta con los productos que vayamos añadiendo y lo mostramos en la plantilla
$carrito = $cesta->mostrarIcono();
$smarty->assign('carrito', $carrito);

//Guardo el correo del usuario que esta identificado en el sistema
$correo = $_SESSION['correo'];

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
//////////DATOS USUARIO///////////////////////
//
//
//cuando se llegue a este archivo y haya un usuario guardado en sesión y no sea el administrador
if ($usuario->comprueboAdmin($conexion, $correo) === "0") {
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

        $datosUser = [':nombre' => $nombreNew, ':apellidos' => $apellidosNew, ':correos' => $correoNew, ':dni' => $DNINew];
        $sentenciaUpdate = "UPDATE USUARIOS SET correo = :correo', nombre = :nombre, apellidos = :apellidos, dni = :dni WHERE correo = '" . $correo . "'";

        $correo = $_SESSION['correo'];

        $idUser = $conexion->ejecutarPS($datosUser, $sentenciaUpdate);
        $smarty->assign('mensaje', $mensaje);
    } else if (isset($_POST['botonDatos'])) {

        $textoBoton = "Guardar datos";
        $smarty->assign('textoBoton', $textoBoton);

        $correo = $_SESSION['correo'];

        $sentencia = "SELECT * FROM USUARIOS WHERE correo ='" . $correo . "'";
        $valores = $conexion->seleccion($sentencia);

        foreach ($valores as $valor) {
            $id = $valor['id_user'];
            $nombre = $valor['nombre'];
            $apellidos = $valor['apellidos'];
            $correo = $valor['correo'];
            $dni = $valor['dni'];
            $fechaNac = $valor['fecha_nac'];
        }

        $sentencia = "SELECT * FROM VIVE_EN AS V JOIN DIRECCIONES AS D ON V.id_dir = D.id_dir WHERE id_user ='" . $id . "'";
        $valores = $conexion->seleccion($sentencia);

        foreach ($valores as $valor) {
            $provincia = $valor['provincia'];
            $ciudad = $valor['ciudad'];
            $calle = $valor['calle'];
            $numero = $valor['numero'];
            $piso = $valor['piso'];
            $cod_postal = $valor['cod_postal'];
        }

        $formularioEditorUsuario = "<div class='col-lg-6 float-left'>"
                . "<label>Nombre: </label> <input class='inputData' type='text' name='nombre' value='$nombre'> </br>"
                . "<label>Apellidos: </label> <input class='inputData' type='text' name='apellidos' value='$apellidos'></br>"
                . "<label>Correo: </label> <input class='inputData' type='text' name='correo' value='$correo' > </br>"
                . "<label>DNI: </label> <input class='inputData' type='text' name='dni' value='$dni'> </br>"
                . "<label>Fecha de nacimiento: </label> <input class='inputData' type='date' name='fechaNac' value='$fechaNac'/><br/></br>"
                . "</div>"
                . "<div class='col-lg-6 float-left'>"
                . "<label>Calle: </label> <input class='inputData' type='text' name='calle' value='$calle'> </br>"
                . "<label>Número: </label> <input class='inputData' type='text' name='num' value='$numero'> </br>"
                . "<label>Piso: </label> <input class='inputData' type='text' name='piso' value='$piso'></br>"
                . "<label>Código postal: </label> <input class='inputData' type='text' name='cod_postal' value='$cod_postal'></br>"
                . "<label>Provincia: </label> <input class='inputData' type='text' name='provincia' value='$provincia'></br>"
                . "<label>Ciudad: </label> <input class='inputData' type='text' name='ciudad' value='$ciudad'></br>"
                . "</div>";

        $smarty->assign('formularioEditorUsuario', $formularioEditorUsuario);
    } else if (!isset($_POST['botonDatos'])) {
        $textoBoton = "Editar datos";
        $smarty->assign('textoBoton', $textoBoton);
    }
    $smarty->display('perfil.tpl');
} else if ($usuario->comprueboAdmin($conexion, $correo) === "1") {
    //cuando se llegue a este fichero y haya un usuarios guardado en sesión y sea el administrador
    header("Location:gestorAdmin.php");
} 
