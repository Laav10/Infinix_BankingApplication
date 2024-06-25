<?php
$success=0;
$user = 0;
if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    $Name=$_POST['signupName'];
    $Passwd=$_POST['passwd'];
    $Contact=$_POST['signupContactNo'];
    $PAN=$_POST['signupPAN'];


$sql="SELECT * FROM `regis` where PAN='$PAN'";
$result=mysqli_query($con, $sql);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
            $user=1;
        }
        else{
            if($result){
            $success=1;
            $sql="INSERT INTO `regis` (Name, Password, Contact, PAN, AMT) VALUES('$Name', '$Passwd', '$Contact', '$PAN', '10000')";
            $result=mysqli_query($con, $sql);
        }       
        else
        {
            die(mysqli_error($con));
        }
    }
}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Infinity</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style media="screen">
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #080710;
        }

        .buttons-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .buttons-container button {
            background-color: transparent;
            border: none;
            color: #ffffff;
            font-size: 20px;
            font-weight: 600;
            cursor: pointer;
            padding: 10px 20px;
            margin: 0 10px;
        }

        .buttons-container button.active {
            border-bottom: 2px solid #ffffff;
        }

        form {
            display: none; /* Hide the form by default */
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
            margin: auto;
        }

        form.active {
            display: block; /* Show the form when active */
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        button {
            margin-top: 50px;
            width: 45%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .signup-fields {
            display: none;
        }
       nav {
            background-color: #080710;
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
        }

        nav h1 {
            font-size: 24px;
            font-weight: 600;
            margin-right: auto;
        }

        nav ul {
            list-style-type: none;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            color: #ffffff;
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ffcc00;
        }
        .logo {
            margin-right: 20px;
            font-size: 24px;
            font-weight: 600;
        }
      .buttons-container button.active {
    border-bottom: 2px solid #ffffff; 
}
    </style>
</head>
<body>
   <?php
   if($user){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>You already have an account!</strong> Login to continue.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  </div>';
   }
   ?>

<?php
   if($success){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Login to continue.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span></button>
  </div>';
   }
   ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <nav>
     <img src="logo.png" style="padding: 2px; width: 50px"></img>
       <h1 style="padding-left:10px;">Infinix</h1>
        <ul>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Schemes</a></li>
            <li><a href="#">Online Banking</a></li>
        </ul>
    </nav>
   <div class="buttons-container">
        <button id="loginButton" class="active" onclick="showLoginDetails()">Log In</button>
        <button id="signupButton" onclick="showSignupDetails()">Sign Up</button>
    </div>

    <form id="signupForm" action="sign.php" method="post">
        <h3 id="loginFormTitle">Sign Up</h3>
        <input type="hidden" id="signupSubmitButton" name="signupSubmitButton" value="hidden">
        <div id="signupFields" class="signup-fields">
            <label for="signupName">First Name</label>
            <input type="text" id="signupName" name="signupName" placeholder="Name">

            <label for="pass">Password</label>
            <input type="password" id="passwd" name="passwd" placeholder="Password">

            <label for="confpass">Confirm Password</label>
            <input type="password" id="conf" name="conf" placeholder="Confirm Password">

            <label for="signupContactNo">Contact No</label>
            <input type="text" id="signupContactNo" name="signupContactNo" placeholder="Contact No">

            <label for="signupPAN">PAN No</label>
            <input type="text" id="signupPAN" name="signupPAN" placeholder="PAN No">
        </div>

        <button name="signupSubmitButton">Sign Up</button>
    </form>

    <form id="loginForm" class="active" action="login.php" method="post">
        <h3 id="loginFormTitle">Log In</h3>
      
        <label for="loginPAN">PAN</label>
        <input type="text" id="loginPAN" name="loginPAN" placeholder="PAN No">

        <label for="loginPassword">Password</label>
        <input type="password" id="loginPassword" name="loginPassword" placeholder="Password">
        <button name="loginSubmitButton">Login</button>
    </form>

    <script>
        const loginButton = document.getElementById('loginButton');
        const signupButton = document.getElementById('signupButton');
        const loginForm = document.getElementById('loginForm');
        const signupForm = document.getElementById('signupForm');

        function showLoginDetails() {
            document.getElementById('loginFormTitle').innerText = "Log In";
            loginForm.classList.add('active');
            signupForm.classList.remove('active');
            loginButton.classList.add('active');
            signupButton.classList.remove('active');
        }

        function showSignupDetails() {
            signupForm.reset(); 
            loginForm.reset(); 
            signupFields.style.display = "block";
            document.getElementById('loginFormTitle').innerText = "Sign Up";
            signupForm.classList.add('active');
            loginForm.classList.remove('active');
            signupButton.classList.add('active');
            loginButton.classList.remove('active');
        }
    </script>
</body>
</html>