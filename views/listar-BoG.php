<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
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
      <h3>Super héroes - casa distribuidora</h3>
      <p>Reportes en formato PDF</p>
    </div>

    <!-- Filtro -->
    <div class="row">
      <div class="col-md-12"></div>
        <div class="card">
          <div class="card-header">
            Filtro de casas publicadoras
          </div>
          <div class="card-body">
            <div class="row">
            
              <div class="col-md-5">
                <label for="">Selcciona la editorial</label>
                <select name="casas" id="casas" class="form-select mt-1">
                  <option value="">Seleccione la editorial</option>
                </select>
              </div>

              <div class="col-md-5">
              <label for="">Selcciona el bando</label>
                <select name="bando" id="bando" class="form-select mt-1">
                  <option value="">Seleccione el bando</option>
                </select>
              </div>

              <div class="col-md-2">
                <div class="d-grid">
                  <button type="button" id="generarpdf" class="btn btn-outline-success mb-2">Generar PDF</button>
                  <button type="button" id="generarDatos" class="btn btn-outline-primary">Generar Datos</button>
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
            <col width="30%">
          </colgroup>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nick</th>
              <th>Name</th>
              <th>Raza</th>
              <th>Publisher</th>
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
      const btnDatos = document.querySelector("#generarDatos");
      const btnPDF = document.querySelector("#generarpdf");
      const table = document.querySelector("#tabla-superhero tbody")
      const casas = document.querySelector("#casas");
      const bandos = document.querySelector("#bando")

      function listPublisher(){
        fetch(`../controllers/publisher.php?operacion=listar`)
          .then(respuesta => respuesta.json())
          .then(datos => {
            datos.forEach(element => {
              const optionTag = document.createElement("option")
              optionTag.value = element.id
              optionTag.text = element.publisher_name;
              casas.appendChild(optionTag);
            });
          })
      }

      function listAlignment(){
        fetch(`../controllers/alignment.php?operacion=listar`)
          .then(respuesta => respuesta.json())
          .then(datos => {
            datos.forEach(element => {
              const optionTag = document.createElement("option")
              optionTag.value = element.id
              optionTag.text = element.alignment;
              bandos.appendChild(optionTag);
            });
          })
      }

      function listByPya() {
        const parametros = new URLSearchParams();
        parametros.append("operacion", "listarMalosOBuenos");
        parametros.append("publisher_id", parseInt(casas.value));
        parametros.append("alignment_id", parseInt(bandos.value));
        fetch(`../controllers/superhero.php?${parametros}`)
          .then(respuesta => respuesta.json())
          .then(datos => {
            table.innerHTML= ``;
            const i = 1;
            datos.forEach(element => {
              const tableRow = `
                <tr>
                  <td>${element.id}</td>
                  <td>${element.superhero_name}</td>
                  <td>${element.full_name}</td>
                  <td>${element.race}</td>
                  <td>${element.publisher_name}</td>
                </tr>
              `;
              
              table.innerHTML += tableRow;
            });
          })
      }

      function PDFBuild(){
        const idcasa = parseInt(casas.value);
        const idBando = parseInt(bandos.value);
        if (idcasa > 0) {
          const parametros = new URLSearchParams();
          parametros.append("publisher_id", idcasa);
          parametros.append("alignment_id", idBando);
          // parametros.append("titulo", selectCasas.options[selectCasas.selectedIndex].text)
          window.open(`../reports/BadOrGood/reporte.php?${parametros}`, '_blank');
        }
      }

      listAlignment();
      listPublisher();
      btnDatos.addEventListener("click", listByPya);
      btnPDF.addEventListener("click", PDFBuild);

    })
  </script>

</body>

</html>