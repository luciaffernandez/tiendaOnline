<?php
session_start();

if (isset($_POST['areaClientes'])) {
    if (isset($_SESSION['correo']) && isset($_SESSION['pass'])) {
        header("Location:tienda.php");
    } else {
        //sino, esque no nos hemos legueado y nos devuelve al login con un error
        header("Location:login.php?error");
    }
}
