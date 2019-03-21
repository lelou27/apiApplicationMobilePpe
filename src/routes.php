<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Praticien;

// Routes
$app->get('/praticiens', function (Request $request, Response $response, array $args) {
    try {
        $praticien = new Praticien($this->db);

        $data = $praticien->getAllPraticiens();

        $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE));
    } catch (Exception $e) {
        $response = 'ssks';
    }

    return $response;
});
