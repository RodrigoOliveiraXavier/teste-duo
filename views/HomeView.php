<?php
include_once(__PATH__ . '/includes/header.php');
?>

<body>
  <h2 style="text-align: center;">Teste vaga - DUO STUDIO</h2>
  <hr />
  <div class="container" align="center">
    <div class="table-responsive-lg">
      <table class="table table-hover" width="40%" border="1">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col"><b>Instituição / Nome da Capacitação</b></th>
            <th scope="col"><b>Latitude</b></th>
            <th scope="col"><b>Longitude</b></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count = 0;
          foreach ($arrayJson as $key => $json) {
            $dados = json_decode($json);

            $identificador = $dados->resposta_text;
            $latitude = $dados->latitude;
            $longitude = $dados->longitude;

            $count++;
            echo "
              <tr>
                <th id='row_collumn' scope='row'>$count</th>
                <td>$identificador</td>
                <td>$latitude</td>
                <td>$longitude</td>
              </tr>
            ";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>