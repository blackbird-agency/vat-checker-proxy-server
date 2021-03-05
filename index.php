<?php

include 'conf.php';

/**
 * @param $key
 * @return bool
 */
function isValid($key)
{
    return $key == PROTECTION_KEY;
}

/**
 * Return request params to send to vat checker
 *
 * @return array
 */
function getRequestParams()
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
function execute()
{
    $response = [];
    $key = array_key_exists('token', $_REQUEST) ? $_REQUEST['token'] : '';
    if (isValid($key)) {
        $response = vatIsValid();
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
function vatIsValid()
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

    $requestParams = getRequestParams();
    if (empty($requestParams)) {
        $response['error'] =  'Parameters where not correctly sent to proxy.';
        return $response;
    }
    try {
        $client = new SoapClient(EUROPA_CHECKER_URL);
        $result = $client->checkVatApprox($requestParams);

        $response['is_valid'] = (bool)$result->valid;
        $response['request_date'] = (bool)$result->requestDate;
        $response['request_identifier'] = (bool)$result->requestIdentifier;
    } catch (Exception $exception) {
        $response['error'] = $exception->getMessage();
    }
    return  $response;
}

execute();
