<html>
    {include file = "head_header.tpl"}
    <section class="separacion"></section>
    <section class="row seccionMargenes">
        <div class="col-6"><h3>Resumen de factura del usuario {$usuario}</h3></div>
        <div class="col-6"><h4 style="text-align:right">Fecha: {$fecha}</h4></div>
        <hr />
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" class="col-12">
            <input name="cmd" type="hidden" value="_cart" />
            <input name="upload" type="hidden" value="1" />
            <input name="business" type="hidden" value="luciafffernandez-facilitator@gmail.com" />
            <input name="shopping_url" type="hidden" value="http://tienda/ejemploPaypal/index.php" />
            <input name="currency_code" type="hidden" value="EUR" />
            <input name="return" type="hidden" value="http://localhost/tiendaOnline/tienda.php" />
            <input name="notify_url" type="hidden" value="http://localhost/tiendaOnline/tienda.php" />
            <input name="rm" type="hidden" value="2" />

            <table id="tablaPagar" class="w-100">
                <thead>
                    <tr class="pago">
                        <th class="pago">Cantidad</th>
                        <th class="pago">Imagen</th>
                        <th class="pago">Nombre</th>
                        <th class="pago">Número de referencia</th>
                        <th class="pago">Precio Unitario</th>
                    </tr>
                </thead>
                {$resumenPago}
            </table>
            <hr />
            <section class="flex">
                <div class="imagenFondoCarrito col-6"></div>
                <table class="col-5 float-right">
                    <thead>
                        <tr class="pago">
                            <th class = "pago" colspan = 2><strong>RESUMEN DE LA FACTURA</strong></th>
                    </thead>
                    <tr class="pago">
                        <td class="pago">Total articulos</td>
                        <td class="pago">{$cantidadProductos}</td>
                    </tr>
                    <tr>
                        <td class="pago">Precio total Sin iva</td>
                        <td class="pago">{$total}</td>
                    </tr>
                    <tr>
                        <td class="pago">IVA</td>
                        <td class="pago">{$IVA}</td></td>
                    </tr>
                    <tr>
                        <td class="pago">TOTAL pagar</td>
                        <td class="pago">{$totalIVA}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center botonFinalizaCompra">
                            <input type="submit" name="submit" alt="Realice pagos con PayPal: es rápido, gratis y seguro" class="btn btn-red mx-auto botonesPago" value="Finalizar pedido" {$deshabilitado}> 
                            <p class="my-4" > Para proceder a finalizar el pago necesitamos que tengas una dirección guardada</p>
                        </td>
                    </tr>
                </table>

            </section>
        </form>
        <section class="espacioPequeno"></section>
        <form method="post" action="pagar.php" class="col-12">
            <div class="col-12">
                <h3>Datos del usuario</h3>
                {$datosUsuario}
            </div>
            </br>
            {$formularioEditorUsuario}
            <input type="submit" name="botonDatos" class="btn btn-red botonesPago" value="{$textoBoton}">
        </form>

    </div>
</section>
<section class="separacion"></section>
    {include file = "footer.tpl"}
</html>