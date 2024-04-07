<?php
include 'Database.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    // Create a new user
    public function createUser($firstname, $lastname, $email, $password) {
        try {
            // Check if email already exists
            $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            
            if ($count > 0) {
                // Email already exists, return an error
                return "Email already exists";
            }
    
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Insert the new user
            $sql = "INSERT INTO users(`firstname`, `lastname`, `email`, `password`) VALUES(:firstname, :lastname, :email, :password)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            // Bind the hashed password
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();
    
            // Redirect after user creation
            header("Location: ./login.php");
            exit(); // Always exit after redirection
        } catch(PDOException $err) {
            // Handle errors gracefully
            error_log("Error creating user: " . $err->getMessage());
            return "Error creating user.";
        }
    }
    

        // Log in a user account
    // Login
    public function loginUser($email, $password) {
        try {
            $sql = "SELECT * FROM users WHERE email= :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Verify the hashed password
                if (password_verify($password, $user['password'])) {
                    // Passwords match, return the user
                    return $user;
                } else {
                    // Passwords don't match, return false
                    return false;
                }
            } else {
                // User not found, return false
                return false;
            }
        } catch (PDOException $err) {
            echo $err->getMessage();
        }
    }

    
    
}
?>

