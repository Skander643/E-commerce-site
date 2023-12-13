<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
    header('location:user_login.php');
}

if(isset($_POST['delete'])){
    $cart_id = $_POST['cart_id'];
    $delete_cart = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $delete_cart->execute([$cart_id]);
    $message[] = 'cart item deleted!';
}

if(isset($_GET['delete_all'])){
    $delete_all = $_GET['delete_all'];
    $delete_all_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
    $delete_all_cart->execute([$user_id]);
    header('location:cart.php');
}

if(isset($_POST['update_qty'])){
    $cart_id = $_POST['cart_id'];
    $qty = $_POST['qty'];
    $update_qty = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
    $update_qty->execute([$qty, $cart_id]);
    $message[] = 'cart quantity updated!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>

    <!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- custom css file link -->
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
    include 'user_header.php';
?>


<!-- cart section starts -->

<section class="products">

    <h1 class="heading">shopping cart</h1>

    <div class="box-container">

    <?php
        $grand_total = 0;
        $select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
        $select_cart->execute([$user_id]);
        if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
       
    ?>
    <form action="" method="POST" class="box">
        <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
        <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
        <img src="uploaded_img/<?= $fetch_cart['image']; ?>" class="image" alt="">
        <div class="name"><?= $fetch_cart['name']; ?></div>
        <div class="flex">
            <div class="price"><span><?= $fetch_cart['price']; ?> DT</span></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="<?= $fetch_cart['quantity']; ?>" 
            onkeypress="if(this.value.length == 2) return false;">
            <button type="submit" class="fas fa-edit" name="update_qty"></button>
        </div>
        <div class="sub-total">sub total : <span><?= $sub_total = ( $fetch_cart['price'] * 
        $fetch_cart['quantity'] ); ?> DT</span></div>
        <input type="submit" value="delete item" onclick="return confirm('delete this from cart ?');"
         name="delete" class="delete-btn">
    </form>
    <?php
        $grand_total +=$sub_total;
          }
        }else{
            echo '<p class="empty">your cart is empty</p>';
        }
    ?>

    </div>

    <div class="grand-total">
       <p> grand total : <span><?= $grand_total; ?> DT</span></p>
        <a href="shop.php" class="option-btn">continue shopping</a>
        <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?''
        :'disabled'; ?>" onclick="return confirm('delete all from cart ?');">delete all</a>
        <a href="checkout.php" class="btn <?= ($grand_total > 1)?''
        :'disabled'; ?>">proceed to checkout</a>
    </div>

</section>

<!-- cart section ends -->





<?php
    include 'footer.php';
?>



<!-- custom js file link -->
<script src="script.js"></script>
    
</body>
</html>