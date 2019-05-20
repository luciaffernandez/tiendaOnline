<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}
    <section class="espacioPequeno"></section>
    <section class="row seccionMargenes">
        <div id="contenedor">
            <div id="encabezado">
                <h1>{$nombre}</h1>
                <h2>Número de referencia: {$numRef}</h2>
                <h2>Precio: {$precio}</h2>
                <img class="col-4" src="./img/{$imagen1}">
                <img src="./img/{$imagen2}">
                <img src="./img/{$imagen3}">
            </div>
            <div id="detalle">
                <h2>Características:</h2>
                <p>Descripción: {$descripcion} </p>
                <p>Unidades disponibles: {$uniDisp}</p>
                <p>Costes de envío: {$costes_envio}</p>
                <p>Dimensiones: {$dimensiones}</p>
                <p>Peso: {$peso}</p>
                <p>Categoria: {$categoria}</p>
            </div>
    </section>
    <section class="row seccionMargenes ">
        <h1 class="text-center col-12">Productos destacados</h1>
        <div class="row contenedorProductos">
            {$productosDestacados}
        </div>
        <button class="btn-complejo col-lg-3 col-xl-2 col-md-10 col-sm-12 col-xs-12 mx-auto mt-5" onclick="location.href = 'tienda.php'">
            <div class="circle">
                <span class="icon arrow"></span>
            </div>
            <p class="button-text ">TIENDA</p>
        </button>
    </section>

    <section class="espacioPequeno"></section>

    {include file = "footer.tpl"}
</html>