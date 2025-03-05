<?php

namespace Models;

class BaseModel extends \SQLite3
{
    function __construct()
    {
        // Define o caminho para o banco de dados SQLite
        $DATABASE = dirname(__DIR__) . '/database.sqlite';
        
        // Abre a conexão com o banco de dados
        $this->open($DATABASE);

        $this->createTable();
    }

    private function createTable()
    {
        
        $query = "CREATE TABLE IF NOT EXISTS user (
            id INTEGER PRIMARY KEY AUTOINCREMENT, 
            name TEXT NOT NULL, 
            registration TEXT NOT NULL UNIQUE, 
            ipDevice TEXT NOT NULL
        )";

        // Executa a query
        $this->exec($query);
    }
}
