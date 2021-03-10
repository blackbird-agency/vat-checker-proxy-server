<?php
/*
 * Blackbird Vat Checker Proxy Server
 *
 * NOTICE OF LICENSE
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@bird.eu so we can send you a copy immediately.
 * @category        Blackbird
 * @copyright       Copyright (c) Blackbird (https://black.bird.eu)
 * @author          Blackbird Team
 * @license         MIT
 * @support         https://github.com/blackbird-agency/vat-checker-proxy-server/issues/new
 */

declare(strict_types=1);

namespace Blackbird\VatCheckerProxyServer;
/**
 * Class Service
 * Check Vat on request, and return the result
 *
 * @package VatCheckerProxyServer
 */
class Service
{
    /**
     * @var string $token
     */
    protected $token;

    /**
     * @var string $utl
     */
    protected $url;

    /**
     * Service constructor.
     * @param $token
     * @param $url
     */
    public function __construct($token, $url)
    {
        $this->token = $token;
        $this->url = $url;
    }

    /**
     * Check if token is valid
     *
     * @param $key
     * @return bool
     */
    protected function isTokenValid($key): bool
    {
        return $key === $this->token;
    }

    /**
     * Return request params to send to vat checker
     *
     * @return array
     */
    protected function getRequestParams(): array
    {
        $requestParams = [];
        if (!isset($_REQUEST['countryCode'], $_REQUEST['vatNumber'] , $_REQUEST['requesterCountryCode'], $_REQUEST['countryCode'])) {
            return [];
        }
        $requestParams['countryCode'] = $_REQUEST['countryCode'];
        $requestParams['vatNumber'] = $_REQUEST['vatNumber'];
        $requestParams['requesterCountryCode'] = $_REQUEST['requesterCountryCode'];
        $requestParams['requesterVatNumber'] = $_REQUEST['requesterVatNumber'];

        return $requestParams;
    }

    /**
     * Main Programm
     */
    public function execute()
    {
        $response = [];
        $key = array_key_exists('token', $_REQUEST) ? $_REQUEST['token'] : '';
        if ($this->isTokenValid($key)) {
            $response = $this->vatIsValid();
        } else {
            $response['error'] = "Authentification token is invalid";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    /**
     * Check if is Valid and return Response
     *
     * @return array
     */
    protected function vatIsValid(): array
    {
        $response = [];
        if (!extension_loaded('soap')) {
            $response['error'] =  'Soap Extension not Load';
            return $response;
        }

        if (!extension_loaded('json')) {
            $response['error'] =  'Json Extension not Load';
            return $response;
        }

        $requestParams = $this->getRequestParams();
        if (empty($requestParams)) {
            $response['error'] =  'Parameters where not correctly sent to proxy.';
            return $response;
        }
        try {
            $client = new \SoapClient($this->url);
            $result = $client->checkVatApprox($requestParams);

            $response['is_valid'] = (bool) $result->valid;
            $response['request_date'] = (string) $result->requestDate;
            $response['request_identifier'] = (string) $result->requestIdentifier;
        } catch (\Exception $exception) {
            $response['error'] = $exception->getMessage();
        }
        return  $response;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }
}