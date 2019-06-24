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

class Motorista
{
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
     * Adicionar Documento
     * @param $cpf_motorista string
     * @return Motorista
     */
    public function setDocumento($cpf_motorista)
    {
        $this->campos['cpf_motorista'] = $cpf_motorista;
        return $this;
    }

    /**
     * Adicionar Nome
     * @param $nome string
     * @return Motorista
     */
    public function setNome($nome)
    {
        $this->campos['nome'] = $nome;
        return $this;
    }

    /**
     * Adicionar DataNascimento
     * @param $data_nasc date dd/mm/yyyy
     * @return Motorista
     */
    public function setDataNascimento($data_nasc)
    {
        $data_nasc = $data_nasc . " 00:00:00";
        $this->campos['data_nasc'] = date("d/m/Y H:i:s", strtotime($data_nasc));
        return $this;
    }

    /**
     * Adicionar Rg
     * @param $rg string
     * @return Motorista
     */
    public function setRg($rg)
    {
        $this->campos['rg'] = $rg;
        return $this;
    }

    /**
     * Adicionar RgUF
     * @param $rg_uf string
     * @return Motorista
     */
    public function setRgUF($rg_uf)
    {
        $this->campos['rg_uf'] = $rg_uf;
        return $this;
    }

    /**
     * Adicionar Cnh
     * @param $nro_cnh string
     * @return Motorista
     */
    public function setCnh($nro_cnh)
    {
        $this->campos['nro_cnh'] = $nro_cnh;
        return $this;
    }

    /**
     * Adicionar CnhCategoria
     * @param $categoria_cnh string
     * @return Motorista
     */
    public function setCnhCategoria($categoria_cnh)
    {
        $this->campos['categoria_cnh'] = $categoria_cnh;
        return $this;
    }

    /**
     * Adicionar CnhValidade
     * @param $validade_cnh date dd/mm/yyyy
     * @return Motorista
     */
    public function setCnhValidade($validade_cnh)
    {
        $validade_cnh = $validade_cnh . " 00:00:00";
        $this->campos['validade_cnh'] = date("d/m/Y H:i:s", strtotime($validade_cnh));
        return $this;
    }

    /**
     * Adicionar CnhUF
     * @param $cnh_uf string
     * @return Motorista
     */
    public function setCnhUF($cnh_uf)
    {
        $this->campos['cnh_uf'] = $cnh_uf;
        return $this;
    }

    /**
     * Adicionar CEP
     * @param $cep string
     * @return Motorista
     */
    public function setCep($cep)
    {
        $this->campos['cep'] = $cep;
        return $this;
    }

    /**
     * Adicionar Logradouro
     * @param $logradouro string
     * @return Motorista
     */
    public function setLogradouro($logradouro)
    {
        $this->campos['logradouro'] = $logradouro;
        return $this;
    }

    /**
     * Adicionar Numero
     * @param $numero string
     * @return Motorista
     */
    public function setNumero($numero)
    {
        $this->campos['numero'] = $numero;
        return $this;
    }

    /**
     * Adicionar Complemento
     * @param $complemento string
     * @return Motorista
     */
    public function setComplemento($complemento)
    {
        $this->campos['complemento'] = $complemento;
        return $this;
    }

    /**
     * Adicionar Bairro
     * @param $bairro string
     * @return Motorista
     */
    public function setBairro($bairro)
    {
        $this->campos['bairro'] = $bairro;
        return $this;
    }

    /**
     * Adicionar Cidade
     * @param $cidade string
     * @return Motorista
     */
    public function setCidade($cidade)
    {
        $this->campos['cidade'] = $cidade;
        return $this;
    }

    /**
     * Adicionar SiglaEstado
     * @param $sigla_estado string
     * @return Motorista
     */
    public function setSiglaEstado($sigla_estado)
    {
        $this->campos['sigla_estado'] = $sigla_estado;
        return $this;
    }

    /**
     * Adicionar Pais
     * @param $pais string
     * @return Motorista
     */
    public function setPais($pais)
    {
        $this->campos['pais'] = $pais;
        return $this;
    }

    /**
     * Adicionar Senha
     * @param $senha string
     * @return Motorista
     */
    public function setSenha($senha)
    {
        $this->campos['senha'] = $senha;
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

        if (empty($this->campos['cpf_motorista'])) throw new TrafegusException;
        if (empty($this->campos['nome'])) $campos['nome'] = VERSAO_MODE_DEVELOPER;
        if (empty($this->campos['data_nasc'])) throw new TrafegusException;
        if (empty($this->campos['rg'])) throw new TrafegusException;
        if (empty($this->campos['rg_uf'])) throw new TrafegusException;
        if (empty($this->campos['nro_cnh'])) throw new TrafegusException;
        if (empty($this->campos['categoria_cnh'])) throw new TrafegusException;
        if (empty($this->campos['validade_cnh'])) throw new TrafegusException;
        if (empty($this->campos['cnh_uf'])) throw new TrafegusException;
        if (empty($this->campos['cep'])) throw new TrafegusException;
        if (empty($this->campos['logradouro'])) throw new TrafegusException;
        if (empty($this->campos['numero'])) throw new TrafegusException;
        if (empty($this->campos['complemento'])) throw new TrafegusException;
        if (empty($this->campos['bairro'])) throw new TrafegusException;
        if (empty($this->campos['cidade'])) throw new TrafegusException;
        if (empty($this->campos['sigla_estado'])) throw new TrafegusException;
        if (empty($this->campos['pais'])) throw new TrafegusException;
        if (empty($this->campos['senha'])) throw new TrafegusException;

        $cadastro = array();
        $cadastro['motorista'][] = $this->campos;

        return $this->curl->post('motorista', $cadastro);
    }
}