<?php
/* Smarty version 3.1.33, created on 2019-05-21 08:25:17
  from 'C:\xampp\htdocs\tiendaOnline\template\detalleProducto.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5ce399cd8d3667_53515477',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '580459cafde4b40bd44664004099958b93d1610a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\template\\detalleProducto.tpl',
      1 => 1558419915,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:head_header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5ce399cd8d3667_53515477 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>
    <?php $_smarty_tpl->_subTemplateRender("file:head_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <section class="espacioPequeno"></section>
    <section class="row seccionMargenes">
        <div class="container">
            <div class="card">
                <div class="container-fliud">
                    <div class="wrapper row">
                        <div class="preview col-md-6">

                            <div class="preview-pic tab-content">
                                <div class="productImg tab-pane active" id="pic-1" style="background-image: url(./img/<?php echo $_smarty_tpl->tpl_vars['imagen1']->value;?>
)"></div>
                                <div class="productImg tab-pane" id="pic-2" style="background-image: url(./img/<?php echo $_smarty_tpl->tpl_vars['imagen1']->value;?>
)"></div>
                                <div class="productImg tab-pane" id="pic-3" style="background-image: url(./img/<?php echo $_smarty_tpl->tpl_vars['imagen1']->value;?>
)"></div>
                            </div>
                        </div>
                        <div class="details col-md-6">
                            <form action='detalleProducto.php' method='post'>
                                <h3 class="product-title"><?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</h3>
                                <h5><?php echo $_smarty_tpl->tpl_vars['categoria']->value;?>
</h5>

                                <p class="product-description"><?php echo $_smarty_tpl->tpl_vars['descripcion']->value;?>
</p>
                                <h4 class="price">Precio: <span><?php echo $_smarty_tpl->tpl_vars['precio']->value;?>
 €</span></h4>
                                <strong>Características</strong>
                                <p>Unidades disponibles: <?php echo $_smarty_tpl->tpl_vars['uniDisp']->value;?>
</br>
                                    Costes de envío: <?php echo $_smarty_tpl->tpl_vars['costes_envio']->value;?>
</br>
                                    Dimensiones: <?php echo $_smarty_tpl->tpl_vars['dimensiones']->value;?>
</br>
                                    Peso: <?php echo $_smarty_tpl->tpl_vars['peso']->value;?>
</br>
                                <div class="action">
                                    <input type='hidden' value='<?php echo $_smarty_tpl->tpl_vars['numRef']->value;?>
' name='numRef'>
                                    <input type='hidden' value='<?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
' name='nomProd'>
                                    <input type='hidden' value='<?php echo $_smarty_tpl->tpl_vars['precio']->value;?>
' name='precio'>
                                    <input type='hidden' value='<?php echo $_smarty_tpl->tpl_vars['imagen1']->value;?>
' name='imagen1'>
                                    <input class='btn btn-red btn-anadir' type='submit' value='Añadir al carrito' name='cestaAccion' <?php echo $_smarty_tpl->tpl_vars['disabled']->value;?>
>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="espacioPequeno"></section>
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
