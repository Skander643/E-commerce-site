<?php 
session_start();  
include 'connect.php';

$admin_id = $_SESSION['admin_id'] ;

if(!isset($admin_id)){
    header('location:admin_login.php');
}

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    $delete_user = $conn->prepare("DELETE FROM users WHERE id =  ?");
    $delete_user->execute([$delete_id]);
    $delete_order = $conn->prepare("DELETE FROM orders WHERE user_id =  ?");
    $delete_order->execute([$delete_id]);
    $delete_cart = $conn->prepare("DELETE FROM users WHERE user_id =  ?");
    $delete_cart->execute([$delete_id]);
    $delete_wishlist = $conn->prepare("DELETE FROM wishlist WHERE user_id =  ?");
    $delete_wishlist->execute([$delete_id]);
    $delete_messages = $conn->prepare("DELETE FROM messages WHERE user_id =  ?");
    $delete_messages->execute([$delete_id]);
    header('location:users_accounts.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users accounts</title>


    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- custom css file link -->
    <link rel="stylesheet" href="admin.css">

</head>
<body>

<?php
include 'admin_header.php';
?>

<!-- user accounts section starts -->
<section class="accounts">

    <h1 class="heading">user accounts</h1>

    <div class="box-container">

    <?php
        $select_account = $conn->prepare("SELECT * FROM users");
        $select_account->execute();
        if($select_account->rowCount() > 0){
            while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){ 
    ?>
    <div class="box">
        <p> user id : <span><?= $fetch_accounts['id']; ?></span></p>
        <p> username : <span><?= $fetch_accounts['name']; ?></span></p>
        <a href="users_accounts.php?delete=<?= $fetch_accounts['id']; ?>"
                    class="delete-btn" onclick="return confirm('delete this account ? ');">delete</a>
    </div>
    <?php
            }
        }else{
            echo '<p class="empty">now accounts available</p>';
        }
    ?>

    </div>

</section>
<!-- user accounts section starts -->





<!-- custom js file link -->
<script src="admin_script.js"></script>

</body>
</html>