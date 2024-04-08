<?php
    class AuthController{
        private $userModel;

        public function __construct($userModel)
        {
            $this->userModel = $userModel;
        }

        public function signup(){

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                
                $result = $this->userModel->createUser($firstname, $lastname, $email, $password);


                if ($result === "Email already exists") {
                    echo "<script>alert('Email already exists')</script>";
                    // Display an error message to the user
                } elseif ($result === "Error creating user.") {
                   echo "Error";
                } else {
                    echo "OK!";
                }
            }
        }
        

        public function login(){
            if($_SERVER["REQUEST_METHOD"]== "POST"){
                session_start();
                $email = $_POST["email"];
                $password = $_POST["password"];

                $user = $this->userModel->loginUser($email, $password);
                if($user){
                    $authenticated = true;
                    if($authenticated){
                        $_SESSION["email"] = $email;
                        header('Location: ./dashboard.php');
                        exit();
                    }
                } else {
                    // Authentication failed, display error message
                    echo 'Invalid username or password';
                }
            }
        }


        public function logout() {
            // Unset all session variables
            // session_unset();
            // Destroy the session
            session_destroy();
            header("Location: login.php");
        }

        public function userInfo(){
            // Check if the user is logged in
            if(isset($_SESSION['email'])) {
                // Retrieve the email from the session
                $email = $_SESSION['email'];
        
                // Retrieve user information based on the email
                $userInfo = $this->userModel->getter($email);
        
                // Return user information if found
                return $userInfo;
            } else {
                // Redirect or handle the case where the user is not logged in
                // For example:
                header('Location: ./login.php');
                exit(); // Always exit after redirection
            }
        }
        
    }
?>