<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}
    <section class="seccionMargenes text-center my-5">
        <div class="row contenedorProductos">
            {$listado}
        </div>
    </section>
    {$debug}
    <form action="login.php" method="POST" class="text-center my-5">
        <input class="btn btn-red" type="submit" name="desconectar" value="Desconectar">
        <input class="btn btn-red" type="submit" name="eliminarCuenta" value="Eliminar cuenta">
    </form>
    {include file = "footer.tpl"}

</body>
</html>