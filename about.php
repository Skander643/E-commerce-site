<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}else{
    $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- custom css file link -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
    include 'user_header.php';
?>

<!-- about section starts -->

<section class="about">

    <div class="row">

        <div class="image">
            <img src="images/about-img.svg" alt="">
        </div>

        <div class="content">
            <h3>why choose us?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
             Eius, molestiae eveniet! Assumenda, mollitia minima quam iusto tempore 
             consectetur eos facere optio alias. Corporis fugiat libero optio quia quod impedit voluptatem?</p>
             <a href="contact.php" class="btn">contact us</a>
        </div>

    </div>

</section>

<!-- about section ends -->

<!-- reviews section starts -->

<section class="reviews">

    <h3 class="heading">client's reviews</h3>

    <div class="swiper reviews-slider">

        <div class="swiper-wrapper">

            <div class="swiper-slide slide">
                <img src="images/pic-1.png" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Quaerat sed vitae, deserunt totam quod odio</p>
                <div class="starts">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="swiper-slide slide">
                <img src="images/pic-2.png" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Quaerat sed vitae, deserunt totam quod odio</p>
                <div class="starts">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="swiper-slide slide">
                <img src="images/pic-3.png" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Quaerat sed vitae, deserunt totam quod odio</p>
                <div class="starts">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="swiper-slide slide">
                <img src="images/pic-4.png" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Quaerat sed vitae, deserunt totam quod odio</p>
                <div class="starts">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="swiper-slide slide">
                <img src="images/pic-5.png" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Quaerat sed vitae, deserunt totam quod odio</p>
                <div class="starts">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

            <div class="swiper-slide slide">
                <img src="images/pic-6.png" alt="">
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                     Quaerat sed vitae, deserunt totam quod odio</p>
                <div class="starts">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3>john deo</h3>
            </div>

        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>

<!-- reviews section ends -->

<?php
    include 'footer.php';
?>

<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script> 

<!-- custom js file link -->
<script src="script.js"></script>
    
<script>
    var swiper = new Swiper(".reviews-slider", {
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