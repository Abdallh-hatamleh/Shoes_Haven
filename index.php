<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shoe Haven</title>
  <!-- Linking SwiperJS CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="css/slider.css">
  <link rel="stylesheet" href="css/testimonials.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Jomhuria&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/foter.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <link rel="stylesheet" href="css/cart-products-section.css">
</head>

<body style="position:relative">
  <?php include_once("includes/nav.php") ?>
  <?php include("includes/hero.php") ?>
  <?php include("includes/about.php") ?>
  <main>
    <h2 class="section-header"><i class="fa-solid fa-fire-flame-curved fa-flip-horizontal"></i>Hottest Items<i class="fa-solid fa-fire-flame-curved"></i></h2>
    
      <?php 
      $tagid = 1;
      include("includes/slider.php"); 
      $tagid = 4;
      include("includes/slider.php");
       ?>
      
    <div class="testimonials">
    <?php include("Includes/testimonialtop.php") ?>
        <div class="testimonial-card-item swiper-slide"><img src="Testimonial/images/img-1.jpg" alt="User Image" class="testimonial-user-image">
          <h2 class="testimonial-user-name">James Wilson</h2>
          <article class="testimonial-message-article">Message Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Magni
            laborum est facilis mollitia tenetur, aspernatur voluptatibus, laudantium qui </article>
        </div>

        <div class="testimonial-card-item swiper-slide"><img src="Testimonial/images/img-2.jpg" alt="User Image" class="testimonial-user-image">
          <h2 class="testimonial-user-name">Sarah Johnson</h2>
          <article class="testimonial-message-article">Message Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Magni
            laborum est facilis mollitia tenetur, aspernatur voluptatibus, laudantium qui </article>
        </div>

        <div class="testimonial-card-item swiper-slide"><img src="Testimonial/images/img-3.jpg" alt="User Image" class="testimonial-user-image">
          <h2 class="testimonial-user-name">Michael Brown</h2>
          <article class="testimonial-message-article">Message Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Magni
            laborum est facilis mollitia tenetur, aspernatur voluptatibus, laudantium qui </article>
        </div>

        <div class="testimonial-card-item swiper-slide"><img src="Testimonial/images/img-4.jpg" alt="User Image" class="testimonial-user-image">
          <h2 class="testimonial-user-name">Emily Davis</h2>
          <article class="testimonial-message-article">Message Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Magni
            laborum est facilis mollitia tenetur, aspernatur voluptatibus, laudantium qui </article>
        </div>

        <div class="testimonial-card-item swiper-slide"><img src="Testimonial/images/img-5.jpg" alt="User Image" class="testimonial-user-image">
          <h2 class="testimonial-user-name">Christopher Garcia</h2>
          <article class="testimonial-message-article">Message Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Magni
            laborum est facilis mollitia tenetur, aspernatur voluptatibus, laudantium qui </article>
        </div>

        <div class="testimonial-card-item swiper-slide"><img src="Testimonial/images/img-6.jpg" alt="User Image" class="testimonial-user-image">
          <h2 class="testimonial-user-name">Richard Wilson</h2>
          <article class="testimonial-message-article">Message Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Magni
            laborum est facilis mollitia tenetur, aspernatur voluptatibus, laudantium qui </article>
        </div>
    <?php include("Includes/testimonialbottom.php") ?>
    </div>
  </main>
  <d

    <div class="foot-margin" style="margin: 2rem 0;"></div>
    <?php include_once("includes/foot.php") ?>
<!-- Linking SwiperJS script -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Linking custom script -->
<script src="JS/slider.js"></script>
<script src="JS/testimonials.js"></script>
<script src="JS/nav.js"></script>
<script src="JS/nav-cart.js"></script>
</body>