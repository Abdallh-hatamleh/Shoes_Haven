<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/cart.css">
    <script src="cart.js" defer></script>
</head>
<body>
    <!-- Button to trigger the sidebar -->
    <button id="cartButton" class="btn btn-primary">Open Cart</button>

    <!-- Sidebar -->
    <div class="cart-sidebar">
        <div class="cart-header">
            <div class="left">
                <button class="close-btn">&times;</button>
                <h3>Cart</h3>
            </div>
            <img src="ShopCart.png">
        </div>

        <div class="cart-body">
            <div class="cart-item">
                <img src="sand.png" alt="Sands">
                <div class="item-details">
                    <h4>Cleaner Sands</h4>
                    <p>JOD 106</p>
                    <div class="quantity-control">
                        <button class="decrease">-</button>
                        <input type="text" value="1">
                        <button class="increase">+</button>
                    </div>
                </div>
            </div>

            <div class="order-summary">
                <h4>Order Summary</h4>
                <p>Subtotal: <span>JOD 106</span></p>
                <p>Delivery charges: <span>JOD 3</span></p>
                <p>Total: <span>JOD 109</span></p>
            </div>
            
            <div class="cart-footer">
                <button class="checkout-btn">Checkout</button>
                <button class="continue-shopping-btn">Continue Shopping</button>
            </div>
        </div>
    </div>
</body>
</html>