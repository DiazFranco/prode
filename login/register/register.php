<?php
 
include('../../config/BDconect.php');
session_start();
 
if (isset($_POST['register'])) {
 
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $lastname= $_POST['lastname'];
    $password = $_POST['password'];
 
    $query = $connect->prepare("SELECT * FROM phprode.user WHERE MAIL=:email");
    $query->bindParam("email", $email, PDO::PARAM_STR);
    $query->execute();
 
    if ($query->rowCount() > 0) {
        echo '<p class="error">The email address is already registered!</p>';
    }
 
    if ($query->rowCount() == 0) {
        $query = $connect->prepare("INSERT INTO phprode.player(NICKNAME,MAIL,NAME,LAST_NAME) VALUES (:nickname,:email,:name,:lastname)");
        $query2 = $connect->prepare("INSERT INTO phprode.user(MAIL,PASSWORD) VALUES (:email,:password)");
        $query->bindParam("nickname", $nickname, PDO::PARAM_STR);
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("name", $name, PDO::PARAM_STR);
        $query->bindParam("lastname", $lastname, PDO::PARAM_STR);

        $query2->bindParam("email", $email, PDO::PARAM_STR);
        $query2->bindParam("password", $password, PDO::PARAM_STR);
        
        $result = $query->execute();
        $result2 = $query2->execute();
 
        if ($result && $result2) {
            echo '<p class="success">Your registration was successful!</p>';
        } else {
            echo '<p class="error">Something went wrong!</p>';
        }
    }
}
 
?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="register.css">
</head>

<body>
    <div class="testbox">
        <h1>Registration</h1>

        <form method="post" action="" name="signup-form">
            <hr>
            <label id="icon" for="name"><i class="icon-envelope "></i></label>
            <input type="text" name="email" id="email" placeholder="Email" required />

            <label id="icon" for="name"><i class="icon-user"></i></label>
            <input type="text" name="name" id="name" placeholder="Name" required />

            <label id="icon" for="name"><i class="icon-user"></i></label>
            <input type="text" name="lastname" id="lastname" placeholder="Last Name" required />

            <label id="icon" for="name"><i class="icon-user"></i></label>
            <input type="text" name="nickname" id="nickname" placeholder="Nickname" required />

            <label id="icon" for="name"><i class="icon-shield"></i></label>
            <input type="password" name="password" id="password" placeholder="Password" required />

            <div class="terms-btn">
            <p>By clicking Register, you agree on our <a href="#">terms and condition</a>.</p>
            <button class="button" name="register" value="register">Register</a>
            </div>
        </form>
    </div>
</body>