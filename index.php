<?php

require_once 'vendor/autoload.php';
date_default_timezone_set('America/Bogota');


use Controller\InventarioController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Views\PhpRenderer;

$app = AppFactory::create();
$app->setBasePath('/simple-inventario');


$app->group('/', function (RouteCollectorProxy $group) {
    $renderer = new PhpRenderer(__DIR__ . '/Views');
    $ic = new InventarioController();

    $group->get('', function ($request, $response, array $args) use ($ic,$renderer) {
        $productos = $ic->getAll();
        return $renderer->render($response,"home.php", ["productos" => $productos]);

    });

    $group->get('nuevo', function ($request, $response, array $args) use ($ic,$renderer) {
//        $productos = $ic->getAll();
        return $renderer->render($response,"nuevo.php", $args);

    });

    $group->post('nuevo', function ($request, $response, array $args) use ($ic,$renderer) {
        $body = (array)$request->getParsedBody();
        $payload = $ic->create($body);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Location', '/simple-inventario')
            ->withStatus(203);
    });

    $group->post('actualizar', function ($request, $response, array $args) use ($ic,$renderer) {
        $id = (array)$request->getParsedBody();
        $producto = $ic->get($id);
        $args = array_merge($id,$producto);
        return $renderer->render($response,"actualizar.php", $args);

    });

    $group->post('update/{ID}', function ($request, $response,array $id) use ($ic, $renderer) {
        $cambios = $request->getParsedBody();
        $payload = $ic->update($cambios, $id);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Location', '/simple-inventario')
            ->withStatus(203);
    });

    $group->post('eliminar', function ($request, $response, array $args) use ($ic,$renderer) {
        $id = (array)$request->getParsedBody();
        $payload = $ic->delete($id);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Location', '/simple-inventario')
            ->withStatus(203);
    });

    $group->post('vender', function ($request, $response, array $args) use ($ic,$renderer) {
        $id = (array)$request->getParsedBody();
        $payload = $ic->sell($id);
        $response->getBody()->write($payload);
        $productos = $ic->getAll();
        return $renderer->render($response,"home.php", ["productos" => $productos]);
    });

});

$app->run();