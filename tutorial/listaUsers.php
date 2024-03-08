<?php
require('../fpdf.php');

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 20);
        $this->Cell(0, 10, 'Lista de usuarios', 0, 1, 'C');
        $this->Ln(4); // Salto de línea con desplazamiento vertical de 10 unidades
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    function obtenerDatosUsuario($id) {
        // Simular la obtención de datos de usuario desde la base de datos
        // En una implementación real, esto se obtendría de una consulta a la base de datos
        $usuarios = array(
            1 => array('dni' => '12345678', 'nombre' => 'Juan Perez', 'legajo' => '001'),
            2 => array('dni' => '87654321', 'nombre' => 'María Rodríguez', 'legajo' => '002'),
        );

        // Devolver los datos del usuario si existe, de lo contrario, devolver un array vacío
        return isset($usuarios[$id]) ? $usuarios[$id] : array();
    }
}

$pdf = new PDF();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 10);

// Encabezados de la tabla
$pdf->Cell(30, 10, 'DNI', 1);
$pdf->Cell(30, 10, 'Nombre', 1);
$pdf->Cell(30, 10, 'Legajo', 1);
$pdf->Cell(30, 10, 'puesto', 1);
$pdf->Cell(30, 10, 'categoria', 1);
$pdf->Ln(); // Salto de línea

// Simular la obtención de datos de usuario desde la base de datos
$datosUsuario = $pdf->obtenerDatosUsuario(1);

if (!empty($datosUsuario)) {
    // Llenar la tabla con datos del usuario
    $pdf->Cell(30, 10, $datosUsuario['dni'], 1);
    $pdf->Cell(30, 10, $datosUsuario['nombre'], 1);
    $pdf->Cell(30, 10, $datosUsuario['legajo'], 1);
    $pdf->Ln(); // Salto de línea
} else {
    $pdf->Cell(140, 10, 'Usuario no encontrado.', 1);
    $pdf->Ln(); // Salto de línea
}

$pdf->Output();
?>

