<?php
/**
 * Biblioteca para integração com a Trafegus
 * @author William Reis <william@soggsoft.com.br>
 * @category Library
 * @version 1.0.0
 * @license MIT
 * @link http://monitoramento.grglobal.com.br/ws_rest/documentacao_trafegus
 */

namespace WR\Trafegus;

use WR\Trafegus\Exception\TrafegusException;

class Terminal
{
    // ENUMS //
    const VERSAO_MODE_PRODUCTION = 6672;
    const VERSAO_MODE_DEVELOPER = 8;

    /**
     * Objeto que irá enviar as requisições
     * @access private
     * @var CURL
     */
    private $curl;

    private $campos = array();

    public function __construct()
    {
        $this->curl = CURL::getInstance();
    }

    /**
     * Adiciona o UUID do dispotivo
     * @param $id string
     * @return Terminal
     */
    public function setIdentificador($id)
    {
        $this->campos['identificador'] = $id;
        return $this;
    }

    /**
     * Informa a versão
     * @param $versao string
     * @return Terminal
     */
    public function setVersao($versao)
    {
        $this->campos['versao_tecnologia'] = $versao;
        return $this;
    }

    /**
     * Cria um novo dispositivo
     * @param $campos array;
     * @uses $api->device->addTag('info', 'teste')->create('69aeecc1-7b58-44d1-8000-7767de437adf');
     */
    public function create($campos = null)
    {
        if ($campos != null) $this->campos = $campos;

        if (empty($this->campos['identificador'])) throw new TrafegusException;
        if (empty($this->campos['versao_tecnologia'])) $campos['versao_tecnologia'] = VERSAO_MODE_DEVELOPER;

        return $this->curl->post('aparelho', $this->campos);
    }
}