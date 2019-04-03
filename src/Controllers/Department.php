<?php

namespace App;

class Department {
    private $db;

    /**
     * Categories constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * get all praticiens
     * @return array|string
     */
    public function getAllDepartementsPraticien()
    {
        $db = $this->db;
        /** @var $db PDO */

        $query = "SELECT DISTINCT SUBSTR(PRA_CP, 1, 2) AS cp FROM praticien ORDER BY cp ASC";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute();

            $data = $stmt->fetchAll(\PDO::FETCH_COLUMN);
            // Récupération des noms de département via une API du gouvernement
            $url = 'https://geo.api.gouv.fr/departements';
            $curl = curl_init();

            $opts = [
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_CONNECTTIMEOUT => 30
            ];

            curl_setopt_array($curl, $opts);

            $response = curl_exec($curl);
            $results = json_decode($response);
            $return = array();
            // Affectation du nom de département au datas de la DB
            if (!empty($data) && !empty($results)) {
                foreach ($data as $key => $val) {
                    foreach ($results as $result) {
                        if($result->code == $data[$key]){
                            $return[$key]['code'] = $result->code;
                            $return[$key]['nom'] = $result->nom;
                        }
                    }
                }
                $data = $return;
            } else {
                $data = 'error';
            }

            return $data;

        } catch (\Exception $e) {
            $data = 'error';
            return $data;
        }
    }

    /**
     * Get all departements of one Departement
     * @param $departement Departement ID
     * @return array all praticiens to departement
     */
    public function getPraticiensByDepartements($departement)
    {
        $db = $this->db;
        /** @var $db PDO */

        $departement = trim(strip_tags($departement));
        if (strlen($departement) == 1)
            $departement = '0' . $departement;


        $query = "SELECT * FROM praticien 
                      INNER JOIN type_praticien ON praticien.TYP_CODE = type_praticien.TYP_CODE 
                  WHERE SUBSTR(PRA_CP, 1, 2) = :departement";

        try {
            $stmt = $db->prepare($query);
            $stmt->bindValue(':departement', $departement, \PDO::PARAM_INT);
            $stmt->execute();

            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $data = "Error";
        }

        return $data;
    }


}