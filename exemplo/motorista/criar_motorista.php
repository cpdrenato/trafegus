<?php
require_once(dirname(__FILE__) . '/../../src/Trafegus.php');
require_once(dirname(__FILE__) . '/../../src/Motorista.php');
require_once(dirname(__FILE__) . '/../../src/Terminal.php');
require_once(dirname(__FILE__) . '/../../src/Posicao.php');
require_once(dirname(__FILE__) . '/../../src/CURL.php');

use WR\Trafegus\Trafegus;
use WR\Trafegus\Motorista;

//Credencial para Homologação
$hostApi = 'http://144.22.108.228/ws_prestor/public/api/';
$authorizationRestApiKey = 'GG:1';
$modeSystem = 'DEVELOPED';

$api = new Trafegus($hostApi, $authorizationRestApiKey);

//Criando um Terminal/Dispositivo
$retorno = $api->motorista->setDocumento('69371875569')
                ->setNome('WR TESTE')
                ->setDataNascimento('10/10/1984')
                ->setRg('20121033950')
                ->setRgUF('MT')
                ->setCnh('082729201')
                ->setCnhCategoria('AB')
                ->setCnhValidade('10/10/2019')
                ->setCnhUF('MT')
                ->setCep('78028010')
                ->setLogradouro('Rua Fernando Correia')
                ->setNumero('123')
                ->setComplemento('Próximo da Escola')
                ->setBairro('Jardim Paulista')
                ->setCidade('Rondonópolis')
                ->setSiglaEstado('MT')
                ->setPais('Brasil')
                ->setSenha('123123')
                ->create();

print_r($retorno);
