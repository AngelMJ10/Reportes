<?php

require_once '../models/Alignment.php';
require '../tools/helpers.php';

$alignment = new Alignment();

if (isset($_GET['operacion'])) {
  $alignment = new Alignment();

  if ($_GET['operacion'] == 'listar') {
    renderJSON($alignment->listAlignment());
  }
}

?>