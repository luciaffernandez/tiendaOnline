<?php

class Cesta {

    private $productos = [];
    private $total;

    //Suma las cantidades de los productos y devuelve el número de productos que contiene la cesta
    public function contarProductos() {
        foreach ($this->productos as $producto => $valores) {
            $suma += $valores[0];
        }
        return $suma;
    }

    //calcula a partir del atributo total el IVA proporcional
    public function calculoIVA() {
        $IVA = $this->total * 0.21;
        return $IVA;
    }

    //getters de los atributos de la clase
    public function getProductos() {
        return $this->productos;
    }

    public function getTotal() {
        return $this->total;
    }

    /** Devuelve la cesta con distinto formato según si ya existe o no
     * @return Cesta como objeto o como variable de sesión
     */
    public static function generaCesta() {
        if (isset($_SESSION['cesta'])) {
            return $_SESSION['cesta'];
        } else {
            return new Cesta();
        }
    }

    /** Funcion que construye el contenido de la cesta con HTML 
     * según el contenido del atributo productos
     * @return string con el HTML
     */
    public function mostrarCesta() {
        $contenidoCesta = "";
        if ($this->productos == null || $this->productos == 0) {
            $contenidoCesta .= "<p class='cestaVacia'>No hay productos</p>";
        } else {
            $contenidoCesta = "";
            foreach ($this->productos as $numRef => $valores) {
                $contenidoCesta .= "<li>"
                        . "<span class='item'>"
                        . "<span class='item-left'>"
                        . "<span class='item-info cantidad'>$valores[0]</span>"
                        . "<img src='./img/$valores[3]' alt='' class='imagenCesta'/>"
                        . "<span class='item-info'>"
                        . "<span>$valores[2]</span>"
                        . "<span>$valores[1]€</span>"
                        . "</span>"
                        . "</span>"
                        . "<span class='item-right'>"
                        . "<form action='tienda.php' method='POST'>"
                        . "<input type='hidden' name='numRef' value='$numRef'>"
                        . "<input class='eliminarProdCest' type='submit' name='cestaAccion' value='Eliminar'><br/>"
                        . "</form>"
                        . "</span>"
                        . "</span>"
                        . "</li>";
            }
            $contenidoCesta .= "<li class='divider'></li>"
                    . "<p><span class='total1'>Total:</span><span class='total2'>" . $this->calculoTotal() . "€</span><br/></p>";
        }
        return $contenidoCesta;
    }

    /** Funcion que comprueba si el producto ya existe en el array productos, 
     * si no existe lo añade con sus datos y si sí solo le suma uno a su cantidad
     * @param type $precio
     * @param type $numRef
     */
    public function nuevoProd($precio, $numRef, $nomProd, $imagen1) {
        if ($this->productos[$numRef][0] > 0) {
            $this->productos[$numRef][0] ++;
        } else {
            $this->productos[$numRef][0] = 1;
            $this->productos[$numRef][1] = $precio;
            $this->productos[$numRef][2] = $nomProd;
            $this->productos[$numRef][3] = $imagen1;
        }
    }

    /** Función que comprueba la cantidad de un producto que hay en el array productos 
     * de la cesta y si es mayor que 1 le resta 1, si no el valor mínimo es 1 asique lo elimina
     * @param type $numRef
     */
    public function eliminoProd($numRef) {
        if ($this->productos[$numRef][0] > 1) {
            $this->productos[$numRef][0] --;
            $this->total -= $this->productos[$numRef][1];
        } else {
            unset($this->productos[$numRef]);
        }
    }

    /** calcula el precio total a pagar cogiendo los datos del array productos
     * @return type
     */
    public function calculoTotal() {
        $this->total = 0;
        foreach ($this->productos as $producto => $valores) {
            $cantidad = $valores[0];
            $precio = $valores[1];
            $this->total += ($cantidad * $precio);
        }
        return $this->total;
    }

    //guardamos cesta en una variable de sesion
    public function guardaCesta() {
        $_SESSION['cesta'] = $this;
    }

    //vaciamos cesta
    public function vacia() {
        unset($this->productos);
        unset($this->total);
    }

}
