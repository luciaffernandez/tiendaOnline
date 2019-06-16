<?php
/* Smarty version 3.1.33, created on 2019-06-16 23:03:22
  from 'C:\xampp\htdocs\tiendaOnline\template\gestor.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5d06ae9a947b66_37333693',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f70a9c6f03ccc664c192cd228ddb8c310f78e93d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\template\\gestor.tpl',
      1 => 1560718974,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head_header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5d06ae9a947b66_37333693 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <?php $_smarty_tpl->_subTemplateRender("file:head_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <section>
        <div class="perfil seccionMargenes">
            <section class="separacion"></section>
            <fieldset class="cajaLogin">
                <div>
                    <h3 class="text-center text-uppercase my-4">Gestor de <?php echo $_smarty_tpl->tpl_vars['gestor']->value;?>
</h3>
                    <?php echo $_smarty_tpl->tpl_vars['tabla']->value;?>

                </div>
            </fieldset>
            <section class="separacion"></section>
        </div>
    </section>
    <?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</html><?php }
}
