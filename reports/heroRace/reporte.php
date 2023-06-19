<?php

require '../../vendor/autoload.php';
require '../../models/SuperHero.php';

// Namespaces (espacios de nombres/contenedor de clase)
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exeption\Html2PdfException;
use Spipu\Html2Pdf\Exeption\ExceptionFormatter;
// 13
try {

  $superhero = new SuperHero();
  $datos = $superhero->listByRace(["race_id" => 13]);
  $titulo = "Cyborg";

  $content = "";

  ob_start(); // INICIO

  
  include '../estilos.html';
  include './datos.php';

  $content .= ob_get_clean(); // FIN
  
  // Configuración del archivo PDF
  $html2pdfo = new Html2Pdf('P', 'A4', 'es', true, 'UTF-8', array(15,15,15,15));
  $html2pdfo->writeHTML($content);
  $html2pdfo->output('reporte.pdf');

} catch (Html2PdfException $error) {
  $formatter = new ExceptionFormatter($error);
  echo $formatter->getHtmlMessage();
}

?>