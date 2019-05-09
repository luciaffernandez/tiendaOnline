<?php
/* Smarty version 3.1.33, created on 2019-05-06 09:02:46
  from 'C:\xampp\htdocs\tiendaOnline\template\sitio.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5ccfdc169dd396_46539280',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8d82f85c01bfc315bb09296b01541278673c2dc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\template\\sitio.tpl',
      1 => 1557126160,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head_header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5ccfdc169dd396_46539280 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <?php $_smarty_tpl->_subTemplateRender("file:head_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php echo $_smarty_tpl->tpl_vars['contenidoCesta']->value;?>

    <?php echo $_smarty_tpl->tpl_vars['debug']->value;?>

    <section class="seccionMargenes text-center my-5">
        <div class="row">
            <?php echo $_smarty_tpl->tpl_vars['listado']->value;?>

        </div>
    </section>
    <?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</body>
</html><?php }
}
