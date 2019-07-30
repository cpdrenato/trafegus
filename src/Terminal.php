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

use \WR\Trafegus\Exception\TrafegusException;

class Terminal
{
    // AMBIENTE
    const MODE_PRODUCTION = 6672;
    const MODE_HOMOLOGATION = 8;

    /**
     * Objeto que irá enviar as requisições
     * @access private
     * @var CURL
     */
    private $curl;

    /**
     * mode
     * @access private
     * @var string
     */
    private $mode;

    private $campos = array();

    public function __construct($mode)
    {
        $this->curl = CURL::getInstance();
        $this->mode = $mode;
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
     * Cria um novo terminal
     * @param $campos array;
     */
    public function create($campos = null)
    {
        if ($campos != null) $this->campos = $campos;
        if (empty($this->campos['identificador'])) throw new TrafegusException;
        if (empty($this->campos['versao_tecnologia'])) $this->campos['versao_tecnologia'] = ($this->mode=='production') ? self::MODE_PRODUCTION : self::MODE_HOMOLOGATION;

        return $this->curl->post('aparelho', $this->campos);
    }
}