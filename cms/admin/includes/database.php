<?php 

require_once("galconfig.php");

class Database {

    public $connection;

    function __construct() {
        $this->open_db_connection();
    } // End of __construct
    
    public function open_db_connection() {

        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($this->connection->connect_errno) {
            die("Database connection failed. " . $this->connection->connect_error);
        }
    } // End of open_db_connection

    public function query($sql) {

        $result = $this->connection->query($sql);

        $this->confirm_query($result);

        return $result;
    } // End of query

    private function confirm_query($result) {

        if(!$result) {
            die("Query failed. " . $this->connection->error);
        }
    } // End of confirm_query

    public function escape($str) {
        return $this->connection->real_escape_string($str);
    } //End of escape

    public function insert() {
        return mysqli_insert_id($this->connection);
    } // End of insert

} // End of Database class

$db = new Database();

?>