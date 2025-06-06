// cart.js

// Função para obter o carrinho do localStorage
function getCart() {
    return JSON.parse(localStorage.getItem("shoppingCart")) || [];
}

// Função para salvar o carrinho no localStorage
function saveCart(cart) {
    localStorage.setItem("shoppingCart", JSON.stringify(cart));
    updateCartCount(); // Atualiza o contador sempre que o carrinho é salvo
    // Also update cart page if currently visible
    if (document.getElementById("cart-items")) {
        loadCartPage();
    }
}

// Função para adicionar item ao carrinho
function addItemToCart(name, price) {
    let cart = getCart();
    const priceFloat = parseFloat(price); // Garante que o preço seja número
    if (isNaN(priceFloat)) {
        console.error("Preço inválido para o produto:", name);
        alert("Erro: Preço inválido para " + name);
        return; // Não adiciona se o preço for inválido
    }

    // Verifica se o item já existe no carrinho
    const existingItemIndex = cart.findIndex(item => item.name === name);

    if (existingItemIndex > -1) {
        // Se existe, incrementa a quantidade
        cart[existingItemIndex].quantity += 1;
    } else {
        // Se não existe, adiciona novo item
        // Find image source from the button's card (assuming standard structure)
        let imageSrc = "images/placeholder.png"; // Default image
        const buttonElement = document.querySelector(`.add-cart-btn[data-name="${name}"]`);
        if (buttonElement) {
            const card = buttonElement.closest(".card");
            if (card) {
                const img = card.querySelector(".card-img-top");
                if (img) {
                    imageSrc = img.getAttribute("src");
                }
            }
        }
        cart.push({ name: name, price: priceFloat, quantity: 1, image: imageSrc });
    }

    saveCart(cart);
    console.log(`Produto adicionado: ${name}, Preço: ${priceFloat}`); // Log para debug
    showAddToCartAnimation(name);
}

// Função para atualizar o contador de itens no ícone do carrinho
function updateCartCount() {
    const cart = getCart();
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const cartCountElement = document.getElementById("cart-count");
    if (cartCountElement) {
        cartCountElement.innerText = totalItems;
        console.log("Contador do carrinho atualizado para:", totalItems); // Log para debug
    } else {
        // console.warn("Elemento 'cart-count' não encontrado."); // Use warn instead of error
    }
}

// Função para inicializar os botões "Adicionar ao carrinho" no catálogo
function initializeCatalog() {
    const addCartButtons = document.querySelectorAll(".add-cart-btn");
    addCartButtons.forEach(button => {
        // Remove previous listeners to avoid duplicates if called multiple times
        button.replaceWith(button.cloneNode(true));
    });
    // Re-select buttons after cloning
    document.querySelectorAll(".add-cart-btn").forEach(button => {
        button.addEventListener("click", (event) => {
            event.preventDefault();
            const name = event.target.getAttribute("data-name");
            const price = event.target.getAttribute("data-price");
            if (name && price) {
                addItemToCart(name, price);
            } else {
                console.error("Botão sem 'data-name' ou 'data-price':", event.target);
            }
        });
    });
    console.log("Botões do catálogo inicializados.");
}

// --- Funções para a página carrinho.php ---

