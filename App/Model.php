<?php

declare(strict_types = 1);

namespace App;

abstract class Model
{
    protected DataBase $db;

    public function __construct()
    {
        $this->db = new DataBase(App::getDBConfig());
    }
}