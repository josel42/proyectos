<?php

require('fpdf186/fpdf.php');

function conectarBaseDeDatos()
{
    $conexion = new mysqli("localhost", "root", "", "papeleria");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    return $conexion;
}

function generarPDF()
{
    // Crear instancia de FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Agregar contenido al PDF (personalizar según sea necesario)
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Factura');
    $pdf->Ln(10);

    // Obtener los datos de la factura y agregarlos al PDF
    $conexion = conectarBaseDeDatos();

    $sqlFactura = "SELECT * FROM factura";
    $resultadoFactura = $conexion->query($sqlFactura);

    // Inicializar el contador de factura
    $contadorFactura = 1;

    while ($filaFactura = $resultadoFactura->fetch_assoc()) {
        $pdf->Cell(0, 10, 'No. Factura: ' . $contadorFactura, 0, 1);
        $pdf->Cell(0, 10, 'Nombre Usuario: ' . $filaFactura['nombreUsuario'], 0, 1);
        $pdf->Cell(0, 10, 'Correo: ' . $filaFactura['correo'], 0, 1);
        $pdf->Cell(0, 10, 'Nombre Producto: ' . $filaFactura['nombreProducto'], 0, 1);
        $pdf->Cell(0, 10, 'Precio: ' . $filaFactura['precio'], 0, 1);
        $pdf->Cell(0, 10, 'Cantidad: ' . $filaFactura['cantidad'], 0, 1);
        $pdf->Cell(0, 10, 'Stock: ' . $filaFactura['stock'], 0, 1);
        $pdf->Ln(10);

        // Incrementar el contador de factura
        $contadorFactura++;
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();

    // Salida del PDF
    $pdf->Output('factura.pdf', 'D');
    exit;
}

// Llamada a la función para generar el PDF
generarPDF();

?>
