<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:home.php');
}

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $name = filter_var($name,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = $_POST['email'];
    $email = filter_var($email,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $update_profile = $conn->prepare("UPDATE users SET name = ?,email = ? WHERE id = ?");
    $update_profile->execute([$name, $email, $user_id]);

    $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
    $select_prev_pass = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $select_prev_pass->execute([$user_id]);
    $fetch_prev_pass = $select_prev_pass->fetch(PDO::FETCH_ASSOC);
    $prev_pass = $fetch_prev_pass['password'];
    $old_pass = sha1($_POST['old_pass']);
    $old_pass = filter_var($old_pass,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $new_pass = sha1($_POST['new_pass']);
    $new_pass = filter_var($new_pass,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm_pass = sha1($_POST['confirm_pass']);
    $confirm_pass = filter_var($confirm_pass,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if($old_pass == $empty_pass){
        $message[] = 'please enter old password!';
    }elseif($old_pass != $prev_pass){
        $message[] = 'old password not matched!';
    
    }elseif($new_pass == $old_pass){
        $message[] = 'new password not matched!';
    }elseif($new_pass != $confirm_pass){
        $message[] = 'confirm password not matched!';
    }else{
        if($new_pass != $empty_pass){
            $update_pass = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $update_pass->execute([$confirm_pass, $user_id]);
            $message[] = 'passsword updated successfully!';
        }else{
            $message[] = 'please enter the new password!';
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
    <title>update prfile</title>

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
        <h3>update profile</h3>
        <input type="text" required maxlength="20" name="name" placeholder="enter your name" class="box" 
        oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile['name']; ?>">
        <input type="email" required maxlength="50" name="email" placeholder="enter your email" class="box" 
        oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $fetch_profile['email']; ?>">
        <input type="password"  maxlength="20" name="old_pass" placeholder="enter your old password" class="box" 
        oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password"  maxlength="20" name="new_pass" placeholder="enter your new password" class="box" 
        oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="password"  maxlength="20" name="confirm_pass" placeholder="confirm your new password" class="box" 
        oninput="this.value = this.value.replace(/\s/g, '')">
        <input type="submit" value="update now" class="btn" name="submit">
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