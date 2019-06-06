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

//se muestra la plantilla del sitio 

if (isset($_GET['gestor'])) {
    $gestor = $_GET['gestor'];
    $smarty->assign('gestor', $gestor);
    $tabla = generoTabla($conexion, $gestor);
    $smarty->assign('tabla', $tabla);
} else if (isset($_POST['gestor'])) {
    $gestor = $_POST['gestor'];
    $smarty->assign('gestor', $gestor);
    $tabla = generoTabla($conexion, $gestor);
    $smarty->assign('tabla', $tabla);
    header("Location:gestor.php?gestor=$gestor");
}

if (isset($_POST['accion'])) {
    $campos = $_POST['campos'];
    switch ($_POST['accion']) {
        case "Editar":
            $campos = serialize($campos);
            $_SESSION['campos'] = $campos;
            header("Location:formProducto.php");
            exit();
        case "Añadir producto":
            $add = "add";
            $campos = serialize($campos);
            $_SESSION['campos'] = $campos;
            header("Location:formProducto.php?add=$add");
            exit();
    }
}
if (isset($_POST['botonEstado']) && ($_POST['botonEstado'] === 'Guardar')) {
    $id_pedido = $_POST['id_pedido'];
    $datosEstado = [':estado' => $_POST['estadoRadio']];
    $sentencia = "UPDATE PEDIDOS SET estado = :estado WHERE id_pedido ='" . $id_pedido . "';";
    $conexion->ejecutarPS($datosEstado, $sentencia);
}

$smarty->display("gestor.tpl");

function generoTabla($conexion, $nomTabla): string {
    global $usuario;
    $checked1 = "";
    $checked2 = "";
    $consulta = "Select * from $nomTabla";
    $filas = $conexion->seleccion($consulta);
    $tabla = "";
    $idPedido = "";
    if ($nomTabla === 'Productos') {
        $tabla .= "<div class='text-center'>"
                . "<form action='gestor.php'  method='post'><input type = 'submit' value = 'Añadir producto' name = 'accion' class='btn btn-red botonesPago my-4'>";
    }
    foreach ($filas as $fila) {
        $tabla .= "<table id='tablaPagar' class='pago col-8 mx-auto'>";
        $tabla .= "<form action='gestor.php'  method='post'>"
                . "<tr class='pago'>"
                . "<input type='hidden' value='$nomTabla' name='tabla'>";

        foreach ($fila as $titulo => $dato) {
            $tabla .= "<th class='pago mayus titulosGestor'>$titulo</th>";
            if ($titulo === 'correo') {
                $tabla .= "<td class='pago camposGestor'><a href='mailto:$dato'>$dato</a></td>\n";
            } else {
                $tabla .= "<td class='pago camposGestor'>$dato</td>\n";
            }
            $tabla .= "<input type='hidden' name='campos[$titulo]' value='$dato'>\n"
                    . "</tr>";
            if ($nomTabla === 'Pedidos') {
                if ($titulo === 'id_pedido') {
                    $idPedido = $dato;
                }
                if ($titulo === 'estado') {
                    $estado = $dato;
                    if ($estado === "Entregado") {
                        $checked2 = "checked";
                        $checked1 = "";
                    } else {
                        $checked1 = "checked";
                        $checked2 = "";
                    }
                }
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
            $titulos = $conexion->nomCol('REGISTROS');
            $filas = $conexion->seleccion($sentencia);
            $tabla .= "<table id='tablaPagar' class='pago col-8 mx-auto'><thead>"
                    . "<tr class='pago'>";
            foreach ($titulos as $titulo) {
                $tabla .= "<th class='pago'>$titulo</th>";
            }
            $tabla .= "</tr></thead><tbody>";
            foreach ($filas as $fila) {
                $tabla .= "<tr class='pago'>";
                foreach ($fila as $titulo => $dato) {
                    $tabla .= "<td class='pago'>$dato</td>\n";
                    if ($titulo === 'id_user') {
                        $idUser = $dato;
                    }
                }
            }
            $tabla .= "<tbody></table><br>";
            $sentencia = "SELECT * FROM DETALLES_PEDIDOS WHERE id_pedido = '" . $idPedido . "';";
            $titulos = $conexion->nomCol('DETALLES_PEDIDOS');
            $filas = $conexion->seleccion($sentencia);
            $tabla .= "<table id='tablaPagar' class='pago col-8 mx-auto'><thead>"
                    . "<tr class='pago'>";
            foreach ($titulos as $titulo) {
                $tabla .= "<th class='pago'>$titulo</th>";
            }
            $tabla .= "</tr></thead><tbody>";
            foreach ($filas as $fila) {
                $tabla .= "<tr class='pago'>";
                foreach ($fila as $titulo => $dato) {
                    $tabla .= "<td class='pago'>$dato</td>\n";
                }
            }
            $tabla .= "</tbody></table><br>";
            $sentencia = "SELECT * FROM USUARIOS WHERE id_user = '" . $idUser . "';";
            $titulos = $conexion->nomCol('USUARIOS');
            $filas = $conexion->seleccion($sentencia);
            $tabla .= "<table id='tablaPagar' class='pago col-8 mx-auto'><thead>"
                    . "<tr class='pago'>";
            foreach ($titulos as $titulo) {
                $tabla .= "<th class='pago'>$titulo</th>";
            }
            $tabla .= "</tr></thead><tbody>";
            foreach ($filas as $fila) {
                $tabla .= "<tr class='pago'>";
                foreach ($fila as $titulo => $dato) {
                    if ($titulo === 'correo') {
                        $correoUser = $dato;
                        $tabla .= "<td class='pago'><a href='mailto:$dato'>$dato</a></td>\n";
                    } else if ($titulo === 'password') {
                        $tabla .= "<td class='pago '>****</td>\n";
                    } else {
                        $tabla .= "<td class='pago '>$dato</td>\n";
                    }
                }
            }
            $tabla .= "</tbody></table><br>";
            $direccionCompleta = $usuario->getDireccion($conexion, $correoUser);
            foreach ($direccionCompleta as $dato) {
                $calle = $dato[2];
                $provincia = $dato[0];
                $ciudad = $dato[1];
                $numero = $dato[3];
                $piso = $dato[4];
                $cod_postal = $dato[5];
                $direccionUsuario = "$calle $numero, $piso, $ciudad, $provincia, $cod_postal";
            }
            $tabla .= "<p class='text-center'>Dirección de envío: " . $direccionUsuario . "</p>";
            $tabla .= "<div class='mx-auto text-center'>"
                    . "<form method='post' action='gestor.php'>"
                    . "<input type='hidden' name='id_pedido' value='" . $idPedido . "'/>"
                    . "<input type='hidden' name='gestor' value='" . $nomTabla . "'/>"
                    . "<div class='form-check form-check-inline'><input class='form-check-input' type='radio' name='estadoRadio' value='En camino' $checked1>"
                    . "<label class='form-check-label'>En camino</label></div>"
                    . "<div class='form-check form-check-inline my-3'><input class='form-check-input' type='radio' name='estadoRadio' value='Entregado' $checked2>"
                    . "<label class='form-check-label'>Entregado</label></div>"
                    . "<input type='submit' class='btn btn-red botonesPago my-0 mx-3' name='botonEstado' value='Guardar'>"
                    . "</form>"
                    . "</div>";
        }
        $tabla .= "<hr class='col-10 mx-auto'><br>";
    }
    $tabla .= "</form></div>";
    return $tabla;
}
