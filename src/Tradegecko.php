<?php

namespace Brizido\Tradegecko;

use Brizido\Tradegecko\Domain\Account;
use Brizido\Tradegecko\Domain\Address;
use Brizido\Tradegecko\Domain\Company;

class Tradegecko extends TradegeckoConfig
{

    use Account;
    use Address;
    use Company;
    use Order;

    const API_HOST = 'https://api.tradegecko.com';

    /** @var Response details about the result of the last request */
    private $response;
    /** @var Consumer Tradegecko application details */
    private $consumer;
    /** @var PrivilegedAccessToken|null User access token details */
    private $token;

    /**
     * Constructor
     * Receives the application id and client secret
     *
     * @param $applicationId
     * @param $clientSecret
     */
    public function __construct($applicationId, $clientSecret)
    {
        $this->consumer = new Consumer($applicationId, $clientSecret);
    }

    /**
     * Authorize using an Privileged Access Token
     *
     * @param $accessToken
     */
    public function authorizeFromExisting($accessToken)
    {
        $this->token = new PrivilegedAccessToken($accessToken);
    }

    /**
     * Make GET requests to the API.
     *
     * @param string $path
     * @param array  $parameters
     *
     * @return array|object
     */
    public function get($path, array $parameters = [])
    {
        return $this->http('GET', self::API_HOST, $path, $parameters);
    }

    /**
     * Make POST requests to the API.
     *
     * @param string $path
     * @param array  $parameters
     *
     * @return array|object
     */
    public function post($path, array $parameters = [])
    {
        return $this->http('POST', self::API_HOST, $path, $parameters);
    }

    /**
     * Make PUT requests to the API.
     *
     * @param string $path
     * @param array  $parameters
     *
     * @return array|object
     */
    public function put($path, array $parameters = [])
    {
        return $this->http('PUT', self::API_HOST, $path, $parameters);
    }


    /**
     * Make DELETE requests to the API.
     *
     * @param string $path
     * @param array  $parameters
     *
     * @return array|object
     */
    public function delete($path, array $parameters = [])
    {
        return $this->http('DELETE', self::API_HOST, $path, $parameters);
    }

    /**
     * Resets the last response cache.
     */
    public function resetLastResponse()
    {
        $this->response = new Response();
    }

    /**
     * @param string $method
     * @param string $host
     * @param string $path
     * @param array  $parameters
     *
     * @return array|object
     */
    private function http($method, $host, $path, array $parameters  = [])
    {
        $this->resetLastResponse();
        $url = sprintf('%s/%s', $host, $path);
        $this->response->setApiPath($path);
        $authorization = 'Authorization: Bearer ' . $this->token->getAccessToken();
        $result = $this->request($url, $method, $authorization, $parameters);
        $response = json_decode($result, $this->decodeJsonAsArray);
        $this->response->setBody($response);
        return $response;
    }

    /**
     * Get the header info to store.
     *
     * @param string $header
     *
     * @return array
     */
    private function parseHeaders($header)
    {
        $headers = [];
        foreach (explode("\r\n", $header) as $line) {
            if (strpos($line, ':') !== false) {
                list ($key, $value) = explode(': ', $line);
                $key = str_replace('-', '_', strtolower($key));
                $headers[$key] = trim($value);
            }
        }
        return $headers;
    }

    /**
     * Make an HTTP request
     *
     * @param string $url
     * @param string $method
     * @param string $authorization
     * @param array $postFields
     *
     * @return string
     * @throws TradegeckoException
     */
    private function request($url, $method, $authorization, array $postFields)
    {
        /* Curl settings */
        $options = [
            // CURLOPT_VERBOSE => true,
            CURLOPT_CONNECTTIMEOUT => $this->connectionTimeout,
            CURLOPT_HEADER => true,
            CURLOPT_HTTPHEADER => ['Accept: application/json', $authorization, 'Expect:'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_URL => $url
        ];
        if($this->gzipEncoding) {
            $options[CURLOPT_ENCODING] = 'gzip';
        }
        switch ($method) {
            case 'GET':
                break;
            case 'POST':
                $options[CURLOPT_POST] = true;
                $options[CURLOPT_POSTFIELDS] = http_build_query($postFields);
                break;
            case 'DELETE':
                $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
                break;
            case 'PUT':
                $options[CURLOPT_CUSTOMREQUEST] = 'PUT';
                break;
        }
        if (in_array($method, ['GET', 'PUT', 'DELETE']) && !empty($postFields)) {
            $options[CURLOPT_URL] .= '?' . http_build_query($postFields);
        }
        $curlHandle = curl_init();
        curl_setopt_array($curlHandle, $options);
        $response = curl_exec($curlHandle);
        // Throw exceptions on cURL errors.
        if (curl_errno($curlHandle) > 0) {
            throw new TradegeckoException(curl_error($curlHandle), curl_errno($curlHandle));
        }
        $this->response->setHttpCode(curl_getinfo($curlHandle, CURLINFO_HTTP_CODE));
        $parts = explode("\r\n\r\n", $response);
        $responseBody = array_pop($parts);
        $responseHeader = array_pop($parts);
        $this->response->setHeaders($this->parseHeaders($responseHeader));
        curl_close($curlHandle);
        return $responseBody;
    }
}