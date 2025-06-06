<?php
$pageTitle = 'Carrinho de Compras';
$currentPage = 'carrinho'; // Used to highlight the active nav link

// Page specific styles
$pageStyle = <<<'CSS'
    /* Estilos específicos do carrinho */
    .cart-container {
      /* Adjusted margin to account for fixed navbar */
      margin-top: 3rem; 
      margin-bottom: 4rem;
    }

    .cart-item {
      border-bottom: 1px solid #eee;
      padding-bottom: 1rem;
      margin-bottom: 1rem;
      display: flex; /* Use flexbox for better alignment */
      align-items: center; /* Vertically align items */
      gap: 1rem; /* Space between elements */
    }

    .cart-item:last-child {
      border-bottom: none;
    }

    .cart-item-details {
        flex-grow: 1; /* Allow details to take up available space */
    }

    .cart-item-image {
        width: 80px; /* Fixed width for image */
        height: 80px;
        object-fit: contain; /* Ensure image fits well */
        margin-right: 1rem;
    }

    .cart-total {
      margin-top: 2rem;
      font-size: 1.2rem;
      font-weight: bold;
    }

    #checkout-button {
        background-color: #25d366; /* WhatsApp Green */
        border-color: #25d366;
        color: white;
        font-weight: bold;
        padding: 0.75rem 1.5rem;
        transition: background-color 0.3s ease;
    }

    #checkout-button:hover {
        background-color: #128c7e; /* Darker WhatsApp Green */
        border-color: #128c7e;
    }

    /* Estilo para botões de incremento/decremento */
    .quantity-controls {
      display: flex;
      align-items: center;
      /* justify-content: center; /* Align to start instead */
      gap: 0.5rem; /* Space between buttons and quantity */
    }

    .quantity-controls button {
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0;
      line-height: 1;
      font-size: 1rem;
    }

    .item-quantity {
        min-width: 30px; /* Ensure quantity display has some width */
        text-align: center;
        font-weight: bold;
    }

    .remove-item-btn {
        margin-left: auto; /* Push remove button to the right */
    }

    .empty-cart-message {
      text-align: center;
      padding: 3rem 1rem;
      font-size: 1.2rem;
      color: #666;
      border: 2px dashed #ddd;
      border-radius: 8px;
      background-color: #f9f9f9;
    }
CSS;

// Page specific script (Cart functionality is mostly in cart.js, but we might need initialization)
$pageScript = <<<'JS'
<script>
document.addEventListener('DOMContentLoaded', () => {
    // cart.js should handle loading items, calculating total, and checkout
    // Ensure cart.js is correctly included and initialized
    if (typeof initializeCartPage === 'function') {
        initializeCartPage(); // Assuming cart.js has a function to setup the cart page
    } else {
        console.error('initializeCartPage function not found in cart.js');
        // Fallback or error handling if cart.js doesn't load correctly
        const cartItemsDiv = document.getElementById('cart-items');
        if(cartItemsDiv) cartItemsDiv.innerHTML = '<p class="text-danger">Erro ao carregar o carrinho. Verifique o console.</p>';
    }
});
</script>
JS;

include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- Main Content Area - Carrinho -->
<div class="container cart-container mt-4">
    <h2 class="text-center mb-4">Seu Carrinho de Compras</h2>

    <div id="cart-items" class="mb-4">
        <!-- Cart items will be dynamically inserted here by cart.js -->
        <!-- Example structure (to be replaced by JS): -->
        <!-- 
        <div class="cart-item" data-id="product-id">
            <img src="path/to/image.jpg" alt="Product Name" class="cart-item-image">
            <div class="cart-item-details">
                <h5>Product Name</h5>
                <p>Preço: R$ <span class="item-price">10.00</span></p>
                <div class="quantity-controls">
                    <button class="btn btn-sm btn-secondary decrease-quantity">-</button>
                    <span class="item-quantity">1</span>
                    <button class="btn btn-sm btn-secondary increase-quantity">+</button>
                </div>
            </div>
            <p>Subtotal: R$ <span class="item-subtotal">10.00</span></p>
            <button class="btn btn-sm btn-danger remove-item-btn"><i class="bi bi-trash"></i></button>
        </div> 
        -->
        <div class="empty-cart-message">
            <p><i class="bi bi-cart-x" style="font-size: 2rem;"></i></p>
            <p>Seu carrinho está vazio.</p>
            <a href="catalogo.php" class="btn btn-primary">Ver Catálogo</a>
        </div>
    </div>

    <div class="cart-summary border-top pt-3">
        <div class="cart-total text-end mb-3">
            <strong>Total: R$ <span id="cart-total">0.00</span></strong>
        </div>

        <div class="text-center d-flex justify-content-center gap-2 flex-wrap">
            <a href="catalogo.php" class="btn btn-secondary">Continuar Comprando</a>
            <button id="checkout-button" class="btn btn-lg" disabled> <!-- Initially disabled -->
                <i class="bi bi-whatsapp me-2"></i>Fechar Pedido via WhatsApp
            </button>
        </div>
    </div>

</div>

<?php
include 'includes/footer.php';
?>

