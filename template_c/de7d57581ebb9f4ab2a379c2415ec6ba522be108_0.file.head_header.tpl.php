<?php
/* Smarty version 3.1.33, created on 2019-05-15 19:39:01
  from 'C:\xampp\htdocs\tiendaOnline\template\head_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5cdc4eb5ef0457_92220988',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'de7d57581ebb9f4ab2a379c2415ec6ba522be108' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\template\\head_header.tpl',
      1 => 1557941939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5cdc4eb5ef0457_92220988 (Smarty_Internal_Template $_smarty_tpl) {
?><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Tienda Online - Lucía</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <header class="site-header">
        <nav class="redesSociales fondoBlanco">
            <a href="www.facebook.com" target="_blank"><img src="img/facebook.png"/></a>
            <a href="www.instagram.com" target="_blank"><img src="img/instagram.png"/></a>
            <a href="www.twitter.com" target="_blank"><img src="img/twitter.png"/></a
            <a href="www.google+.com" target="_blank"><img src="img/google-plus.png"/></a>
        </nav>
        <nav class="navbar navbar-expand-xl navbar-dark justify-content-between bg-dark menuPrincipal">
            <!--Las rutas hacia las imagenes y demás las pondremos con directorios dinámicos,
                para que no de problema el tener otro tipo de estructura de carpetas-->
            <a href="#"><img src="img/logo.png" class="logo"/></a>
            <div class="navbar-header">
                <button button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <a class="hamburger" href="#">
                        <span class="white-text"><i class="fas fa-bars fa-1x"></i></span>
                    </a>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a class="nav-link" href="http://localhost/tiendaOnline/home.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Sobre nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://localhost/tiendaOnline/tienda.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contacto</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right" >
                    <?php echo $_smarty_tpl->tpl_vars['carrito']->value;?>

                    <form action="head_header.php" method="post">
                        <button formmethod="post" name="areaClientes" role="button" aria-expanded="false"><i class="fas fa-user white-text iconosNav areaClientes"></i></span></button>
                    </form>
                </ul>
            </div>
        </nav>
    </header><?php }
}
