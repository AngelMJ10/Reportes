<div class="mb-3">
  <h2 class="text-lg mb-3 center"><?= $titulo ?></h2>
  <h2 class="text-md mb-3">Super Heroes</h2>
</div>
<hr>
<div>
  <table class="table table-border">
    <colgroup>
      <col style="width: 5%;">
      <col style="width: 20%;">
      <col style="width: 30%;">
      <col style="width: 15%;">
      <col style="width: 15%;">
      <col style="width: 15%;">
    </colgroup>
    <thead>
      <tr class="bg-info">
        <th>ID</th>
        <th>Nick</th>
        <th>Nombre</th>
        <th>C. ojos</th>
        <th>C. cabellos</th>
        <th>C. piel</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($datos as $registro): ?>
        <tr>
          <td><?= $registro['id'] ?></td>
          <td><?= $registro['superhero_name'] ?></td>
          <td><?= $registro['full_name'] ?></td>
          <td><?= $registro['eye_colour'] ?></td>
          <td><?= $registro['hair_colour'] ?></td>
          <td><?= $registro['skin_colour'] ?></td>
        </tr>
      <?php endforeach?>
    </tbody>
  </table>
</div>