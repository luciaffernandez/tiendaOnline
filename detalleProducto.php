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
if (isset($_SESSION['user']) && isset($_SESSION['pass'])) {
    $correo = $_SESSION['correo'];
    $pass = $_SESSION['pass'];
}

//creamos o recogemos cesta
$cesta = Cesta::generaCesta();
//recojo el contenido de la cesta con los productos que vayamos añadiendo y lo mostramos en la plantilla
$carrito = $cesta->mostrarIcono();

$smarty->assign('carrito', $carrito);

//seleccionamos todos los ordenadores
$productos = $conexion->seleccion("SELECT * FROM PRODUCTOS");
//recorremos el array que ha devuelto y vamos recogiendo los datos que queremos
foreach ($productos as $datos) {
    $numRef = $datos['num_ref'];
    $nombre = $datos['nom_producto'];
    $precio = $datos['precio'];
    $descripcion = $datos['descripcion'];
    $imagen1 = $datos['imagen1'];
    $imagen2 = $datos['imagen2'];
    $imagen3 = $datos['imagen3'];
    $uniDisp = $datos['unidades_disponibles'];
    $costes_envio = $datos['costes_envio'];
    $dimensiones = $datos['dimensiones'];
    $peso = $datos['peso'];
    $categoria = $datos['nom_categoria'];
}

//asignamos todos esas variables a la plantilla 
$smarty->assign('numRef', $numRef);
$smarty->assign('nombre', $nombre);
$smarty->assign('precio', $precio);
$smarty->assign('descripcion', $descripcion);
$smarty->assign('imagen1', $imagen1);
$smarty->assign('imagen2', $imagen2);
$smarty->assign('imagen3', $imagen3);
$smarty->assign('uniDisp', $uniDisp);
$smarty->assign('costes_envio', $costes_envio);
$smarty->assign('dimensiones', $dimensiones);
$smarty->assign('peso', $peso);
$smarty->assign('categoria', $categoria);

$productosDestacados = obtenerListado($conexion);
$smarty->assign('productosDestacados', $productosDestacados);

if (isset($_SESSION['correo']) && isset($_SESSION['pass']))
    $disabled = "";
else
    $disabled = "disabled";

$smarty->assign('diabled', $disabled);
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

//mostramos la plantilla
$smarty->display("detalleProducto.tpl");

function obtenerListado($conexion) {
    if (isset($_SESSION['correo']) && isset($_SESSION['pass']))
        $disabled = "";
    else
        $disabled = "disabled";
    $i = 0;
    $listado = "";
    $datos = $conexion->seleccion("SELECT * FROM PRODUCTOS");
    foreach ($datos as $dato) {
        if ($i < 3) {
            $nomProd = $dato['nom_producto'];
            $numRef = $dato['num_ref'];
            $precio = $dato['precio'];
            $descripcion = $dato['descripcion'];
            $imagen1 = $dato['imagen1'];
            $nomCat = $dato['nom_categoria'];

            $listado .= "<div class='col-xl-4 col-lg-4 col-md-10 mb-lg-0 mb-4 mx-auto'>"
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
                    . "<h4 class='card-title'><strong><a href=''>$nomProd</a></strong></h4>"
                    . "<p class='card-text'>$descripcion</p>"
                    . "<div class='card-footer'>"
                    . "<span class='float-left'>$precio €</span>"
                    . "<span class='float-right'>"
                    . " <input class='btn btn-red btn-anadir' type='submit' value='Añadir al carrito' name='cestaAccion' $disabled>"
                    . "</div>"
                    . "</div>"
                    . "</div>"
                    . "</form>"
                    . "</div>";
            $i++;
        } else {
            break;
        }
    }
    return $listado;
}
?>

