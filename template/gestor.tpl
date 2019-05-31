<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}

    <section>
        <div class="perfil seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <div >
                    <h3 class="text-center text-uppercase my-4">Gestor de {$gestor}</h3>
                    {$tabla}
                </div>
            </fieldset>
            <section class="separacion"></section>
        </div>
    </section>
    {include file = "footer.tpl"}
</html>