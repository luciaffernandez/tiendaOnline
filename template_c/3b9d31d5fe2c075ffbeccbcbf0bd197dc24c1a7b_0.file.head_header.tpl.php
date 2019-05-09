<?php
/* Smarty version 3.1.33, created on 2019-05-05 13:29:28
  from 'C:\xampp\htdocs\tiendaOnline\head_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5ccec9186f7157_50178476',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b9d31d5fe2c075ffbeccbcbf0bd197dc24c1a7b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\tiendaOnline\\head_header.tpl',
      1 => 1557055589,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ccec9186f7157_50178476 (Smarty_Internal_Template $_smarty_tpl) {
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
        <nav class="redesSociales">
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
                    <li class="nav-item active"><a class="nav-link" href="#">Inicio</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span>Sobre nosotros</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span>Galería</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span>Sección</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span>Contacto</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="#"><span>Blog</span></a></li>
                </ul>
                <form class="form-inline">
                    <input type="search" class="form-control mr-2 col-sd-6" placeholder="Buscar">
                    <button type="submit" class="btn btn-outline-success my-2 col-sd-6">Enviar</button>
                </form>
            </div>
        </nav>
    </header><?php }
}
