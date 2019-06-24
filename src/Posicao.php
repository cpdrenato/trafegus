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

class Posicao
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
     * Adiciona terminal
     * @param $terminal string
     * @return Posicao
     */
    public function setTerminal($terminal)
    {
        $this->campos['terminal'] = $terminal;
        return $this;
    }

    /**
     * Informa a versão
     * @param $versao string
     * @return Posicao
     */
    public function setVersao($versao)
    {
        $this->campos['versao_tecnologia'] = $versao;
        return $this;
    }

    /**
     * Informa a data do registro
     * @param $data date yyyy-mm-dd hh:ii:ss
     * @return Posicao
     */
    public function setData($data_computador_bordo)
    {
        $this->campos['data_computador_bordo'] = $data_computador_bordo;
        return $this;
    }

    /**
     * Informa a latitude
     * @param $latitude string
     * @return Posicao
     */
    public function setLatitude($latitude)
    {
        $this->campos['latitude'] = $latitude;
        return $this;
    }

    /**
     * Informa a longitude
     * @param $longitude string
     * @return Posicao
     */
    public function setLongitude($longitude)
    {
        $this->campos['longitude'] = $longitude;
        return $this;
    }

    /**
     * Informa se existe cache no terminal de envio
     * @param $cache string
     * @return Posicao
     */
    public function setCache($cache)
    {
        $this->campos['prestor_online'] = $cache;
        return $this;
    }

    /**
     * Cria uma nova posicao
     * @param $campos array;
     */
    public function create($campos = null)
    {
        if ($campos != null) $this->campos = $campos;

        if (empty($this->campos['terminal'])) throw new TrafegusException;
        if (empty($this->campos['versao_tecnologia'])) $campos['versao_tecnologia'] = ($this->mode=='production') ? MODE_PRODUCTION : MODE_HOMOLOGATION;
        if (empty($this->campos['data_computador_bordo'])) throw new TrafegusException;
        if (empty($this->campos['latitude'])) throw new TrafegusException;
        if (empty($this->campos['longitude'])) throw new TrafegusException;
        if (empty($this->campos['prestor_online'])) throw new TrafegusException;

        return $this->curl->post('posicao', $this->campos);
    }
}