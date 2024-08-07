<?php

 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shoe Haven</title>
  <!-- Linking SwiperJS CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="css/sliderr.css">
  <link rel="stylesheet" href="css/testimonialss.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/styless.css">
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
      $conn = new PDO("mysql:host=localhost;dbname=shoes_haven","root","");
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
      $query = $conn->query("SELECT tags.tag_id,tags.tag_name, COUNT(product_tags.product_id) as Items_in_tag FROM tags left JOIN product_tags USING (tag_id) WHERE featured=1 GROUP BY tags.tag_id HAVING Items_in_tag > 3");
      $results = $query->fetchAll(PDO::FETCH_ASSOC);
      foreach ($results as $row) {
        $tagid = $row['tag_id'];
        include("includes/slider.php"); 
      }
       ?>
      
    <div class="testimonials">
    <?php include("Includes/testimonialtop.php") ?>
        <div class="testimonial-card-item swiper-slide"><img src="Testimonial/images/img-1.jpg" alt="User Image" class="testimonial-user-image">
          <h2 class="testimonial-user-name">James Wilson</h2>
          <article class="testimonial-message-article">Shoes Haven is my go-to store for all my footwear needs. The quality and variety are unmatched!
          </article>
        </div>

        <div class="testimonial-card-item swiper-slide"><img src="Testimonial/images/img-2.jpg" alt="User Image" class="testimonial-user-image">
          <h2 class="testimonial-user-name">Sarah Johnson</h2>
          <article class="testimonial-message-article">Amazing customer service and super fast delivery. I love shopping here!</article>
        </div>

        <div class="testimonial-card-item swiper-slide"><img src="Testimonial/images/img-3.jpg" alt="User Image" class="testimonial-user-image">
          <h2 class="testimonial-user-name">Michael Brown</h2>
          <article class="testimonial-message-article">The best online shopping experience I've ever had. Highly recommended! </article>
        </div>

        <div class="testimonial-card-item swiper-slide"><img src="Testimonial/images/img-4.jpg" alt="User Image" class="testimonial-user-image">
          <h2 class="testimonial-user-name">Emily Davis</h2>
          <article class="testimonial-message-article">Shoes Haven never disappoints. Great products and even better prices!</article>
        </div>

        <div class="testimonial-card-item swiper-slide"><img src="Testimonial/images/img-5.jpg" alt="User Image" class="testimonial-user-image">
          <h2 class="testimonial-user-name">Christopher Garcia</h2>
          <article class="testimonial-message-article">I found the perfect pair of shoes for my wedding here. Thank you, Shoes Haven!</article>
        </div>

        <div class="testimonial-card-item swiper-slide"><img src="Testimonial/images/img-6.jpg" alt="User Image" class="testimonial-user-image">
          <h2 class="testimonial-user-name">Richard Wilson</h2>
          <article class="testimonial-message-article">I had an excellent shopping experience at Shoes Haven. The website is user-friendly, and my order arrived quickly and exactly as described.</article>
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