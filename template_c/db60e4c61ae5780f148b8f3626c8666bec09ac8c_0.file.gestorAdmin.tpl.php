<?php
/* Smarty version 3.1.33, created on 2019-05-30 13:22:02
  from 'C:\xampp\htdocs\tiendaOnline\template\gestorAdmin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cefbcda69e214_67654131',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'db60e4c61ae5780f148b8f3626c8666bec09ac8c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\template\\gestorAdmin.tpl',
      1 => 1559215320,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head_header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5cefbcda69e214_67654131 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <?php $_smarty_tpl->_subTemplateRender("file:head_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <section>
        <div class="perfil seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <div >
                    <h1 class="text-center">Gestor de la web</h1>
                    <p class="text-center">Bienvenido de nuevo administrador</p>
                    <form method="post" action="perfil.php" class="col-12 text-center">
                        <input type="submit" name="botonDatos" class="btn btn-red botonesPago mx-3" value="Productos">
                        <input type="submit" name="botonDatos" class="btn btn-red botonesPago mx-3" value="Mensajes">
                        <input type="submit" name="botonDatos" class="btn btn-red botonesPago mx-3" value="Incidencias">
                        <input type="submit" name="botonDatos" class="btn btn-red botonesPago mx-3" value="Pedidos">
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
