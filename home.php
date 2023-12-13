<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

include 'wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- font awesome cdn link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- custom css file link -->
<link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
    include 'user_header.php';
?>

<div class="home-bg">

    <section class="swiper home-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/home-img-1.png" alt="">
                </div>
                <div class="content">
                    <span>up to 50% off</span>
                    <h3>latest smartphone</h3>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/home-img-2.png" alt="">
                </div>
                <div class="content">
                    <span>up to 50% off</span>
                    <h3>latest watch</h3>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>

            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/home-img-3.png" alt="">
                </div>
                <div class="content">
                    <span>up to 50% off</span>
                    <h3>latest headset</h3>
                    <a href="shop.php" class="btn">shop now</a>
                </div>
            </div>

        </div>
        <div class="swiper-pagination"></div>

    </section>

</div>

<!-- home category section starts -->

<section class="home-category">
    
    <h1 class="heading">shop by category</h1>

    <div class="swiper category-slider">

        <div class="swiper-wrapper">

            <a href="category.php?category=PC" class="swiper-slide slide">
                <img src="images/icon-1.png" alt="">
                <h3>Pc Portable</h3>
            </a>

            <a href="category.php?category=tv" class="swiper-slide slide">
                <img src="images/icon-2.png" alt="">
                <h3>Tv</h3>
            </a>

            <a href="category.php?category=APPAREIL PHOTO" class="swiper-slide slide">
                <img src="images/icon-3.png" alt="">
                <h3>Appareil Photo</h3>
            </a>

            <a href="category.php?category=souris" class="swiper-slide slide">
                <img src="images/icon-4.png" alt="">
                <h3>Souris</h3>
            </a>

            <a href="category.php?category=RÉFRIGÉRATEUR" class="swiper-slide slide">
                <img src="images/icon-5.png" alt="">
                <h3>Réfrigéraeur</h3>
            </a>

            <a href="category.php?category=Machine À Laver " class="swiper-slide slide">
                <img src="images/icon-6.png" alt="">
                <h3>Machine À Laver </h3>
            </a>

            <a href="category.php?category=smartphone" class="swiper-slide slide">
                <img src="images/icon-7.png" alt="">
                <h3>Smartphone</h3>
            </a>

            <a href="category.php?category=watch" class="swiper-slide slide">
                <img src="images/icon-8.png" alt="">
                <h3>Watch</h3>
            </a>

        </div>
        <div class="swiper-pagination"></div>

    </div>

</section>

<!-- home category section ends -->

<!-- home products section starts -->

<section class="home-products">

    <h1 class="heading">letest products</h1>
     
    <div class="swiper products-slider">

        <div class="swiper-wrapper">

        <?php
            $select_products = $conn->prepare("SELECT * FROM products LIMIT 6");
            $select_products->execute();
            if($select_products->rowCount() > 0){
                while($fetch_products=$select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
        <form action="" method="POST" class="slide swiper-slide">
            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
            <input type="hidden" name="image" value="<?= $fetch_products['image_01']; ?>">
            <button type="submit" name="add_to_wishlist" class="fas fa-heart"></button>
            <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
            <img src="uploaded_img/<?= $fetch_products['image_01']; ?>" class="image" alt="">
            <div class="name"><?= $fetch_products['name']; ?></div>
            <div class="flex">
                <div class="price"><span><?= $fetch_products['price']; ?></span> DT</div>
                <input type="number" name="qty" class="qty" min="1" max="99" value="1" onkeypress="if(this.value.length == 2) return false;">
            </div>
            <input type="submit" value="add to cart" name="add_to_cart" class="btn">
        </form>
        <?php
            }
        }else{
            echo '<p class="empty">no products added yet!</p>';
        }
        ?>

        </div>
        <div class="swiper-pagination"></div>

    </div>

</section>

<!-- home products section ends -->









<?php
    include 'footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- custom js file link -->
<script src="script.js"></script>

<script>
var swiper = new Swiper(".home-slider", {
    loop:true,
    grabCursor:true,
    pagination: {
        el: ".swiper-pagination",
    },
});

var swiper = new Swiper(".category-slider", {
    loop:true,
    grabCursor:true,
    spaceBetween: 20,
    pagination: {
        el: ".swiper-pagination",
    },
    breakpoints: {
        550: {
          slidesPerView: 2,
        },
        650: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 4,
      },
    },
});

var swiper = new Swiper(".products-slider", {
    loop:true,
    grabCursor:true,
    spaceBetween: 20,
    pagination: {
        el: ".swiper-pagination",
    },
    breakpoints: {
        550: {
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
      },
    },
});
</script>
    
</body>
</html>