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
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
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
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2980.304294664736!2d-0.9002779!3d41.6707712!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd596b2bd1c140e3%3A0xbf4fe782a770d2aa!2sQTZ+Marketing+-+Agencia+de+marketing+y+dise%C3%B1o+web!5e0!3m2!1ses!2ses!4v1556095201474!5m2!1ses!2ses" 
                                frameborder="0" style="border:0" allowfullscreen class="mapaFooter"></iframe>
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