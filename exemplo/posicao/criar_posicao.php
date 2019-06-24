<?php
require_once(dirname(__FILE__) . '/../../src/Trafegus.php');
require_once(dirname(__FILE__) . '/../../src/Terminal.php');
require_once(dirname(__FILE__) . '/../../src/Motorista.php');
require_once(dirname(__FILE__) . '/../../src/Veiculo.php');
require_once(dirname(__FILE__) . '/../../src/Posicao.php');
require_once(dirname(__FILE__) . '/../../src/CURL.php');

use WR\Trafegus\Trafegus;
use WR\Trafegus\Posicao;

//Credencial para Homologação
/*$host = 'http://144.22.108.228/ws_prestor/public/api/'; //Endpoint da API
$key = 'GG:1'; //Usuario:Senha
$mode = 'homologation'; //production (produção) /homologation (homologação)*/

$host = 'http://monitoramento.grglobal.com.br/ws_rest/public/api/'; //Endpoint da API
$key = 'wssogg:grapkglobal'; //Usuario:Senha
$mode = 'production'; //production (produção) /homologation (homologação)

//Envocando a classe trafegus
$api = new Trafegus($host, $key, $mode);

//Definido o metódo Posição
$retorno = $api->posicao->setTerminal('50021')
    //->setVersao(8) //(opcional)
    ->setData('2019-06-23 23:47:00')
    ->setLatitude('-27.0956344000')
    ->setLongitude('-52.6174508000')
    ->setCache('1')
    ->create();

print_r($retorno);