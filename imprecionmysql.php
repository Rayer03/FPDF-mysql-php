<?php


require('FPDF/fpdf.php'); // ubicacion de la libreria FPDF

//mismo ejemplo que fpdf nada cambio

class PDF extends FPDF
{
    // Cargar los datos

    function Header()
    {
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(50);
        // T�tulo
        $this->Cell(100,10,'Formato de Instalacion',1,0,'C');
        // Salto de l�nea
        $this->Ln(20);
    }


    // Tabla simple
    function BasicTable($header, $data)
    {
        // Cabecera
        foreach($header as $col)
            $this->Cell(45,7,$col,1);
        $this->Ln();
        // Datos
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(45,6,$col,1);
            $this->Ln();
        }
    }
    

}

include("conexion.php"); // tu conexion

// query para jalar la info de tus tablas

    $sql3 = "SELECT * FROM Productos";
    $result3 = $link->query($sql3);

$pdf = new PDF();
// Títulos de las columnas
$header = array('columna 1', 'columna 2', 'columna 3', 'columna 4'); //se puede extener mas se tendria que cambiar las medidas para ajustar

/*  con este tipo de array introducimos cada celda con un while y jala la info en el formato 
que se requerie para poder mostrar segun el ejemplo de fpdf que jala la info desde un archivo texto*/

$data = array();
    while($row3 = $result3->fetch_assoc()) 
        {
            $data[] = array($row3["tu columna"], $row3["tu columna"], $row3["tu columna"], $row3["tu columna"]);
        }   
        
$pdf->AddPage();
$pdf->SetFont('Arial','',14);
$pdf->BasicTable($header,$data);
$pdf->Output();



 

?>