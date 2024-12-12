<?php
class Database {
    private $host = "localhost";  // Your database host (e.g., localhost)
    private $db_name = "Lab_5b";  // Your database name
    private $username = "root";   // Your database username
    private $password = "";       // Your database password (leave empty for XAMPP default)
    public $conn;

    // Method to get a database connection
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

            // Check for connection errors
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
