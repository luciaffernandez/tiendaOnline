<?php
/* Smarty version 3.1.33, created on 2019-05-20 10:08:56
  from 'C:\xampp\htdocs\tiendaOnline\template\tienda.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5ce2609883f156_75084558',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '561450dff4e35e7926e0df2239626d3f89d0a8d7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\template\\tienda.tpl',
      1 => 1558339734,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head_header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5ce2609883f156_75084558 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <?php $_smarty_tpl->_subTemplateRender("file:head_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <section class="seccionMargenes text-center my-5">
        <div class="row contenedorProductos">
            <?php echo $_smarty_tpl->tpl_vars['listado']->value;?>

        </div>
    </section>
    <?php echo $_smarty_tpl->tpl_vars['debug']->value;?>

    <form action="login.php" method="POST" class="text-center my-5">
        <input class="btn btn-red" type="submit" name="desconectar" value="Desconectar">
        <input class="btn btn-red" type="submit" name="eliminarCuenta" value="Eliminar cuenta">
    </form>
    <?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
</html><?php }
}
