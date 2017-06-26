<?php

require_once('RequestHandler.php');
require_once('Calculator.php');
require_once('ResponseHandler.php');

$response_handler = new \CurrencyConverter\ResponseHandler();

try {
    $request_handler = new \CurrencyConverter\RequestHandler($_GET);
    $params = $request_handler->sanitizedParams();

    $calculator = new \CurrencyConverter\Calculator();
    $conversion = $calculator->calculate($params['from'], $params['to'], $params['value']);

    $response_handler->printConversion($conversion);
} catch (\CurrencyConverter\InvalidParametersException $e) {
    $response_handler->printException($e->getMessage(), 400);
} catch (\CurrencyConverter\RateNotFoundException $e) {
    $response_handler->printException($e->getMessage(), 404);
} catch (Exception $e) {
    $response_handler->printException($e->getMessage(), 500);
}