// Função para carregar e exibir itens na página do carrinho
function loadCartPage() {
    const cart = getCart();
    const cartItemsContainer = document.getElementById("cart-items");
    const cartTotalElement = document.getElementById("cart-total");
    const checkoutButton = document.getElementById("checkout-button");
    const emptyCartMessage = document.querySelector(".empty-cart-message"); // Get the empty message element

    if (!cartItemsContainer || !cartTotalElement || !checkoutButton || !emptyCartMessage) {
        // Don't log error here, as this function might be called from saveCart
        // even when not on the cart page.
        // console.error("Elementos essenciais do carrinho não encontrados.");
        return;
    }

    cartItemsContainer.innerHTML = ""; // Limpa a lista atual
    let total = 0;

    if (cart.length === 0) {
        emptyCartMessage.style.display = "block"; // Mostra a mensagem de carrinho vazio
        cartTotalElement.innerText = "0.00";
        checkoutButton.disabled = true; // Desabilita o botão de checkout
    } else {
        emptyCartMessage.style.display = "none"; // Esconde a mensagem de carrinho vazio
        cart.forEach((item, index) => {
            const itemSubtotal = item.price * item.quantity;
            const itemElement = document.createElement("div");
            itemElement.classList.add("cart-item"); // Removed row/col for simpler flex structure
            itemElement.setAttribute("data-index", index); // Add index for easier updates
            itemElement.innerHTML = `
                <img src="${item.image || 'images/placeholder.png'}" alt="${item.name}" class="cart-item-image">
                <div class="cart-item-details">
                    <h5>${item.name}</h5>
                    <p>Preço Unit.: R$ ${item.price.toFixed(2)}</p>
                    <div class="quantity-controls">
                        <button class="btn btn-sm btn-outline-secondary decrease-quantity" data-index="${index}">-</button>
                        <span class="item-quantity mx-2">${item.quantity}</span>
                        <button class="btn btn-sm btn-outline-secondary increase-quantity" data-index="${index}">+</button>
                    </div>
                </div>
                <p class="fw-bold ms-auto me-3">Subtotal: R$ <span class="item-subtotal">${itemSubtotal.toFixed(2)}</span></p>
                <button class="btn btn-sm btn-outline-danger remove-item-btn" data-index="${index}"><i class="bi bi-trash"></i></button>
            `;
            cartItemsContainer.appendChild(itemElement);
            total += itemSubtotal;
        });
        cartTotalElement.innerText = total.toFixed(2);
        checkoutButton.disabled = false; // Habilita o botão de checkout
    }
    console.log("Página do carrinho carregada/atualizada.");
}

// Função para incrementar a quantidade de um item
function incrementItem(index) {
    let cart = getCart();
    if (cart[index]) {
        cart[index].quantity += 1;
        saveCart(cart);
        // No need to call loadCartPage here, saveCart does it if on cart page
    }
}

// Função para decrementar a quantidade de um item
function decrementItem(index) {
    let cart = getCart();
    if (cart[index] && cart[index].quantity > 1) {
        cart[index].quantity -= 1;
        saveCart(cart);
    } else if (cart[index] && cart[index].quantity === 1) {
        // Se a quantidade for 1, remove o item
        removeItem(index); // Call remove function which handles saveCart and reload
    } else {
        return; // Não faz nada se o item não existir
    }
    // No need to call loadCartPage here, saveCart/removeItem does it
}

// Função para remover um item completamente
function removeItem(index) {
    let cart = getCart();
    if (cart[index]) {
        const removedItemName = cart[index].name;
        cart.splice(index, 1);
        saveCart(cart);
        console.log(`Item removido: ${removedItemName}`);
        // No need to call loadCartPage here, saveCart does it
    }
}

