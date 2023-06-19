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

    </div>

  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const buscador = document.querySelector("#buscartxt");
      const btnBuscar = document.querySelector("#buscar");
      const lista = document.querySelector("#razas");
      const listaSelect = document.querySelector("#raza-selected");
      const tabla = document.querySelector("#tabla-superhero tbody");
      const idsrace = [];

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
        }
      }
      
      

      listRaces();
      lista.addEventListener("change", getRaces);
    });

  </script>

</body>

</html>