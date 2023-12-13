<?php

include 'connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $enteredPassword = $_POST['pass'];

    $select_user = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $select_user->execute([$email]);

    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if ($select_user->rowCount() > 0 && password_verify($enteredPassword, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        header('location: home.php');
        exit();
    } else {
        $message[] = 'Incorrect email or password!';
    }
}
?>

<!-- Le reste du code reste inchangé -->



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- custom css file link -->
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
    include 'user_header.php';
?>

<!-- user login section starts -->
<section class="form-container">

    <form action="" method="POST">
        <h3>login now</h3>
        <input type="email" required maxlength="50" name="email" placeholder="enter your email" class="box" 
        oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" required maxlength="20" name="pass" placeholder="enter your password" class="box" 
        oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="login now" class="btn" name="submit">
       <p>dont't have an account ?</p>
       <a href="user_register.php" class="option-btn">register now</a>
    </form>

</section>
<!-- user login section ends -->

<?php
    include 'footer.php';
?>



<!-- custom js file link -->
<script src="script.js"></script>
    
</body>
</html>