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
    $filas = $conexion->seleccion($consulta);
    $tabla = "";
    $idPedido = "";
    if ($nomTabla === 'Productos') {
        $tabla .= "<div class='text-center'><input type = 'submit' value = 'Añadir producto' name = 'accion' class='btn btn-red botonesPago my-4'></div>";
    }
    foreach ($filas as $fila) {
        $tabla .= "<table id='tablaPagar' class='pago col-8 mx-auto'>";
        $tabla .= "<form action='gestor.php'  method='post'>"
                . "<tr class='pago'>"
                . "<input type='hidden' value='$nomTabla' name='tabla'>";

        foreach ($fila as $titulo => $dato) {
            $tabla .= "<th class='pago mayus titulosGestor'>$titulo</th>"
                    . "<td class='pago camposGestor'>$dato</td>\n"
                    . "<input type='hidden' name='campos[$titulo]' value='$dato'>\n"
                    . "</tr>";
            if ($nomTabla === 'Pedidos' && $titulo === 'id_pedido') {
                $idPedido = $dato;
            }
        }
        if ($nomTabla === 'Productos') {
            $tabla .= "<tr>"
                    . "<td class='pago'>\n</td>"
                    . "<td class='pago text-center'>\n"
                    . "<input type = 'submit' value = 'Editar' name = 'accion' class='btn btn-red botonesPago my-4'>"
                    . "</td></tr>";
        }
        $tabla .= "</form>";
        $tabla .= "</table><br>";
        if ($nomTabla === 'Pedidos') {
            $sentencia = "SELECT * FROM REGISTROS WHERE id_registro = '" . $idPedido . "';";
            $filas = $conexion->seleccion($sentencia);
            foreach ($filas as $fila) {
                $tabla .= "<table id='tablaPagar' class='pago col-8 mx-auto'>";
                $tabla .= "<tr class='pago'>";
                foreach ($fila as $titulo => $dato) {
                    $tabla .= "<th class='pago mayus titulosGestor'>$titulo</th>"
                            . "<td class='pago camposGestor'>$dato</td>\n"
                            . "</tr>";
                }
                $tabla .= "</table>";
            }
        }
        $tabla .= "<hr class='col-10 mx-auto'><br>";
    }
    return $tabla;
}
