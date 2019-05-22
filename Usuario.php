<?php

class Usuario {

    private $id;
    private $nombre;
    private $correo;
    private $apellidos;
    private $DNI;
    private $fechaNac;
    private $nombreCompleto;
    private $direccion = [];
    private $tarjeta = [];

    function generaUsuario() {
        if (isset($_SESSION['usuario'])) {
            return $_SESSION['usuario'];
        } else {
            return new Usuario();
        }
    }

    function getNombreCompleto($conexion, $correo) {
        $datos = $conexion->seleccion("SELECT * FROM USUARIOS WHERE correo = '" . $correo . "'");
        foreach ($datos as $dato) {
            $this->nombre = $dato['nombre'];
            $this->apellidos = $dato['apellidos'];
            $this->nombreCompleto = $this->nombre . ' ' . $this->apellidos;
        }
        return $this->nombreCompleto;
    }

    function getID($conexion, $correo) {
        $datos = $conexion->seleccion("SELECT * FROM USUARIOS WHERE correo = '" . $correo . "'");
        foreach ($datos as $dato) {
            $this->id = $dato['id_user'];
        }
        return $this->id;
    }

    function getDNI($conexion, $correo) {
        $datos = $conexion->seleccion("SELECT * FROM USUARIOS WHERE correo = '" . $correo . "'");
        foreach ($datos as $dato) {
            $this->DNI = $dato['dni'];
        }
        return $this->DNI;
    }

    function getDireccion($conexion, $correo) {
        $userIds = $conexion->seleccion("SELECT * FROM USUARIOS WHERE correo = '" . $correo . "'");
        foreach ($userIds as $dato) {
            $this->id = $dato['id_user'];
        }
        $dirIds = $conexion->seleccion("SELECT * FROM VIVE_EN WHERE id_user = '" . $this->id . "'");
        if ($dirIds != null || $dirIds != '') {
            foreach ($dirIds as $dato) {
                $id_dir = $dato['id_dir'];
                $this->direccion[$id_dir];
            }
            $dirIds = $conexion->seleccion("SELECT * FROM DIRECCIONES WHERE id_dir = '" . $id_dir . "'");
            foreach ($dirIds as $dato) {
                $provincia = $dato['provincia'];
                $ciudad = $dato['ciudad'];
                $calle = $dato['calle'];
                $numero = $dato['numero'];
                $piso = $dato['piso'];
                $cod_postal = $dato['cod_postal'];
                $this->direccion[$id_dir][0] = $provincia;
                $this->direccion[$id_dir][1] = $ciudad;
                $this->direccion[$id_dir][2] = $calle;
                $this->direccion[$id_dir][3] = $numero;
                $this->direccion[$id_dir][4] = $piso;
                $this->direccion[$id_dir][5] = $cod_postal;
                return $this->direccion;
            }
        } else {
            $this->direccion[] = false;
        }
        return $this->direccion;
    }


}
