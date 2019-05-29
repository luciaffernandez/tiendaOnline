<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}

    <section>
        <div class="perfil seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <div><span class='error'>{$error}</span></div>
                <form method="post" action="perfil.php" class="col-12">
                    <div class="col-12">
                        <h3>Datos del usuario</h3>
                        {$datosUsuario}
                    </div>
                    </br>
                    {$formularioEditorUsuario}
                    <input type="submit" name="botonDatos" class="btn btn-red botonesPago" value="{$textoBoton}">
                </form>
                <section class="separacion"></section>
                <hr>
                <h3>Historial de pedidos</h3>
                <div>{$historial}</div>
                <form action="login.php" method="POST" class="text-center my-5">
                    <input class="btn btn-red botonesPago" type="submit" name="desconectar" value="Desconectar">
                    <input class="btn btn-red botonesPago" type="submit" name="eliminarCuenta" value="Eliminar cuenta">
                </form>
            </fieldset>
            <section class="separacion"></section>
        </div>
    </section>

    {include file = "footer.tpl"}
</html>