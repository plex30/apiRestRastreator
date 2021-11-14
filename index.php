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
   
    $newResponse = $response->withHeader('Access-Control-Allow-Origin', '*')
    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    $newResponse->getBody()->write(json_encode($cur), '200');
    return $newResponse;
    
});

$app->get('/seguros', function (Request $request, Response $response) {
    $db = new dbHandler();
    $cur = $db->getAllSeguros();
    
    $newResponse = $response->withHeader('Access-Control-Allow-Origin', '*')
    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    $newResponse->getBody()->write(json_encode($cur), '200');
    return $newResponse;
    
});

$app->run();