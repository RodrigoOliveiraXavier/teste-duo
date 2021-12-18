<?php
require_once(__PATH__ . '/includes/header.php');
require_once(__PATH__ . '/includes/navbar.php');
?>

<div class="container" align="center">
  <div class="table-responsive-lg">
    <table class="table table-hover" width="40%" border="1">
      <thead id="head-table">
        <tr id='head-row'>
          <th scope="col">#</th>
          <th scope="col"><b>Instituição / Nome da Capacitação</b></th>
          <th scope="col"><b>Latitude</b></th>
          <th scope="col"><b>Longitude</b></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $count = 1;
        foreach ($arrayJson as $key => $json) {
          $dados = json_decode($json);

          $identificador = $dados->resposta_text;
          $latitude = $dados->latitude;
          $longitude = $dados->longitude;

          echo "
              <tr id='row'>
                <th id='collumn' scope='row'>$count</th>
                <td>$identificador</td>
                <td>$latitude</td>
                <td>$longitude</td>
              </tr>
          ";
          $count++;
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
require_once(__PATH__ . '/includes/footer.php');
?>