<?php
/**
 * Biblioteca para integração com a Trafegus
 * @author William Reis <william@soggsoft.com.br>
 * @category Core
 * @version 1.0.0
 * @license MIT
 */

namespace WR\Trafegus;

//use WR\Trafegus\Notification;
use WR\Trafegus\Motorista;
use WR\Trafegus\Terminal;
use WR\Trafegus\Posicao;
use WR\Trafegus\CURL;

class Trafegus
{
    //private $notification;
    private $terminal;
    private $motorista;

    public function __construct($host, $authorizationID)
    {
        //$this->notification = new Notification($appID);
        $this->terminal = new Terminal();
        $this->motorista = new Motorista();
        $this->posicao = new Posicao();

        $curl = CURL::getInstance();
        $curl->setHost($host);
        $curl->setAuthorization($authorizationID);
    }

    /**
     * O ID da APP
     * @param $appID string
     */
    private function setAppID($appID)
    {
        $this->terminal->setAppID($appID);
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