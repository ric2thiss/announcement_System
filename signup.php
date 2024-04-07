<?php
  include './model/User.php';
  include './controller/AuthController.php';

  $dbConnection = new PDO("mysql:host=localhost;dbname=ams", "root", "");

  $user = new User($dbConnection);
  $auth = new AuthController($user);

  $fnameErr = $lnameErr = $emailErr = $passwordErr = "";
  $firstname = $lastname = $email = $passowrd = "";

  if(isset($_POST["submit"])){
    if(empty($_POST["firstname"])){
      $fnameErr = "First Name is Required";
    }else if(empty($_POST["lastname"])){
      $lnameErr = "Last Name is Required!";
    }else if(empty($_POST["email"])){
      $emailErr = "Email is Required!";
    }else if(empty($_POST["password"])){
      $passwordErr = "Password is Required";
    }else{
      $auth->signup();
    }
  }

  session_start();

  // Check if the user is already logged in
  if(isset($_SESSION["email"])) {
      // Redirect to dashboard if the user is logged in
      header('Location: ./dashboard.php');
      exit(); 
  }



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Announcement Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
      <div class="row gx-lg-5 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight">
            Announcement <br />
            <span class="text-primary">Management System</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Eveniet, itaque accusantium odio, soluta, corrupti aliquam
            quibusdam tempora at cupiditate quis eum maiores libero
            veritatis? Dicta facilis sint aliquid ipsum atque?
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
              <form action="signup.php" method="post">
                <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" name="firstname" id="form3Example1" class="form-control" />
                      <label class="form-label" for="form3Example1">First name</label>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" name="lastname" id="form3Example2" class="form-control" />
                      <label class="form-label" for="form3Example2">Last name</label>
                    </div>
                  </div>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" name="email" id="form3Example3" class="form-control" />
                  <label class="form-label" for="form3Example3">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form3Example4" class="form-control" />
                  <label class="form-label" for="form3Example4">Password</label>
                </div>

                <!-- Submit button -->
                <div class="d-grid">
                    <input type="submit" name="submit" value="Signup" class="btn btn-primary btn-block mb-4">
                </div>

                <div class="text-end">
                    <a href="/ams/login.php" class="text-end">Already have an account?</a>
                </div>
                <?php echo "
                <p class='text-danger'>$fnameErr</p>
                <p class='text-danger'>$lnameErr</p>
                <p class='text-danger'>$emailErr</p>
                <p class='text-danger'>$passwordErr</p>
                
                "?>
                   


        
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>