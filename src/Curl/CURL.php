<?php
/**
 * Arquivo com as configurações usadas no webservice
 * @author William Reis
 * @category Library
 * @package Helper
 * @since 1.0.0
 **/

namespace WR\Trafegus;

class CURL
{

    /**
     * Guarda uma instância da classe
     * @access private
     * @var CURL
     */
    private static $instance;

    /**
     * Guarda o Dominio da API
     * @access private
     * @var string
     */
    private $host;

    /**
     * Guarda a chave de autenticação
     * @access private
     * @var string
     */
    private $key;

    /**
     * Impede de criarem uma nova instância da classe
     */
    private function __construct()
    {
    }

    /**
     * Recupera uma instancia de CURL
     * @return CURL
     */
    public static function getInstance()
    {
        static $instance;
        if ($instance == null)
            $instance = new CURL();
        return $instance;
    }

    /**
     * Seta o Host da API
     * @access public
     * @param $host string
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * Seta a chave de autenticação no servidor One Signal
     * @access public
     * @param $key string
     */
    public function setAuthorization($key)
    {
        $this->key = $key;
    }

    /**
     * @access public
     * @param $url string
     * @param $dados array
     * @param $method GET|POST|PUT|DELETE
     * @return json
     */
    protected function openCurl($url, $dados = array(), $method = 'GET')
    {

        if (is_array($dados)) $dados = json_encode($dados);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->host . $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic ' . base64_encode($this->key)
            )
        );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dados);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        switch ($method) {
            case 'POST':
                curl_setopt($ch, CURLOPT_POST, TRUE);
                break;
            case 'PUT':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case 'DELETE':
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
        }
        curl_setopt($ch, CURLOPT_POST, TRUE);


        $response = curl_exec($ch);
        curl_close($ch);

        $retorno = json_decode($response, true);
        return $retorno;
    }

    /**
     * @access public
     * @param $url string
     * @return json
     */
    public function get($url)
    {
        return $this->openCurl($url);
    }

    /**
     * @access public
     * @param $url string
     * @param $dados array()
     * @return json
     */
    public function post($url, $dados = array())
    {
        return $this->openCurl($url, $dados, "POST");
    }

    /**
     * @access public
     * @param $url string
     * @param $dados array()
     * @return json
     */
    public function put($url, $dados = array())
    {
        return $this->openCurl($url, $dados, "PUT");
    }

    /**
     * @access public
     * @param $url string
     * @param $dados array()
     * @return json
     */
    public function delete($url, $dados = array())
    {
        return $this->openCurl($url, $dados, "DELETE");
    }
}
?>