// Função para finalizar o pedido (envia para processa_pedido.php)
function checkout() {
    const cart = getCart();
    if (cart.length === 0) {
        alert("Seu carrinho está vazio!");
        return;
    }

    const checkoutButton = document.getElementById("checkout-button");
    checkoutButton.disabled = true; // Disable button during processing
    checkoutButton.innerHTML = 
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processando...';

    // Prepara os dados para enviar ao PHP
    const orderData = {
        items: cart,
        total: cart.reduce((sum, item) => sum + item.price * item.quantity, 0)
    };

    // Envia os dados para o script PHP usando fetch API (método POST)
    fetch("processa_pedido.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(orderData),
    })
    .then(response => {
        if (!response.ok) {
            // Handle HTTP errors (like 404, 500)
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json(); // Espera uma resposta JSON do PHP
    })
    .then(data => {
        if (data.success && data.whatsappUrl) {
            // Limpa o carrinho após o sucesso
            localStorage.removeItem("shoppingCart");
            updateCartCount(); // Zera o contador visual
            loadCartPage(); // Recarrega a visualização do carrinho (mostrar vazio)
            // Redireciona para o WhatsApp
            alert("Pedido pronto para ser enviado via WhatsApp!");
            window.open(data.whatsappUrl, 
            "_blank"); // Open in new tab
            // Reset button after a short delay
            setTimeout(() => {
                 checkoutButton.disabled = false;
                 checkoutButton.innerHTML = '<i class="bi bi-whatsapp me-2"></i>Fechar Pedido via WhatsApp';
            }, 1000);
        } else {
            alert("Erro ao processar o pedido: " + (data.message || "Erro desconhecido do servidor."));
            checkoutButton.disabled = false; // Re-enable button on error
            checkoutButton.innerHTML = '<i class="bi bi-whatsapp me-2"></i>Fechar Pedido via WhatsApp';
        }
    })
    .catch(error => {
        console.error("Erro no fetch ou processamento:", error);
        alert("Ocorreu um erro ao tentar finalizar o pedido. Verifique a conexão ou tente novamente mais tarde.");
        checkoutButton.disabled = false; // Re-enable button on error
        checkoutButton.innerHTML = '<i class="bi bi-whatsapp me-2"></i>Fechar Pedido via WhatsApp';
    });
}

// Função para inicializar a página do carrinho
function initializeCartPage() {
    loadCartPage(); // Carrega os itens iniciais

    // Adiciona listener ao botão "Fechar Pedido"
    const checkoutButton = document.getElementById("checkout-button");
    if (checkoutButton) {
        checkoutButton.addEventListener("click", checkout);
    }

    // Add event listeners for quantity/remove buttons using event delegation
    const cartItemsContainer = document.getElementById("cart-items");
    if (cartItemsContainer) {
        cartItemsContainer.addEventListener("click", (event) => {
            const target = event.target;
            const index = target.getAttribute("data-index") || target.closest("[data-index]")?.getAttribute("data-index");

            if (index === null) return; // Click was not on a relevant element
            const itemIndex = parseInt(index, 10);

            if (target.classList.contains("increase-quantity")) {
                incrementItem(itemIndex);
            } else if (target.classList.contains("decrease-quantity")) {
                decrementItem(itemIndex);
            } else if (target.classList.contains("remove-item-btn") || target.closest(".remove-item-btn")) {
                if (confirm("Tem certeza que deseja remover este item do carrinho?")) {
                    removeItem(itemIndex);
                }
            }
        });
    }
    console.log("Página do carrinho inicializada.");
}

// Função para mostrar animação de adição ao carrinho (Toast)
function showAddToCartAnimation(productName) {
    // Remove existing toasts first
    document.querySelectorAll(".cart-toast").forEach(t => t.remove());

    const toast = document.createElement("div");
    toast.className = "cart-toast";
    toast.innerHTML = `<i class="bi bi-check-circle-fill"></i> "${productName}" adicionado!`;
    document.body.appendChild(toast);

    // Dispara o efeito e remove depois
    setTimeout(() => {
        toast.classList.add("show");
    }, 10); // Short delay to allow CSS transition
    setTimeout(() => {
        toast.classList.remove("show");
        setTimeout(() => toast.remove(), 300); // Remove from DOM after fade out
    }, 2500); // Toast visible for 2.5 seconds
}


// --- Inicialização Geral --- 
document.addEventListener("DOMContentLoaded", () => {
    console.log("DOM carregado. Inicializando scripts...");
    updateCartCount(); // Atualiza o contador em todas as páginas

    // Inicializa funcionalidades específicas da página
    if (document.querySelector("#catalogo")) { // Verifica se está na página do catálogo
        initializeCatalog();
    }
    if (document.getElementById("cart-items")) { // Verifica se está na página do carrinho
        initializeCartPage();
    }
});

