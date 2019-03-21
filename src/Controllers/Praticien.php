<?php

namespace App;

class Praticien {
    private $db;

    /**
     * Categories constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllPraticiens()
    {
        $db = $this->db;
        /** @var $db PDO */

        $query = "SELECT * FROM praticien";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute();

            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\Exception $e)
        {
            die(var_dump($e->getMessage()));
        }

        return $data;
    }
}