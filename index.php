<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
require_once './includes/dbHandler.php';
require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->get('/bancos', function (Request $request, Response $response) {
    $db = new dbHandler();
    $cur = $db->getAllBancos();
    $response->getBody($cur);
    return $response;
});

$app->get('/seguros', function (Request $request, Response $response) {
    $db = new dbHandler();
    $cur = $db->getAllSeguros();
    $response->getBody($cur);
    return $response;
});

$app->run();