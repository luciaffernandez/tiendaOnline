<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}

    <section>
        <div class="perfil seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <div>
                    <h3 class="text-center text-uppercase my-4">Formulario de productos</h3>
                    <form action="formProducto.php" method="post">
                        {$formulario}
                        <input type="submit" value='{$btn}' name='enviar'>
                        <input type="submit" value="Cancelar" name='enviar'>
                    </form>
                </div>
            </fieldset>
            <section class="separacion"></section>
        </div>
    </section>
    {include file = "footer.tpl"}
</html>