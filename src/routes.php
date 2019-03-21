<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Praticien;

// Routes
$app->get('/praticiens', function (Request $request, Response $response, array $args) {
    try {
        $praticien = new \App\Praticien($this->db);

        $response->getBody()->write(json_encode('ok', JSON_UNESCAPED_UNICODE));


    } catch (Exception $e) {
        $response = 'ssks';
    }

    return $response;
});
