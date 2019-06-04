<?php
/* Smarty version 3.1.33, created on 2019-06-03 13:17:26
  from 'C:\xampp\htdocs\tiendaOnline\template\formProducto.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cf501c6d6fdc2_81490722',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c531bd852408224411204ae3f61b6319c3eaf9a2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\template\\formProducto.tpl',
      1 => 1559558967,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head_header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5cf501c6d6fdc2_81490722 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <?php $_smarty_tpl->_subTemplateRender("file:head_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <section>
        <div class="perfil seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <div class="registrarse col-12 px-auto">
                    <h3 class="text-center text-uppercase my-4">Formulario de productos</h3>
                    <form action="formProducto.php" role="form" method="post" class="formLogin mx-auto row" id="formContact" enctype="multipart/form-data">
                        <?php echo $_smarty_tpl->tpl_vars['formulario']->value;?>

                        <div class='text-center mx-auto'>
                            <input type="submit" value='<?php echo $_smarty_tpl->tpl_vars['btn']->value;?>
' name='enviar' class='btn btn-red botonesPago mx-3'>
                            <input type="submit" value="Cancelar" name='enviar' class='btn btn-red botonesPago mx-3'>
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
