<!doctype html>
<html lang="en">

<head>
  <title>Listar por Razas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>

<body>
  <div class="container">

    <!-- Cabecera -->
    <div class="row mt-3">
      <h3>Superheroes - Organizado por Razas</h3>
      <p>Reportes en formato PDF</p>
    </div>

    <!-- Filtro -->
    <div class="row">
        <div class="card">
          <div class="card-header bg-info">
            Filtro de razas
          </div>
          <div class="card-body">
            <div class="row">
            
              <div class="col-md-10">
                <select name="casas" id="razas" class="form-select">
                  <option value="">Seleccione</option>
                </select>
              </div>

              <div class="col-md-2">
                <div class="d-grid">
                  <button type="button" id="generarpdf" class="btn btn-outline-success">Generar PDF</button>
                </div>
              </div>

            </div> <!-- Fin de body -->
          </div>
        </div> <!-- Fin de Card -->
      </div>

      <!-- Datos - tabla -->
    <div class="row mt-3">
      <div class="col-md-12">
        <table id="tabla-superhero" class="table table-sm table-striped">
          <colgroup>
            <col width="5%">
            <col width="20%">
            <col width="30%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
          </colgroup>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nick</th>
              <th>Nombre</th>
              <th>Casa</th>
              <th>Alineacion</th>
              <th>Estatura</th>
            </tr>
          </thead>
          <tbody>
            <!-- Asíncrono -->
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const selectedRazas = document.querySelector("#razas");
      const tabla = document.querySelector("#tabla-superhero tbody")
      const btnGenerar = document.querySelector("#generarpdf");
    
      function listRaces(){
        fetch(`../controllers/race.php?operacion=listar`)
          .then(respuesta => respuesta.json())
          .then(datos=> {
            datos.forEach(element=>{
              const tagOption = document.createElement("option");
              tagOption.value = element.id;
              tagOption.text = element.race;
              selectedRazas.appendChild(tagOption);
            })
          })
      }

      function getRaces() {
        const param = new URLSearchParams();
        param.append("operacion", "listarRace");
        param.append("race_id", selectedRazas.value);

        fetch(`../controllers/superhero.php?${param}`)
          .then(respuesta => respuesta.json())
          .then(datos => {
            tabla.innerHTML = ``;
            datos.forEach(element=>{
              const registro = `
              <tr>
                <td>${element.id}</td>  
                <td>${element.superhero_name}</td>  
                <td>${element.full_name}</td>  
                <td>${element.publisher_name}</td>  
                <td>${element.alignment}</td>  
                <td>${element.height_cm}</td>  
              </tr>
              `;
              tabla.innerHTML += registro;
            })
          });
      }
      
      function PDFBuild(){
        const idraza = parseInt(selectedRazas.value);
        if (idraza > 0) {
          const parametros = new URLSearchParams();
          parametros.append("race_id", idraza);
          window.open(`../reports/listByRace/reporte.php?${parametros}`, '_blank');
        }
        // window.location.href = '../reports/heropublisher/reporte.php?publisher_id='+ selectCasas.value;
      }

      listRaces();
      selectedRazas.addEventListener("change" ,getRaces);
      getRaces();
      btnGenerar.addEventListener("click", PDFBuild);
    })
  </script>

</body>

</html>