<!DOCTYPE html >
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Tienda Online - Lucía</title>
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>
    <body class="pagdetalleproducto">
        <div id="contenedor">
            <div id="encabezado">
                <h1>{$nombre}</h1>
                <h2>Codigo: {$codigo}</h2>
            </div>
            <div id="detalle">
                <h2>Caracteristicas:</h2>
                <p>Procesador: {$procesador} </p>
                <p>RAM: {$RAM}</p>
                <p>Tarjeta gráfica: {$grafica}</p>
                <p>Unidad óptica: {$optica}</p>
                <p>Sistema operativo: {$SO}</p>
                <p>Otros: {$otros}</p>
                <p>PVP: {$PVP}</p>
                <h2>Descripcion:</h2>
                <p>Características:{$descripcion}</p>
            </div>
            <br class="divisor"/>
            <div id="pie">
                <form action='sitio.php' method='post'>
                    <input type='submit' name='desconectar' value='Cerrar ventana'/>
                </form>
            </div>
        </div>
    </body>
</html>