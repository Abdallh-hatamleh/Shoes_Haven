<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" href="css/testimonials.css">
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Jockey+One&family=Jomhuria&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/foter.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/cart-products-section.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
            font-size: 18px; /* تكبير حجم الخط الأساسي */
        }

        .containerzz {
            width: 80%;
            margin: 100px auto 0; /* إضافة مسافة أعلى الصفحة */
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 32px; /* تكبير حجم العنوان */
        }

        .faq-item {
            margin-bottom: 80px; /* زيادة المسافة إلى الضعف */
            padding: 10px;
            background-color: #f5f5f5;
            border-radius: 5px;
            border-left: 5px solid black;
        }

        .faq-item h2 {
            margin: 0;
            color: #FF8C00; /* لون برتقالي غامق */
            font-size: 24px; /* تكبير حجم الأسئلة */
        }

        .faq-item p {
            margin: 5px 0 0;
            color: #666;
            font-size: 18px; /* تكبير حجم النصوص الفرعية */
        }

        .contact-support {
            text-align: center;
            margin-top: 30px;
            background-color: #333;
            color: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        .contact-support h2 {
            color: #FF8C00; /* لون برتقالي غامق */
            font-size: 24px; /* تكبير حجم العنوان في قسم الدعم */
        }

        .contact-support p {
            color: #ddd;
            font-size: 18px; /* تكبير حجم النصوص في قسم الدعم */
        }

        .contact-support a {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 18px; /* تكبير حجم النص في الرابط */
        }

        .contact-support a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include_once('includes/nav.php') ?>
    <div class="containerzz">
        <h1>Help Center</h1>

        <div class="faq-item">
            <h2>How do I reset my password?</h2>
            <p>If you forget your password, you can reset it by clicking on the "Forgot Password" link on the login page. Follow the instructions sent to your email to set a new password.</p>
        </div>

        <div class="faq-item">
            <h2>How can I contact customer support?</h2>
            <p>You can contact customer support by sending an email to support@example.com. Our team will respond to your inquiry as soon as possible.</p>
        </div>

        <div class="faq-item">
            <h2>Where can I find product information?</h2>
            <p>Product information is available on the product pages of our website. You can also find detailed descriptions, specifications, and reviews for each product there.</p>
        </div>

        <div class="contact-support">
            <h2>Need more help?</h2>
            <p>If you need further assistance, please reach out to our support team.</p>
            <p>Help Center Mobile</p>
            <!-- <a href="contact-us.html">Contact Support</a> -->
        </div>
    </div>
    <?php include_once('includes/foot.php') ?>
</body>
</html>
