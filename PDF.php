<?php

require('fpdf/fpdf.php');

class PDF extends FPDF {

    // Cabecera de página
    function Header() {
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, 'FACTURA', 1, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    function tablaBasica1($header, $arrayProductos) {
        //Cabecera
        foreach ($header as $col) {
            $this->Cell(40, 7, $col, 1);
        }
        $this->Ln();
        //filas con los datos
        foreach ($arrayProductos as $cod => $prod) {
            $this->Cell(40, 7, $cod, 1);
            $this->Cell(40, 7, $prod[0], 1);
            $this->Cell(40, 7, $prod[1], 1);
            $this->Ln();
        }
        $this->Ln();
    }

    function tablaBasica2($header2, $cantidad, $total) {
        $this->Cell(40, 7, $header2[0], 1);
        $this->Cell(40, 7, $cantidad, 1);
        $this->Ln();
        $this->Cell(40, 7, $header2[1], 1);
        $this->Cell(40, 7, $total, 1);
        $this->Ln();
        $this->Cell(40, 7, $header2[2], 1);
        $this->Cell(40, 7, $total * 0.21, 1);
        $this->Ln();
        $this->Cell(40, 7, $header2[3], 1);
        $this->Cell(40, 7, $total + $total * 0.21, 1);
    }

    // Pie de página
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

?>