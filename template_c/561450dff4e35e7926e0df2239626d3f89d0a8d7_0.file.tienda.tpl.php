<?php
/* Smarty version 3.1.33, created on 2019-05-27 20:17:11
  from 'C:\xampp\htdocs\tiendaOnline\template\tienda.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cec29a73214b1_18782742',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '561450dff4e35e7926e0df2239626d3f89d0a8d7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\template\\tienda.tpl',
      1 => 1558981029,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head_header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5cec29a73214b1_18782742 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <?php $_smarty_tpl->_subTemplateRender("file:head_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <section class="seccionMargenes text-center my-5">
        <div class="row contenedorProductos">
            <?php echo $_smarty_tpl->tpl_vars['listado']->value;?>

        </div>
        <div class="espacioPequeno"></div>
    </section>
    <?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
</html><?php }
}
