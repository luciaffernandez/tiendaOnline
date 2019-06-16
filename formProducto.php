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

$nomTabla = 'Productos';
$boton = $_GET['add'];

if ($boton == "add")
    $btn = "Insertar";
else
    $btn = "Guardar";

$campos = $_SESSION['campos'];
$campos = unserialize($campos);

if (isset($_POST['enviar'])) {
    switch ($_POST['enviar']) {
        case 'Guardar':
            $nomTabla = 'Productos';
            $valorNuevo = $_POST['valorNuevo'];
            $valorAnt = $_POST['valorAnt'];
            $campos = $_POST['campos'];
            $sentencia = generaSentenciaUpdate($nomTabla, $campos, $valorAnt, $valorNuevo);
            $conexion->ejecutar($sentencia);
            
            $gestor = $nomTabla;
            header("Location:gestor.php?gestor=$nomTabla");
            break;
        case 'Insertar':
            $valorNuevo = $_POST['valorNuevo'];
            $campos = $_POST['campos'];
            $sentencia = generaInsert($nomTabla, $campos, $valorNuevo);
           
            $conexion->ejecutar($sentencia);
            $error = $conexion->getInfo();
            $gestor = $nomTabla;
            header("Location:gestor.php?gestor=$nomTabla");
            break;
        case 'Cancelar':
            $gestor = $nomTabla;
            header("Location:gestor.php?gestor=$nomTabla");
            break;
    }
}
$formulario = obtenerFormulario($campos, $boton);
$smarty->assign('btn', $btn);
$smarty->assign('formulario', $formulario);
$smarty->display("formProducto.tpl");

function generaSentenciaUpdate($nomTabla, $campos, $valorAnt, $valorNuevo) {
    $indice = 0;
    foreach ($campos as $titulo => $campo) {
        if($titulo == "num_ref"){
             
        }else{
        $set .= "$titulo = '" . $valorNuevo[$indice] . "', ";
        $where .= "$titulo = '" . $valorAnt[$indice] . "' and ";
        $indice++;
        }
    }
    $set = substr($set, 0, strlen($set) - 2);
    $where = substr($where, 0, strlen($where) - 4);
    $sentencia = "UPDATE $nomTabla SET $set WHERE $where";
    return $sentencia;
}

function generaInsert($nombreTabla, $campos, $valorNuevo) {
    $cols = "";
    $indice = 0;
    foreach ($campos as $titulo => $campo) {
        if($titulo == "num_ref"){
             
        }else{
            $cols .= "$titulo,";
            $values .= "'" . $valorNuevo[$indice] . "',";
            $indice++;
        }
    }
    $cols = substr($cols, 0, strlen($cols) - 1);
    $values = substr($values, 0, strlen($values) - 1);
    $sentencia = "INSERT INTO $nombreTabla ($cols) VALUES ($values)";
    return $sentencia;
}

function obtenerFormulario($campos, $boton) {
    $formulario = "";
    foreach ($campos as $titulo => $campo) {
        if ($boton == "add") {   
            if($titulo != "num_ref"){
                $formulario .= "<div class = 'campo col-xl-6 px-4'><label>$titulo</label><br/>";
                $formulario .= "<input type = 'text' name = 'valorNuevo[]' value = '' class='inputData'/><br />";
                $formulario .= "<input type = 'hidden' name = 'campos[$titulo]' value = '$campo' class='inputData'/><br />" .
                "<input type = 'hidden' name = 'valorAnt[]' value= '$campo' />";
            }else{
                $formulario .= "<div class = 'campo col-xl-6 px-4 py-4'><label>El numero de referencia se pondra automáticamente</label><br/>";
            }
        } else {
            if($titulo == "num_ref"){
                $formulario .= "<div class='row'><div class = 'campo col-xl-6 px-4'><label>$titulo:</label>";
                $formulario .= "<div class='my-2'>$campo</span></div>";
                
            }else{
                $formulario .= "<div class = 'campo col-xl-6 px-4'><label>$titulo</label><br/>";
                $formulario .= "<input type = 'text' name = 'valorNuevo[]' value = '$campo' class='inputData'/><br />";
                $formulario .= "<input type = 'hidden' name = 'campos[$titulo]' value = '$campo' class='inputData'/><br />" .
                "<input type = 'hidden' name = 'valorAnt[]' value= '$campo' />";
            }
            
        }
        $formulario .= "</div>";
    }
    return $formulario;
}
