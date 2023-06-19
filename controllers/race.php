<?php

require_once '../models/Race.php';
require '../tools/helpers.php';

$race = new Race();

if (isset($_GET['operacion'])) {

  if ($_GET['operacion'] == 'listar') {
    renderJSON($race->listAll());
  }

  if ($_GET['operacion'] == 'buscarRace') {
    renderJSON($race->buscarRace(
      [
        "race_ids"  => $_GET['race_ids']
      ]
    ));
  }

}

?>