<?php
/* Smarty version 3.1.33, created on 2019-02-25 12:53:10
  from '/var/www/tiendaOnline7/template/ordenador.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c73d7262de6f8_20905172',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'def506f11e00799e117af61a4c0c2cd60f32b18b' => 
    array (
      0 => '/var/www/tiendaOnline7/template/ordenador.tpl',
      1 => 1551093030,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c73d7262de6f8_20905172 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Tienda Online - Lucía</title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>
    <body class="pagdetalleproducto">
        <div id="contenedor">
            <div id="encabezado">
                <h1><?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</h1>
                <h2>Codigo: <?php echo $_smarty_tpl->tpl_vars['codigo']->value;?>
</h2>
            </div>
            <div id="detalle">
                <h2>Caracteristicas:</h2>
                <p>Procesador: <?php echo $_smarty_tpl->tpl_vars['procesador']->value;?>
 </p>
                <p>RAM: <?php echo $_smarty_tpl->tpl_vars['RAM']->value;?>
</p>
                <p>Tarjeta gráfica: <?php echo $_smarty_tpl->tpl_vars['grafica']->value;?>
</p>
                <p>Unidad óptica: <?php echo $_smarty_tpl->tpl_vars['optica']->value;?>
</p>
                <p>Sistema operativo: <?php echo $_smarty_tpl->tpl_vars['SO']->value;?>
</p>
                <p>Otros: <?php echo $_smarty_tpl->tpl_vars['otros']->value;?>
</p>
                <p>PVP: <?php echo $_smarty_tpl->tpl_vars['PVP']->value;?>
</p>
                <h2>Descripcion:</h2>
                <p>Características:<?php echo $_smarty_tpl->tpl_vars['descripcion']->value;?>
</p>
            </div>
            <br class="divisor"/>
            <div id="pie">
                <form action='sitio.php' method='post'>
                    <input type='submit' name='desconectar' value='Cerrar ventana'/>
                </form>
            </div>
        </div>
    </body>
</html><?php }
}
