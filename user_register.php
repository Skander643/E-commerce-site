<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST['email'];
    $email = filter_var($email,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pass = $_POST['pass'];
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
    $cpass = $_POST['cpass'];


    $select_user = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $select_user->execute([$email]);
    $row = $select_user->fetch(PDO::FETCH_ASSOC);

    if($select_user->rowCount() > 0){
       $message[] = 'user already exist!';
    }else{
        
        if($pass != $cpass){
            $message[] = 'confirm password not matched!';
        }else{
            $insert_user = $conn->prepare("INSERT INTO users(name, email, password) VALUES(?,?,?);");
            $insert_user->execute([$name, $email, $hashed_password]);
            $message[] = 'registered successfully, please login now!';
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- custom css file link -->
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
    include 'user_header.php';
?>

<!-- user register section starts -->
<section class="form-container">

    <form action="" method="POST">
        <h3>register now</h3>
        <input type="text" required maxlength="20" name="name" placeholder="enter your name" class="box" 
        oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="email" required maxlength="50" name="email" placeholder="enter your email" class="box" 
        oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" required maxlength="20" name="pass" placeholder="enter your password" class="box" 
        oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password" required maxlength="20" name="cpass" placeholder="confirm your password" class="box" 
        oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="register now" class="btn" name="submit">
       <p>already have an account ?</p>
       <a href="user_login.php" class="option-btn">login now</a>
    </form>

</section>
<!-- user register section ends -->


<?php
    include 'footer.php';
?>



<!-- custom js file link -->
<script src="script.js"></script>
    
</body>
</html>