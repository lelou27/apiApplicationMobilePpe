<?php

namespace App;

class Visiteur {
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
     * Get all visiteurs
     * @return array all Visiteurs
     */
    public function getAllVisiteurs()
    {
        $db = $this->db;
        /** @var $db PDO */

        $query = "SELECT COL_MATRICULE, COL_NOM, COL_PRENOM, LAB_NOM
                  FROM collaborateur c
                      INNER JOIN labo l ON c.LAB_CODE = l.LAB_CODE
                  ORDER BY LAB_NOM, COL_PRENOM";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute();

            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $data = 'error';
        }

        return $data;
    }

    /**
     * Get one visiteur by id
     * @param $id visiteur id
     * @return array one visiteur
     */
    public function getOneVisiteur($id)
    {
        $db = $this->db;
        /** @var $db PDO */

        $query = "SELECT *
                  FROM collaborateur c
                      INNER JOIN labo l ON c.LAB_CODE = l.LAB_CODE
                  WHERE c.COL_MATRICULE = :id";

        try {
            $stmt = $db->prepare($query);
            $stmt->bindValue(':id', $id, \PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetch();
        } catch (\Exception $e) {
            $data = 'error';
        }

        return $data;
    }
}