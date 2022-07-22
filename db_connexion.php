<?php 
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
class DbConnexion {

    public $servername = "";
    public $username = "";
    public $password = "";
    public $dbname = "";
    public $conn = null;


    function __construct($servername, $username, $password, $dbname) {

        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }
        

    public function getConnexion() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
        die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
?>