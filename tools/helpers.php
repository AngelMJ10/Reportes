<?php

// Función renderizar en el VIEW un JSON si el origen NO está activo

function renderJSON($data) {
  if ($data) {
    echo json_encode($data);
  }
}

?>