<div class="mb-3">
  <h2 class="text-lg mb-3 center"><?= $titulo?></h2>
  <h2 class="text-md mb-3 center">Super Heroes</h2>
</div>
<hr>
<div>

  <?php 
  
    // HELPERS
    function crearTabla($casa = ""){
      echo $nuevaTabla = "
        <h4 class='mb-3 center'>{$casa}</h4>
        <table class='table table-border mb-5'>
          <colgroup>
            <col style='width: 10%;'>
            <col style='width: 25%;'>
            <col style='width: 25%;'>
            <col style='width: 20%;'>
            <col style='width: 15%;'>
          </colgroup>
          <thead>
            <tr class='bg-info'>
              <th>ID</th>
              <th>Nick</th>
              <th>Nombre</th>
              <th>Bando</th>
              <th>Estatura</th>
            </tr>
          </thead>
          <tbody>
      ";
    }

    function crearTabla2(){
      echo $nuevaTabla = "
        <table class='table table-border mb-5'>
          <colgroup>
            <col style='width: 25%;'>
            <col style='width: 25%;'>
          </colgroup>
          <thead>
            <tr class='bg-info'>
              <th>Editorial</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
      ";
    }

    function agregarFila2($arreglo,$total){
      echo "
        <tr>
          <td>{$arreglo}</td>
          <td>{$total}</td>
        </tr>
      ";
    }

    function cerrarTabla($total){
      echo $cerrarTabla = "
          </tbody>
          <tfoot>
            <tr>
              <th>Total</th>
              <td>{$total}</td>
            </tr>
          </tfoot>
        </table>
      ";
    }

    function agregarFila($arreglo){
      echo "
        <tr>
          <td>{$arreglo['id']}</td>
          <td>{$arreglo['superhero_name']}</td>
          <td>{$arreglo['full_name']}</td>
          <td>{$arreglo['alignment']}</td>
          <td>{$arreglo['height_cm']}</td>
        </tr>
      ";
    }

    // Count ,contabiliza la cantidad de registros  objeto
    if (count($datos) > 0) {
      $casaActual = $datos[0]["publisher_name"];
      
      // Creamos la primera tabla/cabecera
      crearTabla($casaActual);
      $contador = 0;
      foreach ($datos as $registro) {
        if ($casaActual == $registro["publisher_name"]) {
          // Agregamos la tabla actual
          agregarFila($registro);
          $contador++;
        }else {
          // Cerrar la tabla anterio , crear una nueva ,actualizar la $casaActual
          $casaActual = $registro['publisher_name'];
          cerrarTabla($contador);
          $contador = 0;
          crearTabla($casaActual);

          // Agregamos los registros a la nueva tabla
          agregarFila($registro);
          $contador++;
        }
      }
      cerrarTabla($contador);

      $contadorSPH = 0;
      $contadorPBS = 0;
      
      $editorial = array();
        foreach ($datos as $registro) {
          $entrada = $registro['publisher_name'];
          $editorial[] = $entrada;
          $contadorSPH++;
        }
        $editorialUnica = array_unique($editorial);
        
        crearTabla2();
        foreach ($editorialUnica as $edi) {
          agregarFila2($edi,$contadorSPH);
        }

        cerrarTabla($contadorSPH);
    

    }else{
      echo "<h3> class='mt-3'>No encontramos registros</h3>";
    }
    
  ?>
</div>
