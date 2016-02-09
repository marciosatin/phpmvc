<?php

namespace PhpMvc\Db;

abstract class Table {
    
    protected $db;
    protected $table;
    
    public function __construct(\PDO $db) {
        $this->db = $db;
    }
    
    public function fetchAll() {
        $query = "Select * from {$this->table}";
        return $this->db->query($query);
    }
}
