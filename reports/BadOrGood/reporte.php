<?php

// Utilizaremos fatos del BACKEM (modelo)
// Librería obtenidas COMPOSER
require '../../vendor/autoload.php';

// Paso 1: incorporar modelo
require '../../models/SuperHero.php';

// Namespaces (espacios de nombres/contenedor de clase)
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exeption\Html2PdfException;
use Spipu\Html2Pdf\Exeption\ExceptionFormatter;

try {

  
  // Paso 2: Instancia clase
  $superHero = new SuperHero();

  // Clase 3: Obtener datos (MÉtodo: listByPublisher)
  $datos = $superHero->listBadOrGood(["publisher_id" => $_GET['publisher_id'], "alignment_id" => $_GET['alignment_id']]);
  // Contenido (HTML) que vamos a renderizar como PDF
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