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
            
              <div class="col-md-10">
                <select name="casas" id="casas" class="form-select">
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
              <th>Color de Ojo</th>
              <th>Color de cabello</th>
              <th>Color de Piel</th>
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
      
      const selectCasas = document.querySelector("#casas");
      const btnGenerar = document.querySelector("#generarpdf")
      const table = document.querySelector("#tabla-superhero")
      const body = table.querySelector("tbody");

      function getPublisher(){
        
        // const parametros = new URLSearchParams()
        // parametros.append("operacion", "listar")

        // Se puede insertar "${parametros}" despues de php?,
        // es la forma de como poner los parametros si hacer
        // una larga linea con las claves y valores (GET)
        fetch(`../controllers/publisher.php?operacion=listar`)
          .then(respuesta => respuesta.json())
          .then(datos => {
            datos.forEach(element => {
              const optionTag = document.createElement("option")
              optionTag.value = element.id
              optionTag.text = element.publisher_name;
              selectCasas.appendChild(optionTag);
            });
          })
      }

      function getByPublisher(){
        const parametros = new URLSearchParams();
        parametros.append("operacion", "listarCasas");
        parametros.append("publisher_id", parseInt(selectCasas.value));
        fetch(`../controllers/superhero.php?${parametros}`)
          .then(respuesta => respuesta.json())
          .then(datos => {
            console.log(datos);
            table.innerHTML= ``;
            const i = 1;
            datos.forEach(element => {
              const tableRow = `
                <tr>
                  <td>${element.id}</td>
                  <td>${element.superhero_name}</td>
                  <td>${element.full_name}</td>
                  <td>${element.eye_colour}</td>
                  <td>${element.hair_colour}</td>
                  <td>${element.skin_colour}</td>
                </tr>
              `;
              
              table.innerHTML += tableRow;
            });
          })
      }

      function PDFBuild(){
        const idcasa = parseInt(selectCasas.value);
        if (idcasa > 0) {
          const parametros = new URLSearchParams();
          parametros.append("publisher_id", idcasa);
          parametros.append("titulo", selectCasas.options[selectCasas.selectedIndex].text)
          window.open(`../reports/heropublisher/reporte.php?${parametros}`, '_blank');
        }
        // window.location.href = '../reports/heropublisher/reporte.php?publisher_id='+ selectCasas.value;
      }

      selectCasas.addEventListener("change", getByPublisher);
      btnGenerar.addEventListener("click", PDFBuild);
      // Cuando el documento esté cargado
      getPublisher();

    })
  </script>

</body>

</html>