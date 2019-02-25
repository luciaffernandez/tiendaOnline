<?php
/* Smarty version 3.1.33, created on 2019-02-25 13:01:15
  from '/var/www/tiendaOnline7/template/cesta.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c73d90ba29a97_29908199',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd076cda4c7aa7ca33e77b36a992bf09b21ce5b40' => 
    array (
      0 => '/var/www/tiendaOnline7/template/cesta.tpl',
      1 => 1551095960,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c73d90ba29a97_29908199 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="cesta">
    <h3><img src="img/cesta.png" alt="Cesta" width="26" height="24">Cesta</h3>
    <hr>
    <?php echo $_smarty_tpl->tpl_vars['contenidoCesta']->value;?>

    <div id="botonesCesta">
        <form action="sitio.php" method="post">
            <input class="cestaAccion" type="submit" name="cestaAccion" value="Pagar" <?php echo $_smarty_tpl->tpl_vars['disabled']->value;?>
>
            <input class="cestaAccion" type="submit" name="cestaAccion" value="Vaciar" <?php echo $_smarty_tpl->tpl_vars['disabled']->value;?>
>
        </form>
    </div>
</div><?php }
}
