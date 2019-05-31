<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}

    <section>
        <div class="perfil seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <div class="my-5">
                    <h1 class="text-center">Gestor de la web</h1>
                    <p class="text-center">Bienvenido de nuevo administrador</p>
                    <form method="post" action="gestorAdmin.php" class="col-12 text-center">
                        <input type="submit" name="botonGestor" class="btn btn-red botonesPago mx-3" value="Productos">
                        <input type="submit" name="botonGestor" class="btn btn-red botonesPago mx-3" value="Mensajes">
                        <input type="submit" name="botonGestor" class="btn btn-red botonesPago mx-3" value="Incidencias">
                        <input type="submit" name="botonGestor" class="btn btn-red botonesPago mx-3" value="Pedidos">
                    </form>
                </div>
                <hr>
                <form action="login.php" method="POST" class="text-center ">
                    <input class="btn btn-red botonesPago my-2 py-2" type="submit" name="desconectar" value="Desconectar">
                </form>
            </fieldset>
            <section class="separacion"></section>
        </div>
    </section>


    {include file = "footer.tpl"}
</html>