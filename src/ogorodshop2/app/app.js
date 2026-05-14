document.addEventListener('DOMContentLoaded', () => {
    // --- Элементы интерфейса ---
    const cartSidebar = document.getElementById('cart-sidebar');
    const cartOverlay = document.getElementById('cart-overlay');
    const cartOpenBtn = document.getElementById('cart-open-btn');
    const cartCloseBtn = document.getElementById('cart-close-btn');
    const cartCount = document.getElementById('cart-count');
    const cartItemsList = document.getElementById('cart-items-list');
    const totalPriceEl = document.getElementById('cart-total-price');
    
    // Новые элементы для оформления заказа
    const checkoutBtn = document.querySelector('.checkout-btn'); // Кнопка в корзине
    const checkoutModal = document.getElementById('checkout-modal');
    const modalCloseBtn = document.getElementById('modal-close-btn');
    const checkoutForm = document.getElementById('checkout-form');

    const searchBtn = document.getElementById('search-btn');
    const searchInput = document.getElementById('search-input');
    const productContainer = document.querySelector('.container');

    // --- Логика данных (LocalStorage) ---

    const getCartData = () => JSON.parse(localStorage.getItem('shukoi_cart')) || [];

    const saveCartData = (data) => {
        localStorage.setItem('shukoi_cart', JSON.stringify(data));
        updateGlobalCount();
    };

    const updateGlobalCount = () => {
        const data = getCartData();
        cartCount.textContent = data.length;
    };

    // --- Функции корзины ---

    window.deleteFromCart = (index) => {
        let cartData = getCartData();
        cartData.splice(index, 1);
        saveCartData(cartData);
        renderCart(); 
    };

    const renderCart = () => {
        const cartData = getCartData();
        cartItemsList.innerHTML = '';
        let total = 0;

        if (cartData.length === 0) {
            cartItemsList.innerHTML = '<p class="empty-msg">Корзина пуста</p>';
            totalPriceEl.textContent = '0 ₽';
            // Делаем кнопку оформления неактивной, если корзина пуста
            if(checkoutBtn) checkoutBtn.style.display = 'none';
            return;
        } else {
            if(checkoutBtn) checkoutBtn.style.display = 'block';
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

    const toggleCart = () => {
        cartSidebar.classList.toggle('active');
        cartOverlay.classList.toggle('active');
        if (cartSidebar.classList.contains('active')) {
            renderCart();
        }
    };

    // --- Логика модального окна оформления ---

    const openCheckoutModal = () => {
        // Закрываем корзину перед открытием окна
        cartSidebar.classList.remove('active');
        cartOverlay.classList.remove('active');
        
        // Показываем модалку
        checkoutModal.style.display = 'flex';
    };

    const closeCheckoutModal = () => {
        checkoutModal.style.display = 'none';
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
                            <p class="product-description">
                                ${product.description ? product.description : 'Описание товара скоро появится...'}
                            </p>
                            <div class="product-price">${product.price} ₽</div>
                            <button class="add-to-cart-btn">Добавить</button>
                        </div>
                    `;
                    
                    const addBtn = card.querySelector('.add-to-cart-btn');
                    addBtn.onclick = () => {
                        const cartData = getCartData();
                        cartData.push(product);
                        saveCartData(cartData);
                        
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

    // События для оформления заказа
    if (checkoutBtn) checkoutBtn.addEventListener('click', openCheckoutModal);
    if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeCheckoutModal);
    
    // Закрытие модалки при клике вне её контента
    window.addEventListener('click', (e) => {
        if (e.target === checkoutModal) closeCheckoutModal();
    });

    // Обработка формы
    if (checkoutForm) {
    checkoutForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        // 1. Собираем данные из корзины
        const cartData = getCartData();
        if (cartData.length === 0) {
            alert('Ваша корзина пуста!');
            return;
        }

        // 2. Получаем данные из полей формы
        const formData = new FormData(checkoutForm);
        const orderDetails = {
            customer: {
                name: formData.get('name'),    // Убедитесь, что в HTML у <input> есть name="name"
                phone: formData.get('phone'),  // и name="phone"
                address: formData.get('address')
            },
            items: cartData,
            totalPrice: totalPriceEl.textContent,
            date: new Date().toLocaleString()
        };

        // 3. Отправка данных на сервер (пример через fetch)
        try {
            // Замените 'logic/order.php' на ваш реальный путь к обработчику заказа
          
            const response = await fetch('logic/order.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(orderDetails)
            });
            const result = await response.json();
           

            // Для теста выведем объект заказа в консоль
            console.log('Данные заказа отправлены:', orderDetails);

            alert('Заказ успешно сформирован! Мы свяжемся с вами.');

            // 4. Очистка после успешного заказа
            localStorage.removeItem('shukoi_cart');
            updateGlobalCount();
            checkoutForm.reset(); // Очищаем поля формы
            closeCheckoutModal();
            
        } catch (error) {
            console.error('Ошибка при оформлении заказа:', error);
            alert('Произошла ошибка. Попробуйте еще раз.');
        }
    });
}

    searchBtn.addEventListener('click', (e) => {
        e.preventDefault();
        performSearch(searchInput.value);
    });

    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') performSearch(searchInput.value);
    });

    updateGlobalCount();
});