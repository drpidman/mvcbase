<?php

namespace App\Models;

use PDO;
use PDOException;

class Connection
{

    protected $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        } catch (PDOException $err) {
            exit("<span style='color: red'>[PDOException:Erro]</span> - <span style='color: blue'>" . $err->getMessage() . '</span>');
            return;
        }
    }

    public function getPdo()
    {
        return $this->pdo;
    }
}
