<?php
/* Smarty version 3.1.33, created on 2019-05-05 17:16:55
  from 'C:\xampp\htdocs\tiendaOnline\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5ccefe67c5fc76_88896441',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '829792346dc7a3bffa500a5953f9aab23c1f74cb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\login.tpl',
      1 => 1557056296,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head_header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5ccefe67c5fc76_88896441 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <?php $_smarty_tpl->_subTemplateRender("file:head_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <section>
        <div class="login seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <div class="iniciarSesion col-lg-6 col-md-12 col-sm-12">
                    <form class="formLogin" action='login.php' method='post'>
                        <h2>Iniciar sesión</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        <div><span class='error'><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
Mensaje</span></div>
                        <div class='campo'>
                            <label>Correo:</label><br/>
                            <input class="inputData" type='text' name='correo' value='luciafffernandez@gmail.com' maxlength="50" /><br/>
                        </div>
                        <div class='campo'>
                            <label>Contraseña:</label><br/>
                            <input class="inputData" type='password' name='pass' value='user1' maxlength="50" /><br/>
                        </div>
                        <div class='divSubmit'>
                            <input class="submit" type='submit' name='iniciarSesion' value='Iniciar sesión' />
                        </div>
                    </form>
                </div>
                <div class="registrarse col-lg-6 col-md-12 col-sm-12">
                    <form class="formLogin" action='login.php' method='post'>
                        <h2>Registrarse</h2>
                        <div><span class='error'><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
Mensaje</span></div>
                        <div class='campo'>
                            <label>Nombre:</label><br/>
                            <input class="inputData" type='text' name='name' value='Lucía' maxlength="50" /><br/>
                        </div>
                        <div class='campo'>
                            <label>Apellidos:</label><br/>
                            <input class="inputData" type='text' name='apellidos' value='Fernández Ulibarrena' maxlength="50" /><br/>
                        </div>
                        <div class='campo'>
                            <label>Correo:</label><br/>
                            <input class="inputData" type='text' name='correo' value='luciafffernandez@gmail.com' maxlength="50" /><br/>
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
                            <input class="submit" type='submit' name='crearUsuario' value='Crear usuario' />
                        </div>
                    </form>
                </div>
            </fieldset>
            <section class="separacion"></section>
        </div>
    </section>
    <?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</html><?php }
}
