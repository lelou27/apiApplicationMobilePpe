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


}