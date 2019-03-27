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

    public function getAllDepartementsPraticien()
    {
        $db = $this->db;
        /** @var $db PDO */

        $query = "SELECT DISTINCT SUBSTR(PRA_CP, 1, 2) AS cp FROM praticien";

        try {
            $stmt = $db->prepare($query);
            $stmt->exxecute();

            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $data = 'error';
        }

        return $data;
    }

    public function getPraticiensByDepartements($departement)
    {
        $db = $this->db;
        /** @var $db PDO */

        $departement = trim(strip_tags($departement));
        $query = "SELECT * FROM praticien WHERE SUBSTR(PRA_CP, 1, 2) = :departement";

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