<?php

// Librería obtenidas COMPOSER
require '../../vendor/autoload.php';

// Namespaces (espacios de nombres/contenedor de clase)
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exeption\Html2PdfException;
use Spipu\Html2Pdf\Exeption\ExceptionFormatter;

// Construción de reporte PDF
try {
  // Contenido (HTML) que vamos a renderizar como PDF
  $content = "";

  // Iniciamos la creación del binario
  ob_start();
  include '../estilos.html';
  include './reporte1.datos.php';

  // Cierre creación de binario
  $content .= ob_get_clean();
  
  // Configuración del archivo PDF
  // P = portrait(Vertical) / L = Landscape(Horizontal)
  $html2pdfo = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(10,10,10,10));
  $html2pdfo->writeHTML($content);
  $html2pdfo->output('reporte.pdf');

} catch (Html2PdfException $error) {
  $formatter = new ExceptionFormatter($error);
  echo $formatter->getHtmlMessage();
}

?>