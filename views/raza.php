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
                <label for="text" class="form-label">Busque una raza</label>
                <input type="text" class='form-control' id="buscartxt">
              </div>

              <div class="col-md-2">
                <div class="d-grid">
                  <button type="button" id="generarpdf" class="btn btn-outline-success">Generar PDF</button>
                  <button type="button" id="buscar" class="btn btn-outline-primary">Buscar</button>
                </div>
              </div>

            </div> <!-- Fin de body -->
          </div>
        </div> <!-- Fin de Card -->
      </div>

      <!-- Datos - tabla -->
    <div class="row mt-3">

      <div class="col-md-6">
        <select name="casas" id="razas" size="12" class="form-select">
          <option value="">Seleccione</option>
        </select>
      </div>

      <div class="col-md-6">
        <select name="casas" id="raza-selected" size="12" class="form-select">
        </select>
      </div>
    </div>

    <div class="row mt-5">
      <div class="col-md-12">
        <table id="tabla-superhero-race" class="table table-sm table-striped">
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
              <th>Raza</th>
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

  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const buscador = document.querySelector("#buscartxt");
      const btnBuscar = document.querySelector("#buscar");
      const lista = document.querySelector("#razas");
      const listaSelect = document.querySelector("#raza-selected");
      const tabla = document.querySelector("#tabla-superhero-race tbody");
      let  idsrace = [];

      function listRaces() {
        fetch(`../controllers/race.php?operacion=listar`)
          .then(respuesta => respuesta.json())
          .then(datos => {
            datos.forEach(element => {
              const tagOption = document.createElement("option");
              tagOption.value = element.id;
              tagOption.text = element.race;
              lista.appendChild(tagOption);
            });
          });
      }

      function getRaces() {
        const selectedRaceId = lista.value;
        const selectedRaceTxt = lista.options[lista.selectedIndex].text;

        // Verificar si la raza seleccionada ya está en la segunda lista
        const selectedOption = document.querySelector(`#raza-selected option[value="${selectedRaceId}"]`);
        if (!selectedOption) {
          const newOption = document.createElement("option");
          newOption.value = selectedRaceId;
          newOption.text = selectedRaceTxt;
          listaSelect.appendChild(newOption);
          buscador.value += ` -${selectedRaceTxt}`;
          idsrace.push(selectedRaceId);
        }
      }

      function eliminarRazasSeleccionadas() {
        // Se crea un array a partir de los elementos seleccionados en la segunda lista
        const selectedOptions = Array.from(listaSelect.selectedOptions);
        // Array vacío para almacenar los ids
        const selectedIds = [];
        // Array vacío para almacenar los nombres de las razas
        const selectedRaceNames = [];

        // Obtener los IDs y los nombres de las opciones seleccionadas
        for (let i = 0; i < selectedOptions.length; i++) {
          // Se agrega los ids se array actual
          selectedIds.push(selectedOptions[i].value);
          // Se agrega los nombres de la raza al array actual
          selectedRaceNames.push(selectedOptions[i].text.replace(/^\s*-\s*/, ""));
        }

        // Eliminar las opciones seleccionadas de la segunda lista
        for (let i = selectedOptions.length - 1; i >= 0; i--) {
          // Se agrega el valor del ID de la opción actual al array
          listaSelect.removeChild(selectedOptions[i]);
        }

        // Eliminar los IDs de las razas del array idsrace
        // Se filtran los elementos del idsrace,para eliminar los IDS
        idsrace = idsrace.filter(id => !selectedIds.includes(id));

        // Eliminar los nombres de las razas del valor del input
        // Se obtiene el valor actual del input
        const currentInputValue = buscador.value;
        // Se crea nueva variable con el valor inicial del de input
        let updatedInputValue = currentInputValue;

        for (let i = 0; i < selectedRaceNames.length; i++) {
          // Se obtiene el nombre de la raza actual del array
          const raceName = selectedRaceNames[i];
          // Se busca el nombre de la raza para eliminar
          // Se instancia la clase RegExp,para trabajar con expresiones
          // "//b" es para establecer un límite de palabra completa
          // g sirve para poder indicar que la coincidencia debe ser global en todo el texto
          const regex = new RegExp(` -${raceName}\\b`, "g");
          
          // Se reemplaza el valor con replace
          updatedInputValue = updatedInputValue.replace(regex, "");
        }
          buscador.value = updatedInputValue;
      }

      function buscar() {
        const idrazas = idsrace.join(", ");
        const param = new URLSearchParams();
        param.append("operacion", "buscarRace");
        param.append("race_ids", idrazas);
        fetch(`../controllers/race.php?${param}`)
          .then(respuesta => respuesta.json())
          .then(datos => {
            tabla.innerHTML = ``;
            if (datos == "") {
              tabla.innerHTML = "<td><NO HAY DATOS/td>";
            }          
            datos.forEach(element =>{
              
              const registro = `
              <tr>
                <td>${element.id}</td>  
                <td>${element.superhero_name}</td>  
                <td>${element.full_name}</td>  
                <td>${element.race}</td>  
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
        const idraza = parseInt(buscador.value);
        if (idraza > 0) {
          const parametros = new URLSearchParams();
          parametros.append("race_ids", idraza);
          window.open(`../reports/listByRace/reporte.php?${parametros}`, '_blank');
        }
        // window.location.href = '../reports/heropublisher/reporte.php?publisher_id='+ selectCasas.value;
      }

      listRaces();
      lista.addEventListener("change", getRaces);
      listaSelect.addEventListener("change", eliminarRazasSeleccionadas);

      btnBuscar.addEventListener("click", buscar);
      btnGenerar.addEventListener("click", PDFBuild);
    });

  </script>

</body>

</html>