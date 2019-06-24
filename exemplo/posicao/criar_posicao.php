<?php
require_once(dirname(__FILE__) . '/../../src/Trafegus.php');
require_once(dirname(__FILE__) . '/../../src/Motorista.php');
require_once(dirname(__FILE__) . '/../../src/Terminal.php');
require_once(dirname(__FILE__) . '/../../src/Posicao.php');
require_once(dirname(__FILE__) . '/../../src/CURL.php');

use WR\Trafegus\Trafegus;
use WR\Trafegus\Posicao;

//Credencial para Homologação
$hostApi = 'http://144.22.108.228/ws_prestor/public/api/';
$authorizationRestApiKey = 'GG:1';

//Criando um Terminal/Dispositivo
$api = new Trafegus($hostApi, $authorizationRestApiKey);
$retorno = $api->posicao->setTerminal('50167')
    ->setVersao(8)
    ->setData('2019-06-23 23:47:00')
    ->setLatitude('-27.0956344000')
    ->setLongitude('-52.6174508000')
    ->setCache('1')
    ->create();

print_r($retorno);