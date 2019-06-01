<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}

    <section>
        <div class="perfil seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <div class="registrarse col-12 px-auto">
                    <h3 class="text-center text-uppercase my-4">Formulario de productos</h3>
                    <form action="formProducto.php" role="form" method="post" class="formLogin mx-auto row" id="formContact" enctype="multipart/form-data">
                        {$formulario}
                        <div class='text-center mx-auto'>
                            <input type="submit" value='{$btn}' name='enviar' class='btn btn-red botonesPago mx-3'>
                            <input type="submit" value="Cancelar" name='enviar' class='btn btn-red botonesPago mx-3'>
                        </div>
                    </form>
                </div>
            </fieldset>
            <section class="separacion"></section>
        </div>
    </section>
    {include file = "footer.tpl"}
</html>