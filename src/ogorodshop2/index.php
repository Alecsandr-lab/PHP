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
        <!-- Добавлен ID: cart-open-btn -->
        <button class="icon-btn" id="cart-open-btn" title="Cart">🛒 <span id="cart-count">0</span></button>
        <button class="icon-btn" title="Profile">👤</button>
    </div>
</header>

<!-- Затемнение фона -->
<div class="cart-overlay" id="cart-overlay"></div>

<!-- Выезжающее меню корзины -->
<aside class="cart-sidebar" id="cart-sidebar">
    <div class="cart-header">
        <h2>Корзина</h2>
        <button class="close-btn" id="cart-close-btn">&times;</button>
    </div>
    <div class="cart-body" id="cart-items-list">
        <!-- Сюда JS будет рендерить товары -->
    </div>
    <div class="cart-footer">
        <div class="total-row">
            <span>Итого:</span>
            <span id="cart-total-price">0 ₽</span>
        </div>
        <button class="checkout-btn">Оформить заказ</button>
    </div>
</aside>

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

<!-- Модальное окно оформления заказа -->
<div class="checkout-modal-overlay" id="checkout-modal">
    <div class="checkout-modal-content">
        <button class="close-modal" id="close-checkout">&times;</button>
        <h2>Оформление заказа</h2>
        <form id="checkout-form">
            <div class="form-group">
                <label>Ваше имя</label>
                <input type="text" name="name" placeholder="Введите имя" required>
            </div>
            <div class="form-group">
                <label>Телефон</label>
                <input type="tel" name="phone" placeholder="+7 (___) ___-__-__" required>
            </div>
            <div class="form-group">
                <label>Адрес доставки</label>
                <textarea placeholder="Город, улица, дом..." name="address" required></textarea>
            </div>
            <button type="submit" class="confirm-order-btn">Подтвердить покупку</button>
        </form>
    </div>
</div>

<script src="app/app.js"></script>
</body>
</html>