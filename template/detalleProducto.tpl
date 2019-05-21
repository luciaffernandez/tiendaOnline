<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}
    <section class="espacioPequeno"></section>
    <section class="row seccionMargenes">
        <div class="container">
            <div class="card">
                <div class="container-fliud">
                    <div class="wrapper row">
                        <div class="preview col-md-6">

                            <div class="preview-pic tab-content">
                                <div class="productImg tab-pane active" id="pic-1" style="background-image: url(./img/{$imagen1})"></div>
                                <div class="productImg tab-pane" id="pic-2" style="background-image: url(./img/{$imagen1})"></div>
                                <div class="productImg tab-pane" id="pic-3" style="background-image: url(./img/{$imagen1})"></div>
                            </div>
                        </div>
                        <div class="details col-md-6">
                            <form action='detalleProducto.php' method='post'>
                                <h3 class="product-title">{$nombre}</h3>
                                <h5>{$categoria}</h5>

                                <p class="product-description">{$descripcion}</p>
                                <h4 class="price">Precio: <span>{$precio} €</span></h4>
                                <strong>Características</strong>
                                <p>Unidades disponibles: {$uniDisp}</br>
                                    Costes de envío: {$costes_envio}</br>
                                    Dimensiones: {$dimensiones}</br>
                                    Peso: {$peso}</br>
                                <div class="action">
                                    <input type='hidden' value='{$numRef}' name='numRef'>
                                    <input type='hidden' value='{$nombre}' name='nomProd'>
                                    <input type='hidden' value='{$precio}' name='precio'>
                                    <input type='hidden' value='{$imagen1}' name='imagen1'>
                                    <input class='btn btn-red btn-anadir' type='submit' value='Añadir al carrito' name='cestaAccion' {$disabled}>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="espacioPequeno"></section>
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