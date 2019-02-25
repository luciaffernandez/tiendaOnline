<?php
/* Smarty version 3.1.33, created on 2019-02-25 12:16:35
  from '/var/www/tiendaOnline7/template/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c73ce937786c4_52172843',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '103827e7fcee0ef7d4e99e69e5621bcdbfa73521' => 
    array (
      0 => '/var/www/tiendaOnline7/template/login.tpl',
      1 => 1551093030,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c73ce937786c4_52172843 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Tienda Online - Lucía</title>
  <link href="tienda.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id='login'>
        <fieldset>
            <legend>Login</legend>
            <form action='login.php' method='post'>
                <div><span class='error'><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</span></div>
                <div class='campo'>
                    <label>Usuario:</label><br/>
                    <input type='text' name='name' value='admin' maxlength="50" /><br/>
                </div>
                <div class='campo'>
                    <label>Contraseña:</label><br/>
                    <input type='password' name='pass' value='admin' maxlength="50" /><br/>
                </div>
                <hr/>
                <div class='campo'>
                    <input type='submit' name='enviar' value='Enviar' />
                </div>
            </form>
        </fieldset>  
    </div>
</body>
</html><?php }
}
