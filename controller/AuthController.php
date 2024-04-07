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
    }
?>