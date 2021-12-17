<?php

//Instancia o arquivo responsavel por iniciar a conexão com o banco
require_once 'init.php';

//Monta o select das Cidades
$cidades = "SELECT resposta_text 
            FROM indicadores_respostas
            WHERE id_secao_item IN 
            (SELECT id FROM indicadores_secoes_itens WHERE titulo = 'Cidade') AND id_indicador = ind_resp.id_indicador)";

//Monta o select da latitude 
$latitude = "SELECT resposta_text,
              id_indicador
              FROM indicadores_respostas
              WHERE id_secao_item IN
              (SELECT id FROM indicadores_secoes_itens WHERE titulo = 'Latitude')";

//Monta o select da longitude
$longitude = "SELECT resposta_text,
              id_indicador
              FROM indicadores_respostas
              WHERE id_secao_item IN
              (SELECT id FROM indicadores_secoes_itens WHERE titulo = 'Longitude')";

//Monta o selecet completo
$query = $conn->prepare("SELECT ind_resp.resposta_text,
              (CASE WHEN ind_itens.titulo = 'Instituição' THEN lat.resposta_text ELSE latitude END) AS latitude,
              (CASE WHEN ind_itens.titulo = 'Instituição' THEN lon.resposta_text ELSE longitude END) AS longitude
              FROM indicadores_secoes_itens ind_itens
              JOIN indicadores_respostas ind_resp ON (ind_resp.id_secao_item = ind_itens.id)
              JOIN indicadores ind ON (ind.id = ind_resp.id_indicador)
              JOIN cidades ON (cidades.cidades_id = ($cidades)
              LEFT JOIN ($latitude) lat ON (lat.id_indicador = ind.id)
              LEFT JOIN ($longitude) lon ON (lon.id_indicador = ind.id)
              WHERE ind_itens.titulo IN ('Instituição', 'Nome da capacitação')
              ORDER BY ind_resp.resposta_text");

//Executa o select e formata os dados em arrays associativos 
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

//Transforma os dados em um array de jsons (Segundo comentado na video chamada)
foreach ($result as $key => $item) {
  $arrayJson[] = json_encode($item, JSON_INVALID_UTF8_SUBSTITUTE | JSON_UNESCAPED_UNICODE);
}

require_once(__PATH__. '/views/HomeView.php');
