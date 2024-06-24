<?php
require('fpdf/fpdf.php');

// Verificar si se recibió el nombre del cliente desde el formulario
if(isset($_POST['nombreCliente'])) {
    $nombreCliente = $_POST['nombreCliente'];
} else {
    $nombreCliente = "Cliente no seleccionado";
}

// Crear una clase extendida de FPDF
class PDF extends FPDF
{
    // Cabecera del PDF
    function Header()
    {
        // Logo o título
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, 'Factura', 0, 1, 'C');
        $this->Ln(10);
    }

    // Pie de página del PDF
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear una nueva instancia de la clase PDF
$pdf = new PDF();
$pdf->AddPage();

// Agregar nombre del cliente al PDF
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Cliente: ' . $nombreCliente, 0, 1);
$pdf->Ln(10);

// Agregar la tabla de productos al PDF
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(25, 10, 'ID', 1, 0, 'C');
$pdf->Cell(50, 10, 'Nombre Producto', 1, 0, 'C');
$pdf->Cell(35, 10, 'Precio', 1, 0, 'C');
$pdf->Cell(25, 10, 'Stock', 1, 0, 'C');
$pdf->Cell(60, 10, 'Descripcion', 1, 1, 'C');

// Consultar y mostrar los productos desde la base de datos
include('controllers/conexion.php');

// Crear una nueva conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error al conectar con la base de datos: " . $conexion->connect_error);
}

$consultaProductos = "SELECT * FROM productos";
$resultadoProductos = $conexion->query($consultaProductos);

if ($resultadoProductos->num_rows > 0) {
    while ($producto = $resultadoProductos->fetch_assoc()) {
        $pdf->Cell(25, 10, $producto['idProducto'], 1, 0, 'C');
        $pdf->Cell(50, 10, $producto['nombrePro'], 1, 0, 'C');
        $pdf->Cell(35, 10, '$' . $producto['precioPro'], 1, 0, 'C');
        $pdf->Cell(25, 10, $producto['stockPro'], 1, 0, 'C');
        $pdf->Cell(60, 10, $producto['descripcionPro'], 1, 1, 'C');
    }
} else {
    $pdf->Cell(0, 10, 'No hay productos disponibles', 1, 1, 'C');
}

// Cerrar la conexión a la base de datos
$conexion->close();

// Salida del PDF
ob_clean(); // Limpiar el búfer de salida
$pdf->Output('factura.pdf', 'D');
?>
