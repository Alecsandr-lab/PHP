document.addEventListener('DOMContentLoaded', () => {
    const cartBtn = document.querySelector('.add-to-cart');
    const cartCount = document.getElementById('cart-count');
    const searchBtn = document.getElementById('search-btn');
    const searchInput = document.getElementById('search-input');

    let count = 0;

    // Simulate adding to cart
    cartBtn.addEventListener('click', () => {
        count++;
        cartCount.textContent = count;
        
        // Simple feedback
        cartBtn.textContent = "Added!";
        cartBtn.style.background = "#00b894";
        
        setTimeout(() => {
            cartBtn.textContent = "Add to Cart";
            cartBtn.style.background = "#2d3436";
        }, 1000);
    });

    // Simple search alert
    searchBtn.addEventListener('click', () => {
        const query = searchInput.value;
        if(query) {
            alert(`Searching for: ${query}`);
        } else {
            alert("Please enter a search term.");
        }
    });
    
    // 1. Handle the Search Logic
    const performSearch = async (query) => {
        if (!query.trim()) return;

        // Visual feedback: Change button state
        searchBtn.innerHTML = '...'; 
        searchBtn.disabled = true;

        try {
            /**
             * AJAX using the Fetch API. 
             * Replace the URL with your actual endpoint, e.g., '/api/search?q='
             */
            const response = await fetch(`logic/search.php?search=${query}`);
            
            if (!response.ok) throw new Error('Network response was not ok');
            
            // const data = await response.json();
            const data = await response;
            
            // Handle the results (printing to console for this demo)
            console.log('Search Results:', data);
            
            if (data.length > 0) {
                alert(`Success! Found ${data.length} items matching "${query}". Check console for details.`);
            } else {
                alert('No results found.');
            }

        } catch (error) {
            console.log(error)
            console.error('Search failed:', error);
            alert('There was an error processing your search.');
        } finally {
            // Restore button state
            searchBtn.innerHTML = '🔍';
            searchBtn.disabled = false;
        }
    };

    // 2. Event Listener for Button Click
    searchBtn.addEventListener('click', (e) => {
        e.preventDefault(); // Prevents form submission if inside a <form>
        performSearch(searchInput.value);
    });

    // 3. Event Listener for "Enter" Key
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            performSearch(searchInput.value);
        }
    });
});