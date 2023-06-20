<?php

require '../../vendor/autoload.php';
require '../../models/Race.php';

// Namespaces (espacios de nombres/contenedor de clase)
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exeption\Html2PdfException;
use Spipu\Html2Pdf\Exeption\ExceptionFormatter;
// 13
try {

  $race = new Race();
  $datos = $race->buscarRace(["race_ids" => "1,3"]);
  $titulo = "Cyborg";

  $content = "";

  ob_start(); // INICIO

  
  include '../estilos.html';
  include '../razas/datos.php';

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