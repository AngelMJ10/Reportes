<?php

require '../models/SuperHero.php';
require '../tools/helpers.php';

$superhero = new SuperHero();

if (isset($_GET['operacion'])) {

  if ($_GET['operacion'] == 'listarCasas') {
    renderJSON($superhero->listByPublisher(["publisher_id" => $_GET['publisher_id']]));
  }

  if ($_GET['operacion'] == 'listarMalosOBuenos') {
    renderJSON($superhero->listBadOrGood(
      [
        "publisher_id" => $_GET['publisher_id'],
       "alignment_id" => $_GET['alignment_id']
      ]
    )
  );
  }
}

?>