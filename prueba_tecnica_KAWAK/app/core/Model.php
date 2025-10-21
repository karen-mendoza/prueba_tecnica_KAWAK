<?php
require_once __DIR__ . '/../../config/config.php';
class Model {
    protected $db;
    public function __construct() {
        $k = new Kawak();
        $this->db = $k->mysqli;
    }
}
