<?php

require_once 'Conexion.php';

class Alignment extends Conexion {

  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listAlignment() {
    try {
      $consulta = $this->conexion->prepare("CALL spu_alignment_list()");
      $consulta->execute();
      return $consulta->fetchALL(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

}

?>