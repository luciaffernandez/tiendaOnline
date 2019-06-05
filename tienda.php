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

if (isset($_GET['error'])) {
    $error = $_GET['error'];
} else {
    $error = "No hay ningun error";
}
$smarty->assign('error', $error);

//creamos o recogemos cesta
$cesta = Cesta::generaCesta();
//recojo el contenido de la cesta con los productos que vayamos añadiendo y lo mostramos en la plantilla
$carrito = $cesta->mostrarIcono();

$smarty->assign('carrito', $carrito);

//guardamos el estado de la cesta
$cesta->guardaCesta();

//los botones relacionados con la cesta ejecutan las siguiente acciones
if ($_POST['cestaAccion']) {
//recogemos los datos de los productos
    $numRef = $_POST['numRef'];
    $precio = $_POST['precio'];
    $nomProd = $_POST['nomProd'];
    $imagen1 = $_POST['imagen1'];

    switch ($_POST['cestaAccion']) {
        case 'Añadir al carrito':
            $cesta->nuevoProd($precio, $numRef, $nomProd, $imagen1);
            break;
        case 'Vaciar':
            $cesta->vacia();
            break;
        case 'Eliminar':
            $cesta->eliminoProd($numRef);
            break;
        case 'Pagar':
            header("Location:pagar.php");
            break;
    }
}

$cesta->guardaCesta();

//recojo el contenido de la cesta con los productos que vayamos añadiendo y lo mostramos en la plantilla
$carrito = $cesta->mostrarIcono();
$smarty->assign('carrito', $carrito);

$usuario = Usuario::generaUsuario();
$gestorAdmin = $usuario->mostrarBarraAdmin($conexion, $correo);
$smarty->assign('gestorAdmin', $gestorAdmin);
//recojo el resultado de la funcion que creara la lista de Productos y lo muestra
$listado = obtenerListado($conexion);
$smarty->assign('listado', $listado);


if ($_POST['payment_status'] == 'Completed' && $_POST['payer_status'] == 'VERIFIED' && !isset($_SESSION['pedidoHecho'])) {
    $_SESSION['pedidoHecho'] = "PEDIDO HECHO";
    $usuario = Usuario::generaUsuario();
    $fecha_creacion = date("Y-m-d");
    $id_user = $usuario->getID($conexion, $correo);

    $datos = array(':fecha_creacion' => $fecha_creacion, ':id_user' => $id_user);
    $sentencia = "INSERT INTO REGISTROS (fecha_creacion, id_user) VALUES (:fecha_creacion, :id_user)";
    $conexion->ejecutarPS($datos, $sentencia);

    $total = $_POST['mc_gross'];
    $fecha_entrega = date("Y-m-d", strtotime($fecha_creacion . "+ 5 days"));
    $estado = "En camino";
    $id_registro = $conexion->conexion->lastInsertId();

    $datos = array(':id_pedido' => $id_registro, ':total' => $total, ':fecha_entrega' => $fecha_entrega, ':estado' => $estado);
    $sentencia = "INSERT INTO PEDIDOS (id_pedido, total, fecha_entrega, estado) VALUES (:id_pedido, :total, :fecha_entrega, :estado)";
    $conexion->ejecutarPS($datos, $sentencia);

    for ($i = 1; $i <= sizeof($cesta->getProductos()); $i++) {
        $cantidad = $_POST['quantity' . $i];
        $precio = $_POST['mc_gross_' . $i];
        $num_ref = $_POST['item_number' . $i];
        $datos = array(':cantidad' => $cantidad, ':precio' => $precio, ':num_ref' => $num_ref, ':id_pedido' => $id_registro);
        $sentencia = "INSERT INTO DETALLES_PEDIDOS (cantidad, precio, num_ref, id_pedido) VALUES (:cantidad, :precio, :num_ref, :id_pedido)";
        $conexion->ejecutarPS($datos, $sentencia);
        $sentencia = "SELECT unidades_disponibles FROM productos WHERE num_ref = " . $num_ref;
        $result = $conexion->seleccion($sentencia);
        $unidades = $result[0]['unidades_disponibles'];
        $unidades = $unidades - 1;
        $sentencia = "UPDATE productos SET unidades_disponibles = " . $unidades . " WHERE num_ref = " . $num_ref;
        $conexion->ejecutar($sentencia);
        var_dump($sentencia);
    }
}

//se muestra la plantilla del sitio 
$smarty->display("tienda.tpl");

/** Funcion que ejecuta un select recogiendo los productos de la base de datos y va recogiendo sus datos
 * @param type $conexion le pasamos la conexion a la base de datos
 * @return string. Devuelve un string con el html del listado de productos
 */
function obtenerListado($conexion) {
    if (isset($_SESSION['correo']) && isset($_SESSION['pass']))
        $disabled = "";
    else
        $disabled = "disabled";

    $listado = "";
    $datos = $conexion->seleccion("SELECT * FROM PRODUCTOS");
    foreach ($datos as $dato) {
        $nomProd = $dato['nom_producto'];
        $numRef = $dato['num_ref'];
        $precio = $dato['precio'];
        $descripcion = $dato['descripcion'];
        $imagen1 = $dato['imagen1'];
        $nomCat = $dato['nom_categoria'];
        $uds = $dato['unidades_disponibles'];

        $listado .= "<div class='col-xl-3 col-lg-6 col-md-6 mb-lg-0 mb-4 my-4'>"
                . "<form action='tienda.php' method='post'>"
                . "<div class='productos card card-cascade card-ecommerce'>"
                . "<div class='view view-cascade overlay imagenProducto'>"
                . "<input type='hidden' value='$numRef' name='numRef'>"
                . "<input type='hidden' value='$nomProd' name='nomProd'>"
                . "<input type='hidden' value='$precio' name='precio'>"
                . "<input type='hidden' value='$imagen1' name='imagen1'>"
                . "<img class='card-img-top ' src='./img/$imagen1' alt=''>"
                . "<a><div class='mask rgba-white-slight'></div></a>"
                . "</div>"
                . "<div class='card-body card-body-cascade text-center'>"
                . " <h5>$nomCat</h5>"
                . "<h4 class='card-title'><strong><a href='detalleProducto.php?numRef=$numRef'>$nomProd</a></strong></h4>"
                . "<p class='card-text'>$descripcion</p>"
                . "<div class='card-footer'>"
                . "<span class='float-left'>$precio €</span>"
                . "<span class='float-right'>";
        if ($uds > 10) {
            $listado .= "<input class='btn btn-red btn-anadir' type='submit' value='Añadir al carrito' name='cestaAccion' $disabled>";
        }
        $listado .= "</div></div>"
                . "</div>"
                . "</form>"
                . "</div>";
    }
    return $listado;
}

?>