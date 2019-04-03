<?php

use Slim\Http\Request;
use Slim\Http\Response;

use App\Praticien;
use App\Department;
use App\Visiteur;

// Routes
/**
 * Get all praticiens
 */
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

/**
 * Get all departements
 */
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

/**
 * Get one praticien by ID
 * @param id Praticien ID
 */
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

/**
 * Get all collaborateurs
 */
$app->get('/collaborateurs', function (Request $request, Response $response, array $args) {
    try {
        $visiteur = new Visiteur($this->db);
        $datas = $visiteur->getAllVisiteurs();

        $response->getBody()->write(json_encode($datas, JSON_UNESCAPED_UNICODE));
    } catch (Exception $e) {
        $response = $response->withJson([
            'errorMess' => $e->getMessage(),
            'errCode' => $e->getCode()
        ]);
    }

    return $response;
});

/**
 * Get one collaborateur by ID
 * @param id Collaborateur ID
 */
$app->get('/collaborateur/{id}', function (Request $request, Response $response, array $args) {
    try {
        $id = $args['id'];

        $collaborateur = new Visiteur($this->db);
        $data = $collaborateur->getOneVisiteur($id);

        $response->getBody()->write(json_encode($data, JSON_UNESCAPED_UNICODE));
    } catch (Exception $e) {
        $response = $response->withJson([
            'errorMess' => $e->getMessage(),
            'errCode' => $e->getCode()
        ]);
    }

    return $response;
});
