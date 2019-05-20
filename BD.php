<?php

class BD {

    private $conexion;
    private $info;
    private $user;
    private $pass;
    private $dns;

    /** Función que recoge los valores necesarios para la creación de un objeto de tipo base de datos
     *  @param type $host
     *  @param type $user
     *  @param type $pass
     *  @param type $bd
     */
    public function __construct($host = "localhost", $user = "root", $pass = "root", $bd = "tienda") {
        $this->user = $user;
        $this->pass = $pass;
        if ($bd === null) {
            $this->dns = "mysql:host=$host";
        } else {
            $this->dns = "mysql:host=$host;dbname=$bd";
        }
        $this->conexion = $this->conectar();
    }

    /** Función que te conecta los objetos BD que se van creando
     *  @return \mysqli devuelve la conexion que es de tipo mysqli
     */
    private function conectar() {
        try {
            $conexion = new PDO($this->dns, $this->user, $this->pass);
        } catch (Exception $e) {
            $this->info = "Error conectando: " . $e->getMessage() . "<br/><strong>Es un problema con las credenciales de conexión a la base de datos.</strong>";
        }
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }

    /** Devolvera un array o un string depende de la consulta que se haga
     * @param string $consulta
     */
    public function consulta($consulta) {
        return $this->conexion->query($consulta);
    }

    /** Función que te devuelve las informacines de los errores que se puedan dar
     * @return string que sera el codigo de info que se generara si no se puede conectar a la base de datos
     */
    function getInfo() {
        return $this->info;
    }

    //cierra la conexion a la base de datos
    public function cerrar() {
        $this->conexion = null;
    }

    /** Funcion que devuelve un array con el resultado de una sentencia sql
     * @param string $consulta que tendrá una sentencia sql
     * @return type array que recogera todas las filas que hemos seleccionado de la base de datos
     */
    public function seleccion(string $consulta): array {
        $campos = [];
        if ($this->conexion == null) {
            $this->conexion = $this->conexion();
        }
        $resultado = $this->conexion->query($consulta);
        while ($filas = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $campos[] = $filas;
        }
        return $campos;
    }

    /** Funcion que devuelve un array con el nombre las columnas de una tabla
     * @param string $nomTabla es el nombre de la tabla cuyos nombres de los campos que quiero
     * @return array con los nombres de las columnas de la tabla
     */
    public function nomCol($nomTabla): array {
        $campos = [];
        if ($this->conexion == null) {
            $this->conexion = $this->conexion();
        }
        $consulta = "select * from $nomTabla";
        $r = $this->conexion->query($consulta);
        $camposObj = $r->fetch(PDO::FETCH_ASSOC);
        foreach ($camposObj as $nomCol => $campo) {
            $campos[] = $nomCol;
        }
        return $campos;
    }

    /** Ejecuta una sentencia que va a modificar la base de datos, es decir, un sentencia update, delete, insert...
     * @param type $sentencia de tipo string que estará escrita en lenguaje sql
     */
    public function ejecutar(string $sentencia) {
        $this->info = NULL;
        if ($this->conexion == NULL) {
            $this->__construct($conexion);
        }
        try {
            $stmt = $this->conexion->prepare($sentencia);
            $stmt->execute();
        } catch (Exception $ex) {
            $this->info = "Error " . $ex->getMessage() . "<br/><hr /> Sentencia erronea.";
        }
    }

    /** Ejecuta una sentencia que va a modificar la base de datos, es decir, un sentencia update, delete, insert...
     * @param type $sentencia de tipo string que estará escrita en lenguaje sql
     */
    public function ejecutarPS(array $datos) {
        $this->info = NULL;
        if ($this->conexion == NULL) {
            $this->__construct($conexion);
        }
        foreach ($datos as $dato => $valores) {
            $sentencia = $valores[sizeof($datos)];
        }
        print_r($sentencia);
//        foreach($datos as $dato => $valor){
//            $consulta->bindParam(1, $cod);
//        }
//        $consulta->bindParam(1, $cod);
//        $consulta->bindParam(2, $pass);
//        $consulta->bindParam(3, $correo);
//        $consulta->bindParam(4, $DNI);
//        try {
//            $stmt = $this->conexion->prepare($sentencia);
//            $stmt->execute();
//        } catch (Exception $ex) {
//            $this->info = "Error " . $ex->getMessage() . "<br/><hr /> Sentencia erronea.";
//        }
    }

    /** Funcion que comprueba que estos datos esten en la base de datos y sean correctos
     * @param string $nombre
     * @param string $pass
     * @return bool. Si esta ese usuario sera true si no false
     */
    public function comprueboUsuario(string $correo, string $pass): bool {
        if ($this->conexion == null) {
            $this->conexion = $this->conectar();
        }
        $sentencia = "SELECT * FROM USUARIOS WHERE correo='" . $correo . "' and password='" . $pass . "'";
        $campos = $this->seleccion($sentencia);
        $prueba = (is_null($campos) || empty($campos)) ? false : true;
        return $prueba;
    }

}
