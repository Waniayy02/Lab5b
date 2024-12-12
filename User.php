<?php
class User {
    private $conn; // Database connection

    // Constructor to initialize the database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Method to fetch user details by matric
    public function getUser($matric) {
        $sql = "SELECT * FROM users WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $matric);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function deleteUser($matric)
{
    $query = "DELETE FROM users WHERE matric = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("s", $matric);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


    // Method to update user details
    public function updateUser($matric, $name, $role) {
        $sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $name, $role, $matric);
        $stmt->execute();
    }

    // Method to fetch all users
    public function getUsers() {
        $sql = "SELECT matric, name, role FROM users";
        $result = $this->conn->query($sql);
        return $result;
    }

    // Method to create a new user
    public function createUser($matric, $name, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $matric, $name, $hashedPassword, $role);
        $stmt->execute();
    }
}
?>
