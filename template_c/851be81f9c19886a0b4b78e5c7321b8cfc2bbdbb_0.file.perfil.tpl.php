<?php
/* Smarty version 3.1.33, created on 2019-06-04 19:38:57
  from 'C:\xampp\htdocs\tiendaOnline\template\perfil.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cf6acb13370d0_21434197',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '851be81f9c19886a0b4b78e5c7321b8cfc2bbdbb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\template\\perfil.tpl',
      1 => 1559669599,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head_header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5cf6acb13370d0_21434197 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <?php $_smarty_tpl->_subTemplateRender("file:head_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <section>
        <div class="perfil seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <form method="post" action="perfil.php" class="col-12">
                    <div class="col-12">
                        <h3>Datos del usuario</h3>
                        <?php echo $_smarty_tpl->tpl_vars['datosUsuario']->value;?>

                    </div>
                    </br>
                    <?php echo $_smarty_tpl->tpl_vars['formularioEditorUsuario']->value;?>

                    <input type="submit" name="botonDatos" class="btn btn-red botonesPago" value="<?php echo $_smarty_tpl->tpl_vars['textoBoton']->value;?>
">
                </form>
                <section class="separacion"></section>
                <hr>
                <h3>Historial de pedidos</h3>
                <div><?php echo $_smarty_tpl->tpl_vars['historial']->value;?>
</div>
                <hr>
                <form action="login.php" method="POST" class="text-center my-5">
                    <input class="btn btn-red botonesPago" type="submit" name="desconectar" value="Desconectar">
                    <input class="btn btn-red botonesPago" type="submit" name="eliminarCuenta" value="Eliminar cuenta">
                </form>
            </fieldset>
            <section class="separacion"></section>
        </div>
    </section>



    <?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</html><?php }
}
