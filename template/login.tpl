<!DOCTYPE html>
<html>
    {include file = "head_header.tpl"}

    <section>
        <div class="login seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <div><span class='error'>{$error}</span></div>
                <div class="iniciarSesion col-lg-6 col-md-12 col-sm-12">
                    <form class="formLogin" role="form" action='login.php' method='post' id="formLogin" enctype="multipart/form-data">
                        <h2>Iniciar sesión</h2>
                        <p>¿Ya conoces las ventajas que tiene tener una cuenta de usuario en la web de BEFIT? Con ella podrás comprar nuestros productos y tener un historial alimenticio. Anímate y hazte una cuenta con el formulario de registro de la derecha. Si ya tienes una cuenta, ¿a qué esperas?, accede ahora introduciendo tus credenciales en el formulario de tu izquierda.</p>
                        <div class='campo'>
                            <label>Correo:</label><br/>
                            <input class="inputData" type='text' name='correo' value='luciafffernandez@gmail.com'/><br/>
                        </div>
                        <div class='campo'>
                            <label>Contraseña:</label><br/>
                            <input class="inputData" type='password' name='pass' /><br/>
                        </div>
                        <div class='divSubmit'>
                            <input class="submit btn btn-red" type='submit' name='iniciarSesion' value='Iniciar sesión' />
                        </div>
                    </form>
                </div>
                <div class="registrarse col-lg-6 col-md-12 col-sm-12">
                    <form class="formLogin" role="form" action='login.php' method='post' id="formRegister" enctype="multipart/form-data">
                        <h2>Registrarse</h2>
                        <div class='campo'>
                            <label>Nombre:</label><br/>
                            <input class="inputData" type='text' name='name' value='Lucia'/><br/>
                        </div>
                        <div class='campo'>
                            <label>Apellidos:</label><br/>
                            <input class="inputData" type='text' name='apellidos' value='Fernandez Ulibarrena' /><br/>
                        </div>
                        <div class='campo'>
                            <label>Correo:</label><br/>
                            <input class="inputData" type='text' name='correo' value='nookdesarrollo@gmail.com'/><br/>
                        </div>
                        <div class='campo'>
                            <label>DNI:</label><br/>
                            <input class="inputData" type='text' name='dni' value='73447375A' /><br/>
                        </div>
                        <div class='campo'>
                            <label>Fecha de Nacimiento:</label><br/>
                            <input class="inputData" type='date' name='fechaNac' value='1997-06-19'/><br/>
                        </div>
                        <div class='campo'>
                            <label>Contraseña:</label><br/>
                            <input class="inputData" type='password' name='pass'/><br/>
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