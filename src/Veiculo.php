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

class Veiculo
{
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
     * Adiciona placa
     * @param $placa string
     * @return Veiculo
     */
    public function setPlaca($placa)
    {
        $this->campos['placa'] = $placa;
        return $this;
    }

    /**
     * Informa o Tipo de Veiculo
     * @param $tipo_veiculo string - Tipo de veículo. 1 = Carreta; 2 = Cavalo; 3 = Truck; 4 = Moto; 5 = Utilitátio de Carga; 6 = Utilitário de Passeio; 99 = Toco;
     * @return Veiculo
     */
    public function setTipoVeiculo($tipo_veiculo)
    {
        $this->campos['tipo_veiculo'] = $tipo_veiculo;
        return $this;
    }

    /**
     * Informa o Renavam
     * @param $renavam string
     * @return Veiculo
     */
    public function setRenavam($renavam)
    {
        $this->campos['renavam'] = $renavam;
        return $this;
    }

    /**
     * Informa o Chassi
     * @param $chassi string
     * @return Veiculo
     */
    public function setChassi($chassi)
    {
        $this->campos['chassi'] = $chassi;
        return $this;
    }

    /**
     * Informa o Ano de Fabricação
     * @param $ano_fabricacao string
     * @return Veiculo
     */
    public function setAnoFabricacao($ano_fabricacao)
    {
        $this->campos['ano_fabricacao'] = $ano_fabricacao;
        return $this;
    }

    /**
     * Informa a Cidade do Emplacamento - Descricao Cidade emplacamento ou código do IBGE (conforme tabela padrão do IBGE
     * @param $cidade_emplacamento string
     * @return Veiculo
     */
    public function setCidadeEmplacamento($cidade_emplacamento)
    {
        $this->campos['cidade_emplacamento'] = $cidade_emplacamento;
        return $this;
    }

    /**
     * Informa o tipo de Combustivel
     * @param $combustivel string 0 = GASOLINA; 1 = ETANOL; 2 = DIESEL; 3 = FLEX
     * @return Veiculo
     */
    public function setTipoCombustivel($combustivel)
    {
        $this->campos['combustivel'] = $combustivel;
        return $this;
    }

    /**
     * Cria um novo veiculo
     * @param $campos array;
     */
    public function create($campos = null)
    {
        if ($campos != null) $this->campos = $campos;

        if (empty($this->campos['placa'])) throw new TrafegusException;
        if (empty($this->campos['tipo_veiculo'])) throw new TrafegusException;

        $cadastro = array();
        $cadastro['veiculo'][] = $this->campos;

        return $this->curl->post('veiculo', $cadastro);
    }
}