<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}
    <section class="seccionMargenes text-center my-5">
        <div class="row">
            {$listado}
        </div>
    </section>
    <form action="login.php" method="POST">
        <input type="submit" name="desconectar" value="Desconectar">
    </form>
    {include file = "footer.tpl"}

</body>
</html>