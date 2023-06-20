<div class="mb-3">
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

    // HELPERS DE SEGUNDA TABLA 

    function crearTabla2(){
      echo  "
        <table class='table table-border mb-5'>
          <colgroup>
            <col style='width: 25%;'>
            <col style='width: 25%;'>
          </colgroup>
          <thead>
            <tr class='bg-info'>
              <th>Editorial</th>
              <th>Total de Registros</th>
            </tr>
          </thead>
          <tbody>
      ";
    }

    function agregarFila2($arreglo, $totalRegistros){
      echo "
        <tr>
          <td>{$arreglo}</td>
          <td>{$totalRegistros}</td>
        </tr>
      ";
    }

    // Count ,contabiliza la cantidad de registros  objeto
    if (count($datos) > 0) {
      $casaActual = $datos[0]["race"];
      
      // Creamos la primera tabla/cabecera
      crearTabla($casaActual);
      $contador = 0;
      foreach ($datos as $registro) {
        if ($casaActual == $registro["race"]) {
          // Agregamos la tabla actual
          agregarFila($registro);
          $contador++;
        }else {
          // Cerrar la tabla anterio , crear una nueva ,actualizar la $casaActual
          $casaActual = $registro['race'];
          cerrarTabla($contador);
          $contador = 0;
          crearTabla($casaActual);

          // Agregamos los registros a la nueva tabla
          agregarFila($registro);
          $contador++;
        }
      }
      cerrarTabla($contador);

      // Tabla de razas
      $contadorSPH = 0;

      // Se crea objeto para almacenar el conteo de las razas
      $razas = array();
      foreach ($datos as $registro) {
        $entrada = $registro['race'];
        $razas[] = $entrada;
        $contadorSPH++;
      }
      // Acá básicamente separmos los nombres de las razas ,y nos aseguramos que no se repitan
      $razaUnica = array_unique($razas);
      
      // Otro objeto para contar registros por raza
      $registrosPorRaza = array();

      foreach ($datos as $registro) {
        $raza = $registro['race'];
        // Si ya existe un registro por la raza,se incrementa el marcador
        if (isset($registrosPorRaza[$raza])) {
          // Acá ya estan las cantidades de registros por raza
          $registrosPorRaza[$raza]++;
        } else {
          // Sino existe ,se crea un valor de 1
          $registrosPorRaza[$raza] = 1;
        }
      }

      crearTabla2();
      foreach ($razaUnica as $raz) {
        // Se almacenan los registros por raza en registros
        $registros = $registrosPorRaza[$raz];
        agregarFila2($raz, $registros);
      }

      cerrarTabla($contadorSPH);

    

    }else{
      echo "<h3> class='mt-3'>No encontramos registros</h3>";
    }
    
  ?>
</div>
