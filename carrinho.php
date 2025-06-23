<?php
$pageTitle = 'Carrinho de Compras';
$currentPage = 'carrinho';

$pageStyle = <<<'CSS'
    .cart-container {
        margin-top: 3rem;
        margin-bottom: 4rem;
    }

    .cart-item {
        border-bottom: 1px solid #eee;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-details {
        flex-grow: 1;
    }

    .cart-item-image {
        width: 80px;
        height: 80px;
        object-fit: contain;
        margin-right: 1rem;
    }

    .cart-total {
        margin-top: 2rem;
        font-size: 1.2rem;
        font-weight: bold;
    }

    #checkout-button {
        background-color: #25d366;
        border-color: #25d366;
        color: white;
        font-weight: bold;
        padding: 0.75rem 1.5rem;
        transition: background-color 0.3s ease;
    }

    #checkout-button:hover {
        background-color: #128c7e;
        border-color: #128c7e;
    }

    #continue-shopping-button {
        background-color: #3366cc; /* Azul pouco escuro */
        border-color: #3366cc;
        color: white;
        text-align: center;
    }

    #continue-shopping-button:hover {
        background-color: #264d99; /* Tom mais escuro */
        border-color: #264d99;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
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
        min-width: 30px;
        text-align: center;
        font-weight: bold;
    }

    .remove-item-btn {
        margin-left: auto;
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

$pageScript = <<<'JS'
JS;

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container cart-container mt-4">
    <h2 class="text-center mb-4">Seu Carrinho de Compras</h2>

    <div id="cart-items" class="mb-4">
        <!-- Os itens do carrinho serão inseridos dinamicamente pelo cart.js -->

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
            <a href="catalogo.php" class="btn btn-secondary" id="continue-shopping-button">Continuar Comprando</a>
            <button id="checkout-button" class="btn btn-lg" disabled>
                <i class="bi bi-whatsapp me-2"></i>Fechar Pedido via WhatsApp
            </button>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>
