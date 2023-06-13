<?php
require 'Conexion.php';

class SuperHero extends Conexion{

  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listByPublisher($data = []){
    try{
     $consulta = $this->conexion->prepare("CALL spu_superhero_list_pubisher(?)");
     $consulta->execute(array($data['publisher_id']));
     return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function listBadOrGood($data = []){
    try {
      $query ="CALL spu_bad_or_good_superhero(?,?)";
      $consulta = $this->conexion->prepare($query);
      $consulta->execute(array(
        $data['publisher_id'],
        $data['alignment_id']
        ));
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMesage());
    }
  }


}