<?php 

include('../config/BDconect.php');
session_start();


 
if (isset($_POST['login'])) {
 
    $email = $_POST['email'];
    $password = $_POST['password'];
 
    $query = $connect->prepare("SELECT * FROM phprode.user WHERE MAIL=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
 
    $result = $query->fetch(PDO::FETCH_ASSOC);
 
    if (!$result) {
        echo '<p class="error">Email password combination is wrong!</p>';
    } else {
        if (password_verify($password, $result['password'])) {
            $_SESSION['user_id'] = $result['ID'];
           // header("location: ../home.php");
        } else {
            echo '<p class="error">Username password combination is wrong!</p>';
            echo password_verify($password, $result['password']);
        }
    }
}
 
?>


<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<title>PHProde</title>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="login.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">

<script src="../dist/js/bootstrap.min.js"></script> 
</head>

<body>
<img class= "imageLogin" src="../../prode/img/logo4.png"/>

<div class="testbox">
<h1>Login</h1>
        <form method="post" action="" name="signup-form">
            <hr>
            <label id="icon" for="name"><i class="icon-envelope "></i></label>
            <input type="text" name="email" id="email" placeholder="Email" required />

            <label id="icon" for="name"><i class="icon-shield"></i></label>
            <input name="password" id="password" placeholder="Password" required />

            <div class="terms-btn">
            <button class="button" name="login">Submit</button>
			<a href="../login/register/register.php" class="btn-line">Register</a>
			</div>
        </form>
    </div>

</body>
</html>
