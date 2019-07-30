<?php
/**
 * Biblioteca para integração com a Trafegus
 * @author William Reis <william@soggsoft.com.br>
 * @category Core
 * @version 1.0.0
 * @license MIT
 */

namespace WR\Trafegus;

use WR\Trafegus\Terminal;
use WR\Trafegus\Motorista;
use WR\Trafegus\Veiculo;
use WR\Trafegus\Posicao;
use WR\Trafegus\CURL;
use WR\Trafegus\TrafegusException;

class Trafegus
{
    private $terminal;
    private $motorista;
    private $veiculo;
    private $posicao;

    public function __construct($host, $key, $mode = 'homologation')
    {
        $this->terminal = new Terminal($mode);
        $this->motorista = new Motorista($mode);
        $this->veiculo = new Veiculo($mode);
        $this->posicao = new Posicao($mode);

        $curl = CURL::getInstance();
        $curl->setHost($host);
        $curl->setAuthorization($key);
    }

    /**
     * Usa um Getter para permitir recuperar os objetos de notificação e terminal
     */
    public function __get($field)
    {
        if (isset($this->$field))
            return $this->$field;
    }
}