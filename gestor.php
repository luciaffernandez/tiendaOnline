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

//si tenemos guardados las variables de sesion usuario y contraseña 
if (isset($_SESSION['correo']) && isset($_SESSION['pass'])) {
//las guardamos en variables
    $correo = $_SESSION['correo'];
    $pass = $_SESSION['pass'];
}

//creamos o recogemos cesta
$cesta = Cesta::generaCesta();
//recojo el contenido de la cesta con los productos que vayamos añadiendo y lo mostramos en la plantilla
$carrito = $cesta->mostrarIcono();
$smarty->assign('carrito', $carrito);

$usuario = Usuario::generaUsuario();
$gestorAdmin = $usuario->mostrarBarraAdmin($conexion, $correo);
$smarty->assign('gestorAdmin', $gestorAdmin);
//se muestra la plantilla del sitio 
if (isset($_GET['gestor'])) {
    $gestor = $_GET['gestor'];
    $smarty->assign('gestor', $gestor);
    $tabla = generoTabla($conexion, $gestor);
    $smarty->assign('tabla', $tabla);
}


$smarty->display("gestor.tpl");

function generoTabla($conexion, $nomTabla): string {

    $consulta = "Select * from $nomTabla";
    $titulos = $conexion->nomCol($nomTabla);
    $filas = $conexion->seleccion($consulta);
    $tabla = "<table id='tabla' class='display' border='1'>"
            . "<tr>";
    foreach ($titulos as $titulo) {
        $tabla .= "<th>$titulo</th>";
    }
    $tabla .= "<th colspan='2'>Acciones</th>"
            . "</tr>";
    foreach ($filas as $fila) {
        $tabla .= "<tr>"
                . "<form action='gestorTablas.php'  method='post'>"
                . "<input type='hidden' value='$nomTabla' name='tabla'>";
        foreach ($fila as $titulo => $dato) {
            $tabla .= "<td>$dato</td>\n"
                    . "<input type='hidden' name='campos[$titulo]' value='$dato'>\n";
        }
        $tabla .= "<td>\n"
                . "<input type = 'submit' value = 'Editar' name = 'accion'>"
                . "</td>"
                . "<td>"
                . "<input type = 'submit' value = 'Borrar' name = 'accion'>"
                . "</td>"
                . "</form>"
                . "</tr>";
    }
    $tabla .= "</table>";
    return $tabla;
}
