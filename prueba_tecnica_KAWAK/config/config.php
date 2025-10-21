<?php   
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set('America/Bogota');
// Muestra errores solo en local para depurar (puedes volver a 0 después)
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

class Kawak {
    public $mysqli = null;
    public function __construct($bd = "") {
        include_once __DIR__ . "/dbconfig.php";
        if($bd == "") {
            $this->mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_KAWAK);
        } else {
            $this->mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, $bd);
        }
        if ($this->mysqli->connect_errno) {
            echo "Error MySQLi: ( ". $this->mysqli->connect_errno.") " . $this->mysqli->connect_error;
            exit();
        }
        $this->mysqli->set_charset("utf8");
    }
    public function __destruct() { $this->CloseDB(); }
    public function runQuery($qry) { return $this->mysqli->query($qry); }
    public function CloseDB() { if ($this->mysqli) { $this->mysqli->close(); } }
    public function clearText($text) { return $this->mysqli->real_escape_string(trim($text)); }
    public function leerdatos($cadena){ $r=$this->mysqli->query($cadena); return $r ? $r->fetch_array(MYSQLI_ASSOC) : null; }
    public function leerdatosarray($cadena){ return $this->mysqli->query($cadena); }
    public function grabardatos($cadena){ return $this->mysqli->query($cadena); }
    public function vererror (){ return $this->mysqli->error; }
}

// ---- Constantes de app ----
if (!defined('APP_NAME')) define('APP_NAME', 'Kawak MVC');
if (!defined('APP_ENV'))  define('APP_ENV',  'local'); // local|prod
if (!defined('APP_URL'))  define('APP_URL',  'http://localhost/prueba_tecnica_KAWAK'); // carpeta real
