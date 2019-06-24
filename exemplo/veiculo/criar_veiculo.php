<?php
require_once(dirname(__FILE__) . '/../../src/Trafegus.php');
require_once(dirname(__FILE__) . '/../../src/Terminal.php');
require_once(dirname(__FILE__) . '/../../src/Motorista.php');
require_once(dirname(__FILE__) . '/../../src/Veiculo.php');
require_once(dirname(__FILE__) . '/../../src/Posicao.php');
require_once(dirname(__FILE__) . '/../../src/CURL.php');

use WR\Trafegus\Trafegus;
use WR\Trafegus\Veiculo;

//Credencial para Homologação
/*$host = 'http://144.22.108.228/ws_prestor/public/api/'; //Endpoint da API
$key = 'GG:1'; //Usuario:Senha
$mode = 'homologation'; //production (produção) /homologation (homologação)*/

$host = 'http://monitoramento.grglobal.com.br/ws_rest/public/api/'; //Endpoint da API
$key = 'wssogg:grapkglobal'; //Usuario:Senha
$mode = 'production'; //production (produção) /homologation (homologação)

//Envocando a classe trafegus
$api = new Trafegus($host, $key, $mode);

//Definido o metódo Veiculo
$retorno = $api->veiculo->setPlaca('QBV1377')
    ->setTipoVeiculo(2)
    ->setTipoCombustivel(2)
    ->setRenavam('4553534543')
    ->setChassi('5648444')
    ->setAnoFabricacao('2019')
    //->setCidadeEmplacamento('1')
    ->create();

print_r($retorno);