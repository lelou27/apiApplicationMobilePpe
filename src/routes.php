<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Praticien;
use App\Department;

// Routes
$app->get('/praticiens', function (Request $request, Response $response, array $args) {
    try {
        $praticien = new Praticien($this->db);

        $data = $praticien->getAllPraticiens();

        $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE));
    } catch (Exception $e) {
        $response = $response->withJson([
            'errorMess' => $e->getMessage(),
            'errCode' => $e->getCode()
        ]);
    }

    return $response;
});

$app->get('/departements', function (Request $request, Response $response, array $args) {
    try {
        $departement = new Department($this->db);

        $data = $departement->getAllDepartementsPraticien();

        $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE));
    } catch (Exception $e) {
        $response = $response->withJson([
            'errorMess' => $e->getMessage(),
            'errCode' => $e->getCode()
        ]);
    }

    return $response;
});

$app->get('/departement/praticien/{id}', function (Request $request, Response $response, array $args) {
    try {
        $id = trim(strip_tags($args['id']));

        $departement = new Department($this->db);
        $datas = $departement->getPraticiensByDepartements(intval($id));

        $response->getBody()->write(json_encode($datas, JSON_UNESCAPED_UNICODE));
    } catch (Exception $e) {
        $response = $response->withJson([
            'errorMess' => $e->getMessage(),
            'errCode' => $e->getCode()
        ]);
    }

    return $response;
});
