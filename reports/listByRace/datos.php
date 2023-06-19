<div class="mb-3">
  <h2 class="text-md mb-3">Super Heroes</h2>
</div>
<hr>
<div>
  <table class="table table-border">
    <colgroup>
      <col style="width: 5%;">
      <col style="width: 20%;">
      <col style="width: 25%;">
      <col style="width: 10%;">
      <col style="width: 15%;">
      <col style="width: 15%;">
      <col style="width: 10%;">
    </colgroup>
    <thead>
      <tr class="bg-info">
        <th>ID</th>
        <th>Nick</th>
        <th>Nombre</th>
        <th>Raza</th>
        <th>Editorila</th>
        <th>Bando</th>
        <th>Estatura</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($datos as $registro): ?>
        <tr>
          <td><?= $registro['id'] ?></td>
          <td><?= $registro['superhero_name'] ?></td>
          <td><?= $registro['full_name'] ?></td>
          <td><?= $registro['race'] ?></td>
          <td><?= $registro['publisher_name'] ?></td>
          <td><?= $registro['alignment'] ?></td>
          <td><?= $registro['height_cm'] ?></td>
        </tr>
      <?php endforeach?>
    </tbody>
  </table>
</div>