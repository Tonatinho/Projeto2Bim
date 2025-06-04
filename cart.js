// cart.js

// Função para obter o carrinho do localStorage
function getCart() {
    return JSON.parse(localStorage.getItem('shoppingCart')) || [];
}

// Função para salvar o carrinho no localStorage
function saveCart(cart) {
    localStorage.setItem('shoppingCart', JSON.stringify(cart));
    updateCartCount(); // Atualiza o contador sempre que o carrinho é salvo
}

// Função para adicionar item ao carrinho
function addItemToCart(name, price) {
    let cart = getCart();
    const priceFloat = parseFloat(price); // Garante que o preço seja número
    if (isNaN(priceFloat)) {
        console.error("Preço inválido para o produto:", name);
        return; // Não adiciona se o preço for inválido
    }

    // Verifica se o item já existe no carrinho
    const existingItemIndex = cart.findIndex(item => item.name === name);

    if (existingItemIndex > -1) {
        // Se existe, incrementa a quantidade
        cart[existingItemIndex].quantity += 1;
    } else {
        // Se não existe, adiciona novo item
        cart.push({ name: name, price: priceFloat, quantity: 1 });
    }

    saveCart(cart);
    console.log(`Produto adicionado: ${name}, Preço: ${priceFloat}`); // Log para debug
    
   // Apenas exibe uma mensagem de confirmação sem perguntar ou redirecionar
    showAddToCartAnimation(name);}

// Função para atualizar o contador de itens no ícone do carrinho
function updateCartCount() {
    const cart = getCart();
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.innerText = totalItems;
        console.log("Contador do carrinho atualizado para:", totalItems); // Log para debug
    } else {
        console.error("Elemento 'cart-count' não encontrado.");
    }
}

// Função para inicializar os botões "Adicionar ao carrinho" e o contador
function initializeCatalog() {
    const addCartButtons = document.querySelectorAll('.add-cart-btn');
    addCartButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const name = event.target.getAttribute('data-name');
            const price = event.target.getAttribute('data-price');
            if (name && price) {
                addItemToCart(name, price);
            } else {
                console.error("Botão sem 'data-name' ou 'data-price':", event.target);
            }
        });
    });

    // Atualiza a contagem inicial ao carregar a página
    updateCartCount();
}

// Garante que o DOM esteja carregado antes de executar o script
document.addEventListener('DOMContentLoaded', () => {
    // Verifica se estamos na página do catálogo para inicializar os botões
    if (document.querySelector('.catalogo')) { // Procura por um elemento específico do catálogo
        initializeCatalog();
    }
    // Atualiza o contador em qualquer página que tenha o elemento (como o header)
    updateCartCount();
});

// --- Funções para a página carrinho.html (serão usadas depois) ---

// Função para carregar e exibir itens na página do carrinho
function loadCartPage() {
    const cart = getCart();
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotalElement = document.getElementById('cart-total');

    if (!cartItemsContainer || !cartTotalElement) {
        console.error("Elementos 'cart-items' ou 'cart-total' não encontrados na página do carrinho.");
        return;
    }

    cartItemsContainer.innerHTML = ''; // Limpa a lista atual
    let total = 0;

    if (cart.length === 0) {
        cartItemsContainer.innerHTML = '<p class="empty-cart-message">Seu carrinho está vazio.</p>';
        cartTotalElement.innerText = '0.00';
        return;
    }

    cart.forEach((item, index) => {
        const itemElement = document.createElement('div');
        itemElement.classList.add('cart-item', 'row', 'mb-3', 'align-items-center');
        itemElement.innerHTML = `
            <div class="col-md-5">${item.name}</div>
            <div class="col-md-2">R$ ${item.price.toFixed(2)}</div>
            <div class="col-md-3">
                <div class="quantity-controls">
                    <button class="btn btn-sm btn-secondary" onclick="decrementItem(${index})">-</button>
                    <span class="mx-2">${item.quantity}</span>
                    <button class="btn btn-sm btn-secondary" onclick="incrementItem(${index})">+</button>
                </div>
            </div>
            <div class="col-md-2">
                <button class="btn btn-sm btn-danger" onclick="removeItem(${index})">Remover</button>
            </div>
        `;
        cartItemsContainer.appendChild(itemElement);
        total += item.price * item.quantity;
    });

    cartTotalElement.innerText = total.toFixed(2);
}

// Função para incrementar a quantidade de um item
function incrementItem(index) {
    let cart = getCart();
    if (cart[index]) {
        cart[index].quantity += 1;
        saveCart(cart);
        loadCartPage(); // Recarrega a visualização do carrinho
    }
}

// Função para decrementar a quantidade de um item
function decrementItem(index) {
    let cart = getCart();
    if (cart[index] && cart[index].quantity > 1) {
        cart[index].quantity -= 1;
    } else if (cart[index] && cart[index].quantity === 1) {
        // Se a quantidade for 1, remove o item
        cart.splice(index, 1);
    } else {
        return; // Não faz nada se o item não existir ou quantidade já for 0
    }
    saveCart(cart);
    loadCartPage(); // Recarrega a visualização do carrinho
}

// Função para remover um item completamente
function removeItem(index) {
    let cart = getCart();
    if (cart[index]) {
        cart.splice(index, 1);
        saveCart(cart);
        loadCartPage(); // Recarrega a visualização do carrinho
    }
}

// Função para finalizar o pedido (será conectada ao PHP)
function checkout() {
    const cart = getCart();
    if (cart.length === 0) {
        alert("Seu carrinho está vazio!");
        return;
    }

    // Prepara os dados para enviar ao PHP
    const orderData = {
        items: cart,
        total: cart.reduce((sum, item) => sum + item.price * item.quantity, 0)
    };

    // Envia os dados para o script PHP usando fetch API (método POST)
    fetch('processa_pedido.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(orderData),
    })
    .then(response => response.json()) // Espera uma resposta JSON do PHP
    .then(data => {
        if (data.success && data.whatsappUrl) {
            // Limpa o carrinho após o sucesso
            localStorage.removeItem('shoppingCart');
            updateCartCount(); // Zera o contador visual
            // Redireciona para o WhatsApp
            window.location.href = data.whatsappUrl;
        } else {
            alert('Erro ao processar o pedido: ' + (data.message || 'Erro desconhecido'));
        }
    })
    .catch(error => {
        console.error('Erro no fetch:', error);
        alert('Ocorreu um erro ao tentar finalizar o pedido. Verifique o console para mais detalhes.');
    });
}

// Adiciona listener para a página do carrinho, se aplicável
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('cart-items')) { // Verifica se está na página do carrinho
        loadCartPage();

        // Adiciona listener ao botão "Fechar Pedido"
        const checkoutButton = document.getElementById('checkout-button');
        if (checkoutButton) {
            checkoutButton.addEventListener('click', checkout);
        }
    }
});


function showAddToCartAnimation(productName) {
    const toast = document.createElement('div');
    toast.className = 'cart-toast';
    toast.innerHTML = `<i class="bi bi-cart-check-fill"></i> "${productName}" adicionado ao carrinho!`;
    document.body.appendChild(toast);

    // Dispara o efeito e remove depois
    setTimeout(() => {
        toast.classList.add('show');
    }, 10);
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 2000);
}
