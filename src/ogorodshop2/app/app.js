document.addEventListener('DOMContentLoaded', () => {
    // --- Элементы интерфейса ---
    const cartSidebar = document.getElementById('cart-sidebar');
    const cartOverlay = document.getElementById('cart-overlay');
    const cartOpenBtn = document.getElementById('cart-open-btn');
    const cartCloseBtn = document.getElementById('cart-close-btn');
    const cartCount = document.getElementById('cart-count');
    const cartItemsList = document.getElementById('cart-items-list');
    const totalPriceEl = document.getElementById('cart-total-price');
    
    const searchBtn = document.getElementById('search-btn');
    const searchInput = document.getElementById('search-input');
    const productContainer = document.querySelector('.container');

    // --- Логика данных (LocalStorage) ---

    // Получение данных из хранилища
    const getCartData = () => JSON.parse(localStorage.getItem('shukoi_cart')) || [];

    // Сохранение данных в хранилище
    const saveCartData = (data) => {
        localStorage.setItem('shukoi_cart', JSON.stringify(data));
        updateGlobalCount();
    };

    // Обновление цифры на иконке корзины
    const updateGlobalCount = () => {
        const data = getCartData();
        cartCount.textContent = data.length;
    };

    // --- Функции корзины ---

    // Удаление товара (вынесено в window для доступа из HTML-строки)
    window.deleteFromCart = (index) => {
        let cartData = getCartData();
        cartData.splice(index, 1);
        saveCartData(cartData);
        renderCart(); // Перерисовываем список
    };

    // Отрисовка списка товаров в корзине
    const renderCart = () => {
        const cartData = getCartData();
        cartItemsList.innerHTML = '';
        let total = 0;

        if (cartData.length === 0) {
            cartItemsList.innerHTML = '<p class="empty-msg">Корзина пуста</p>';
            totalPriceEl.textContent = '0 ₽';
            return;
        }

        cartData.forEach((item, index) => {
            total += parseFloat(item.price);
            const div = document.createElement('div');
            div.className = 'cart-item';
            div.style.transitionDelay = `${index * 0.05}s`;
            
            div.innerHTML = `
                <div class="cart-item-info">
                    <span class="item-name">${item.name}</span>
                    <span class="item-price">${item.price} ₽</span>
                </div>
                <button class="delete-btn" onclick="deleteFromCart(${index})">
                    &times;
                </button>
            `;
            cartItemsList.appendChild(div);
        });

        totalPriceEl.textContent = `${total} ₽`;
    };

    // Переключение видимости корзины
    const toggleCart = () => {
        cartSidebar.classList.toggle('active');
        cartOverlay.classList.toggle('active');
        if (cartSidebar.classList.contains('active')) {
            renderCart();
        }
    };

    // --- Логика поиска и добавления товаров ---

    const performSearch = async (query) => {
        if (!query.trim()) return;
        searchBtn.textContent = '...';

        try {
            const response = await fetch(`logic/search.php?search=${encodeURIComponent(query)}`);
            const result = await response.json();
            
            productContainer.innerHTML = '';

            if (result.success && result.data.length > 0) {
                result.data.forEach(product => {
                    const card = document.createElement('div');
                    card.className = 'product-card';
                    card.innerHTML = `
                        <div class="product-image">
                            <img src="${product.image || 'https://via.placeholder.com/400'}" alt="${product.name}">
                        </div>
                        <div class="product-info">
                            <h3>${product.name}</h3>
                            <!-- Блок описания -->
                            <p class="product-description">
                                ${product.description ? product.description : 'Описание товара скоро появится...'}
                            </p>
                            <div class="product-price">${product.price} ₽</div>
                            <button class="add-to-cart-btn">Добавить</button>
                        </div>
                    `;
                    
                    // Клик "Добавить в корзину"
                    const addBtn = card.querySelector('.add-to-cart-btn');
                    addBtn.onclick = () => {
                        const cartData = getCartData();
                        cartData.push(product);
                        saveCartData(cartData);
                        
                        // Анимация кнопки
                        addBtn.textContent = 'Добавлено!';
                        addBtn.style.background = '#00b894';
                        setTimeout(() => {
                            addBtn.textContent = 'Добавить';
                            addBtn.style.background = '#2d3436';
                        }, 800);
                    };
                    
                    productContainer.appendChild(card);
                });
            } else {
                productContainer.innerHTML = '<p class="no-results">Ничего не найдено</p>';
            }
        } catch (e) {
            console.error('Ошибка поиска:', e);
        } finally {
            searchBtn.textContent = '🔍';
        }
    };

    // --- Слушатели событий ---

    cartOpenBtn.addEventListener('click', toggleCart);
    cartCloseBtn.addEventListener('click', toggleCart);
    cartOverlay.addEventListener('click', toggleCart);

    searchBtn.addEventListener('click', (e) => {
        e.preventDefault();
        performSearch(searchInput.value);
    });

    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') performSearch(searchInput.value);
    });

    // Инициализация при загрузке
    updateGlobalCount();
});