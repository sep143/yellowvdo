<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Envia uma requisição NVP para uma API PayPal.
 *
 * @param array $requestNvp Define os campos da requisição.
 * @param boolean $sandbox Define se a requisição será feita no sandbox ou no
 *                         ambiente de produção.
 *
 * @return array Campos retornados pela operação da API. O array de retorno poderá
 *               pode ser vazio, caso a operação não seja bem sucedida. Nesse caso,
 *               os logs de erro deverão ser verificados.
 */
class Paypal_refund{
    var $IC;
    function __construct() {
        $this->CI = & get_instance();
    }

function sendNvpRequest(array $requestNvp, $sandbox = false)
{
    //Endpoint da API
    $apiEndpoint  = 'https://api-3t.' . ($sandbox? 'sandbox.': null);
    $apiEndpoint .= 'paypal.com/nvp';
 
    //Executando a operação
    $curl = curl_init();
 
    curl_setopt($curl, CURLOPT_URL, $apiEndpoint);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($requestNvp));
 
    $response = urldecode(curl_exec($curl));
 
    curl_close($curl);
 
    //Tratando a resposta
    $responseNvp = array();
 
    if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
        foreach ($matches['name'] as $offset => $name) {
            $responseNvp[$name] = $matches['value'][$offset];
        }
    }
    
    //Verificando se deu tudo certo e, caso algum erro tenha ocorrido,
    //gravamos um log para depuração.
    if (isset($responseNvp['ACK']) && $responseNvp['ACK'] != 'Success') {
        if ($sandbox)   {
            echo "<html><body><h1>Houve um erro</h1><pre>" . print_r($responseNvp, true) . "</pre></body></html>";
        }
        
        for ($i = 0; isset($responseNvp['L_ERRORCODE' . $i]); ++$i) {
            $message = sprintf("PayPal NVP %s[%d]: %s\n",
                               $responseNvp['L_SEVERITYCODE' . $i],
                               $responseNvp['L_ERRORCODE' . $i],
                               $responseNvp['L_LONGMESSAGE' . $i]);

            error_log($message);
        }
    }
    return $responseNvp;
}
}