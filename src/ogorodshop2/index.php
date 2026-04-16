<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern E-Commerce Layout</title>
    <link rel="stylesheet" href="app/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<header class="navbar">
    <div class="logo">LUMINA</div>
    
    <div class="search-container">
        <input type="text" id="search-input" placeholder="Search products...">
        <button id="search-btn">🔍</button>
    </div>

    <div class="nav-actions">
        <button class="icon-btn" title="Cart">🛒 <span id="cart-count">0</span></button>
        <button class="icon-btn" title="Profile">👤</button>
    </div>
</header>

<main class="container">
    <div class="product-card">
        <div class="product-badge">New</div>
        <div class="product-image">
            <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=400&q=80" alt="Product Image">
        </div>
        <div class="product-info">
            <h3 class="product-name">Minimalist Watch</h3>
            <p class="product-category">Accessories</p>
            <div class="product-price">$120.00</div>
            <button class="add-to-cart">Add to Cart</button>
        </div>
    </div>
</main>

<script src="app/app.js"></script>
</body>
</html>