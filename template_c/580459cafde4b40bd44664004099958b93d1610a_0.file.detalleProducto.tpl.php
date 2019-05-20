<?php
/* Smarty version 3.1.33, created on 2019-05-20 13:56:46
  from 'C:\xampp\htdocs\tiendaOnline\template\detalleProducto.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5ce295feae1003_81479882',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '580459cafde4b40bd44664004099958b93d1610a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\template\\detalleProducto.tpl',
      1 => 1558353405,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head_header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5ce295feae1003_81479882 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <?php $_smarty_tpl->_subTemplateRender("file:head_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <section class="espacioPequeno"></section>
    <section class="row seccionMargenes">
        <div id="contenedor">
            <div id="encabezado">
                <h1><?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</h1>
                <h2>Número de referencia: <?php echo $_smarty_tpl->tpl_vars['numRef']->value;?>
</h2>
                <h2>Precio: <?php echo $_smarty_tpl->tpl_vars['precio']->value;?>
</h2>
                <img class="col-4" src="./img/<?php echo $_smarty_tpl->tpl_vars['imagen1']->value;?>
">
                <img src="./img/<?php echo $_smarty_tpl->tpl_vars['imagen2']->value;?>
">
                <img src="./img/<?php echo $_smarty_tpl->tpl_vars['imagen3']->value;?>
">
            </div>
            <div id="detalle">
                <h2>Características:</h2>
                <p>Descripción: <?php echo $_smarty_tpl->tpl_vars['descripcion']->value;?>
 </p>
                <p>Unidades disponibles: <?php echo $_smarty_tpl->tpl_vars['uniDisp']->value;?>
</p>
                <p>Costes de envío: <?php echo $_smarty_tpl->tpl_vars['costes_envio']->value;?>
</p>
                <p>Dimensiones: <?php echo $_smarty_tpl->tpl_vars['dimensiones']->value;?>
</p>
                <p>Peso: <?php echo $_smarty_tpl->tpl_vars['peso']->value;?>
</p>
                <p>Categoria: <?php echo $_smarty_tpl->tpl_vars['categoria']->value;?>
</p>
            </div>
    </section>
    <section class="row seccionMargenes ">
        <h1 class="text-center col-12">Productos destacados</h1>
        <div class="row contenedorProductos">
            <?php echo $_smarty_tpl->tpl_vars['productosDestacados']->value;?>

        </div>
        <button class="btn-complejo col-lg-3 col-xl-2 col-md-10 col-sm-12 col-xs-12 mx-auto mt-5" onclick="location.href = 'tienda.php'">
            <div class="circle">
                <span class="icon arrow"></span>
            </div>
            <p class="button-text ">TIENDA</p>
        </button>
    </section>

    <section class="espacioPequeno"></section>

    <?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</html><?php }
}
