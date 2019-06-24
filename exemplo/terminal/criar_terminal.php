<?php
require_once(dirname(__FILE__) . '/../../src/Trafegus.php');
require_once(dirname(__FILE__) . '/../../src/Motorista.php');
require_once(dirname(__FILE__) . '/../../src/Terminal.php');
require_once(dirname(__FILE__) . '/../../src/Posicao.php');
require_once(dirname(__FILE__) . '/../../src/CURL.php');

use WR\Trafegus\Trafegus;
use WR\Trafegus\Terminal;

//Credencial para Homologação
$hostApi = 'http://144.22.108.228/ws_prestor/public/api/';
$authorizationRestApiKey = 'GG:1';

//Criando um Terminal/Dispositivo
$api = new Trafegus($hostApi, $authorizationRestApiKey);
$retorno = $api->terminal->setIdentificador('777777777')
    ->setVersao(8)
    ->create();

print_r($retorno);