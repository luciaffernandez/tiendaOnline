<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}
    {literal}
        <!-- JS Validate -->
        <script src="js/jquery.validate.js"></script>
        <script>
            $(document).ready(function () {
                $("#formularioValidate").validate({
                    rules: {
                        correo: {
                            required: true,
                            email: true
                        },
                        pass: {
                            required: true,
                            minlength: 6
                        }
                    },
                    messages: {
                        correo: {
                            required: "Campo obligatorio",
                            maxlength: "Introduce email válido",
                        },
                        pass: {
                            required: "Campo obligatorio",
                            minlength: "Campo demasiado corto",
                        }
                    },
                    errorElement: "em",
                });
            });
        </script>

    {/literal}
    <section>
        <div class="login seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <div><span class='error'>{$error}</span></div>
                <div class="iniciarSesion col-lg-6 col-md-12 col-sm-12">
                    <form class="formLogin" role="form" action='login.php' method='post' id="formularioValidate" enctype="multipart/form-data">
                        <h2>Iniciar sesión</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                        <div class='campo'>
                            <label>Correo:</label><br/>
                            <input class="inputData" type='text' name='correo' value='luciafffernandez@gmail.com'/><br/>
                        </div>
                        <div class='campo'>
                            <label>Contraseña:</label><br/>
                            <input class="inputData" type='password' name='pass' value='user1'/><br/>
                        </div>
                        <div class='divSubmit'>
                            <input class="submit btn btn-red" type='submit' name='iniciarSesion' value='Iniciar sesión' />
                        </div>
                    </form>
                </div>
                <div class="registrarse col-lg-6 col-md-12 col-sm-12">
                    <form class="formLogin" action='login.php' method='post'>
                        <h2>Registrarse</h2>
                        <div class='campo'>
                            <label>Nombre:</label><br/>
                            <input class="inputData" type='text' name='name' value='Lucia' maxlength="50" /><br/>
                        </div>
                        <div class='campo'>
                            <label>Apellidos:</label><br/>
                            <input class="inputData" type='text' name='apellidos' value='Fernandez Ulibarrena' maxlength="50" /><br/>
                        </div>
                        <div class='campo'>
                            <label>Correo:</label><br/>
                            <input class="inputData" type='text' name='correo' value='nookdesarrollo@gmail.com' maxlength="50" /><br/>
                        </div>
                        <div class='campo'>
                            <label>DNI:</label><br/>
                            <input class="inputData" type='text' name='dni' value='73447375A' maxlength="50" /><br/>
                        </div>
                        <div class='campo'>
                            <label>Fecha de Nacimiento:</label><br/>
                            <input class="inputData" type='text' name='fechaNac' value='1997-06-19' maxlength="50" /><br/>
                        </div>
                        <div class='campo'>
                            <label>Contraseña:</label><br/>
                            <input class="inputData" type='password' name='pass' value='user1' maxlength="50" /><br/>
                        </div>
                        <div class='divSubmit'>
                            <input class="submit btn btn-red" type='submit' name='crearUsuario' value='Crear usuario'/>
                        </div>
                    </form>
                </div>
            </fieldset>
            <section class="separacion"></section>
        </div>
    </section>
    {include file = "footer.tpl"}
</html>