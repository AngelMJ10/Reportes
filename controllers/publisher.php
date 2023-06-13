<?php

require_once '../models/Publisher.php';
require '../tools/helpers.php';

$publisher = new Publisher();

if (isset($_GET['operacion'])) {
  $publisher = new Publisher();

  if ($_GET['operacion'] == 'listar') {
    renderJSON($publisher->listAll());
  }
}

?>