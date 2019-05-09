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

//controlo los botones de la cesta según lo que contenga
if (empty($cesta->getProductos()) || is_null($cesta->getProductos())) {
    $disabled = "disabled";
} else {
    $disabled = "";
}
$smarty->assign('disabled', $disabled);

//recojo el contenido de la cesta con los productos que vayamos añadiendo y lo mostramos en la plantilla
$contenidoCesta = $cesta->mostrarCesta();
$smarty->assign('contenidoCesta', $contenidoCesta);

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

//Codigo para deshabilitar botones de la cesta cuando esta esté vacía. 
//Lo controlamos con una variable que rellena los inputs con atributos según el estado que nos interesa qeu tenga
if (empty($cesta->getProductos()) || is_null($cesta->getProductos())) {
    $disabled = "disabled";
} else {
    $disabled = "";
}
$smarty->assign('disabled', $disabled);

//recojo el resultado de la funcion que crea el html de la cesta y la muestra
$contenidoCesta = $cesta->mostrarCesta();

$smarty->assign('contenidoCesta', $contenidoCesta);


//recojo el resultado de la funcion que creara la lista de Productos y lo muestra
$listado = obtenerListado($conexion);
$smarty->assign('listado', $listado);

//se muestra la plantilla del sitio 
$smarty->display("tienda.tpl");

/** Funcion que ejecuta un select recogiendo los productos de la base de datos y va recogiendo sus datos
 * @param type $conexion le pasamos la conexion a la base de datos
 * @return string. Devuelve un string con el html del listado de productos
 */
function obtenerListado($conexion) {
    $listado = "";
    $datos = $conexion->seleccion("SELECT * FROM PRODUCTOS");
    foreach ($datos as $dato) {
        $nomProd = $dato['nom_producto'];
        $numRef = $dato['num_ref'];
        $precio = $dato['precio'];
        $descripcion = $dato['descripcion'];
        $imagen1 = $dato['imagen1'];
        $nomCat = $dato['nom_categoria'];

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
                . "<h4 class='card-title'><strong><a href=''>$nomProd</a></strong></h4>"
                . "<p class='card-text'>$descripcion</p>"
                . "<div class='card-footer'>"
                . "<span class='float-left'>$precio €</span>"
                . "<span class='float-right'>"
                . " <input class='btn btn-red btn-anadir' type='submit' value='Añadir al carrito' name='cestaAccion'>"
                . "</div>"
                . "</div>"
                . "</div>"
                . "</form>"
                . "</div>";
    }
    return $listado;
}

?>