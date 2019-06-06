<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}

    <section>
        <div class="contacto seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <div><span class='error'>{$error}</span></div>
                <div class="iniciarSesion col-lg-6 col-md-12 col-sm-12">

                    <h2>Contacta con nosotros</h2>
                    <p>¿Tienes cualquier duda o sugerencia? Envíanos un mensaje y te responderemos lo antes posible. Esperamos que nuestra web te haya gustado y que te hayas animado a porbar alguno de nuestros productos. Hablamos pronto. </p>
                    <p>
                        <i class="fas fa-home mr-3"></i>Calle Instalación, 22 bajo, Instalación, Instalación</p>
                    <p>
                        <i class="fas fa-envelope mr-3"></i>instalacion@gmail.com</p>
                    <p>
                        <i class="fas fa-phone mr-3"></i>976 99 55 22</p>
                    <p>
                        <i class="fas fa-phone mr-3"></i>666 00 11 33</p>
                    <section style="height: 20px;"></section>
                    <div class="col-md-12 col-lg-12 col-xl-12 mx-auto ">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3903.1075308829786!2d121.9192161404189!3d11.96705638267484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a52ae7cdaf5b77%3A0x6544e4bc01b87e12!2sLugar+Bonito+Hotel+-+Boracay!5e0!3m2!1ses!2ses!4v1559845074744!5m2!1ses!2ses" frameborder="0" style="border:0" allowfullscreen class="mapaFooter"></iframe>
                    </div>

                </div>
                <div class="registrarse col-lg-6 col-md-12 col-sm-12">
                    <form class="formLogin" role="form" action='contacto.php' method='post' id="formContact" enctype="multipart/form-data">
                        <section class="separacion"></section>
                        <div class='campo'>
                            <label>Nombre:</label><br/>
                            <input class="inputData" type='text' name='name' value='Lucia'/><br/>
                        </div>
                        <div class='campo'>
                            <label>Correo:</label><br/>
                            <input class="inputData" type='text' name='correo' value='nookdesarrollo@gmail.com'/><br/>
                        </div>
                        <div class='campo'>
                            <label>Asunto:</label><br/>
                            <input class="inputData" type='text' name='asunto' /><br/>
                        </div>
                        <div class='campo'>
                            <label>Mensaje:</label><br/>
                            <textarea class="inputData" name='mensaje' style="height: 100px;"></textarea>
                        </div>
                        <div class='divSubmit'>
                            <input class="submit btn btn-red" type='submit' name='enviarMensaje' value='Enviar'/>
                        </div>
                    </form>
                </div>
            </fieldset>
            <section class="separacion"></section>
        </div>
    </section>

    {include file = "footer.tpl"}
</html>