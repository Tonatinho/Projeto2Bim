<?php
$pageTitle = 'Catálogo de Produtos';
$currentPage = 'catalogo'; // Used to highlight the active nav link

// Page specific styles
$pageStyle = <<<'CSS'
    .catalogo-header {
      /* Adjusted margin to account for fixed navbar */
      margin-top: 2rem; 
    }

    .botoes-catalogo {
      margin: 2rem 0;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
    }

    /* Botões com cor personalizada e efeito */
    .btn-produto {
      background-color: #221c92 !important;
      color: white !important;
      border: none !important;
      transition: transform 0.1s ease, background-color 0.3s ease;
      padding: 0.5rem 1rem;
      font-weight: 600;
    }

    .btn-produto:hover {
      background-color: #160f65 !important;
    }

    .btn-produto:active {
      background-color: #3b36c9 !important;
      transform: scale(0.95);
    }

    /* Estilo para botão ativo/selecionado */
    .btn-produto.ativo {
      background-color: #ff6600 !important; /* Cor laranja para destacar o botão selecionado */
      box-shadow: 0 0 8px rgba(255, 102, 0, 0.5);
      transform: scale(1.05);
    }

    /* PRODUTO-INFO estilo grid e ocultação com display */
    .produto-info {
      max-width: 1200px;
      margin: 2rem auto 4rem;
      display: none;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      justify-items: center;
      text-align: center;
    }

    .produto-info.show {
      display: grid;
    }

    .produto-item {
      max-width: 280px;
    }

    /* Estilo para os cards */
    .card {
      width: 100%;
      max-width: 280px;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgb(0 0 0 / 0.1);
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: scale(1.05);
    }

    .card-img-top {
      width: 100%;
      height: 280px;
      object-fit: contain;
      cursor: pointer; /* Optional: Indicate images are clickable if they link somewhere */
    }

    .card-title {
      font-weight: bold;
      font-size: 1.1rem;
    }

    .card-text {
      font-style: italic;
      color: #555;
      min-height: 1.5rem; /* Ensure consistent height */
    }

    /* Texto em cima do grid (descrição comum) */
    .descricao-geral {
      grid-column: 1 / -1;
      font-weight: 600;
      margin-bottom: 1rem;
      text-align: center;
    }

    /* Estilo específico para o botão de adicionar ao carrinho */
    .add-cart-btn {
      margin-top: 10px;
      width: 100%;
      background-color: #221c92 !important;
      border-color: #221c92 !important;
    }

    .add-cart-btn:hover {
      background-color: #160f65 !important;
      border-color: #160f65 !important;
    }
CSS;

// Page specific script
$pageScript = <<<'JS'
<script>
// Função para mostrar/esconder produtos por categoria
function toggleProduto(id, botaoClicado) {
  // Esconde todas as seções de produto
  document.querySelectorAll('.produto-info').forEach(div => {
    div.classList.remove('show');
    div.setAttribute('aria-hidden', 'true');
  });

  // Remove a classe 'ativo' de todos os botões de produto
  document.querySelectorAll('.btn-produto').forEach(btn => {
    btn.classList.remove('ativo');
  });

  // Mostra a seção de produto clicada
  const produtoDiv = document.getElementById(id);
  if (produtoDiv) {
    produtoDiv.classList.add('show');
    produtoDiv.setAttribute('aria-hidden', 'false');
  }

  // Adiciona a classe 'ativo' ao botão clicado
  if (botaoClicado) {
      botaoClicado.classList.add('ativo');
  }
}

// Initialize cart functionality (from cart.js, called after DOM is ready)
document.addEventListener('DOMContentLoaded', () => {
    // You might want to automatically show the first category or none
    // Example: Show the first category by default
    // const firstButton = document.querySelector('.btn-produto');
    // if (firstButton) {
    //     const firstProductId = firstButton.id.replace('btn-', '');
    //     toggleProduto(firstProductId, firstButton);
    // }
});
</script>
JS;

include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- Main Content Area -->
<section id="catalogo" class="container mt-4">
    <div class="catalogo-header text-center">
      <h2>Catálogo Completo</h2>
    </div>

    <div class="text-center">
      <div class="botoes-catalogo">
        <button id="btn-limpador" class="btn-produto btn" onclick="toggleProduto('limpador', this)">Limpador Perfumado</button>
        <button id="btn-detergente" class="btn-produto btn" onclick="toggleProduto('detergente', this)">Detergente Lava Louças</button>
        <button id="btn-alcool" class="btn-produto btn" onclick="toggleProduto('alcool', this)">Álcool Perfumado</button>
        <button id="btn-aromatizador" class="btn-produto btn" onclick="toggleProduto('aromatizador', this)">Aromatizador</button>
        <button id="btn-limpaQuerosene" class="btn-produto btn" onclick="toggleProduto('limpaQuerosene', this)">Limpa piso Querosene</button>
        <button id="btn-detergentePerfumado" class="btn-produto btn" onclick="toggleProduto('detergentePerfumado', this)">Sabonete Perfumado</button>
        <button id="btn-multiuso" class="btn-produto btn" onclick="toggleProduto('multiuso', this)">Desengordurante Multiuso</button>
        <button id="btn-amaciante" class="btn-produto btn" onclick="toggleProduto('amaciante', this)">Amaciante de roupas</button>
        <button id="btn-alvejante" class="btn-produto btn" onclick="toggleProduto('alvejante', this)">Alvejante sem cloro</button>
        <button id="btn-aguaSanitaria" class="btn-produto btn" onclick="toggleProduto('aguaSanitaria', this)">Água Sanitária</button>
      </div>

      <!-- Limpador Perfumado -->
      <div id="limpador" class="produto-info" aria-hidden="true">
        <p class="descricao-geral">✔ Ideal para pisos e superfícies lisas.<br>✔ Fragrância suave e duradoura.</p>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Limpador Perfumado 5L
            </div>
            <!-- Assuming images folder is accessible from where PHP files are run -->
            <img src="images/Limpador perfumado 5L/WhatsApp Image 2025-03-04 at 10.51.06.jpeg" alt="Algas" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Cheiro de Algas frescas</h5>
              <p class="card-text">R$20,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Limpador Algas" data-price="20.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Limpador Perfumado 5L
            </div>
            <img src="images/Limpador perfumado 5L/WhatsApp Image 2025-03-04 at 11.04.08.jpeg" alt="Talco" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Cheiro suave de Talco</h5>
              <p class="card-text">R$20,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Limpador Talco" data-price="20.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Limpador Perfumado 5L
            </div>
            <img src="images/Limpador perfumado 5L/WhatsApp Image 2025-03-04 at 12.40.46.jpeg" alt="Campestre" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Cheiro campestre natural</h5>
              <p class="card-text">R$20,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Limpador Campestre" data-price="20.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Limpador Perfumado 5L
            </div>
            <img src="images/Limpador perfumado 5L/WhatsApp Image 2025-03-04 at 12.41.53.jpeg" alt="Floral" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Cheiro floral delicado</h5>
              <p class="card-text">R$20,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Limpador Floral" data-price="20.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Limpador Perfumado 5L
            </div>
            <img src="images/Limpador perfumado 5L/WhatsApp Image 2025-03-04 at 12.42.22.jpeg" alt="Lavanda" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Cheiro calmante de Lavanda</h5>
              <p class="card-text">R$20,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Limpador Lavanda" data-price="20.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Detergente Lava Louças -->
      <div id="detergente" class="produto-info" aria-hidden="true">
        <p class="descricao-geral">✔ Poder desengordurante.<br>✔ Suave para as mãos.</p>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Detergente 5L
            </div>
            <img src="images/Detergente Lava louças 5L/WhatsApp Image 2025-03-04 at 10.42.29.jpeg" alt="Detergente 5L 1" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Lava Louças Pêssego</h5>
              <p class="card-text">R$27,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Detergente 5L 1" data-price="27.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Detergente 5L
            </div>
            <img src="images/Detergente Lava louças 5L/WhatsApp Image 2025-03-04 at 11.54.49.jpeg" alt="Detergente 5L 2" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Lava Louças Neutro</h5>
              <p class="card-text">R$27,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Detergente 5L 2" data-price="27.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Detergente 2L
            </div>
            <img src="images/Detergente Lava louças 2L/WhatsApp Image 2025-03-04 at 11.50.43.jpeg" alt="Detergente 2L 1" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Lava Louças Neutro</h5>
              <p class="card-text">R$14,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Detergente 2L 1" data-price="14.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Detergente 2L
            </div>
            <img src="images/Detergente Lava louças 2L/WhatsApp Image 2025-03-04 at 11.53.45.jpeg" alt="Detergente 2L 2" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Lava Louças Pêssego</h5>
              <p class="card-text">R$14,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Detergente 2L 2" data-price="14.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Álcool Perfumado -->
      <div id="alcool" class="produto-info" aria-hidden="true">
        <p class="descricao-geral">✔ Ação desinfetante.<br>✔ Aroma agradável.</p>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Álcool Perfumado
            </div>
            <img src="images/Alcool Perfumado 5L/WhatsApp Image 2025-03-04 at 10.37.34.jpeg" alt="Álcool 1" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Fragrância suave</h5>
              <p class="card-text">R$30,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Álcool Perfumado 1" data-price="30.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Álcool Perfumado
            </div>
            <img src="images/Alcool Perfumado 5L/WhatsApp Image 2025-03-04 at 10.38.22.jpeg" alt="Álcool 2" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Fragrância suave</h5>
              <p class="card-text">R$30,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Álcool Perfumado 2" data-price="30.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Álcool Perfumado
            </div>
            <img src="images/Alcool Perfumado 5L/WhatsApp Image 2025-03-04 at 10.44.55.jpeg" alt="Álcool 3" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Fragrância suave</h5>
              <p class="card-text">R$30,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Álcool Perfumado 3" data-price="30.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Aromatizador -->
      <div id="aromatizador" class="produto-info" aria-hidden="true">
        <p class="descricao-geral">✔ Deixa o ambiente mais agradável.<br>✔ Diversas fragrâncias disponíveis.</p>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Aromatizador
            </div>
            <img src="images/Aromatizante 250ml/WhatsApp Image 2025-03-04 at 11.40.02.jpeg" alt="Aromatizador 1" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Cheiro puro de Maresia</h5>
              <p class="card-text">R$14,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Aromatizador 1" data-price="14.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Aromatizador
            </div>
            <img src="images/Aromatizante 250ml/WhatsApp Image 2025-03-04 at 11.40.27.jpeg" alt="Aromatizador 2" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Cheiro leve de Bambu</h5>
              <p class="card-text">R$14,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Aromatizador 2" data-price="14.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Aromatizador
            </div>
            <img src="images/Aromatizante 250ml/WhatsApp Image 2025-03-04 at 11.42.37.jpeg" alt="Aromatizador 3" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Cheiro vibrante de Citruz</h5>
              <p class="card-text">R$14,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Aromatizador 3" data-price="14.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Limpa piso Querosene -->
      <div id="limpaQuerosene" class="produto-info" aria-hidden="true">
        <p class="descricao-geral">✔ Ideal para limpeza pesada de pisos.<br>✔ A base de querosene com aroma controlado.</p>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Limpa Piso Querosene 5L
            </div>
            <img src="images/Limpa piso querosene  5L/WhatsApp Image 2025-03-04 at 12.11.48.jpeg" alt="Limpa Piso Querosene" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Limpeza profunda com querosene</h5>
              <p class="card-text">R$35,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Limpa Piso Querosene" data-price="35.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Detergente Perfumado -->
      <div id="detergentePerfumado" class="produto-info" aria-hidden="true">
        <p class="descricao-geral">✔ Combina limpeza eficaz com fragrância suave.</p>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Sabonete Perfumado 500ml
            </div>
            <img src="images/Detergente perfumado 500m/WhatsApp Image 2025-03-04 at 12.47.57.jpeg" alt="Detergente Perfumado" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Fragrâncias leves: Chá Verde, Floral, Algodão, Baby e Erva Doce</h5>
              <p class="card-text">R$11,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Detergente Perfumado" data-price="11.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Desengordurante Multiuso -->
      <div id="multiuso" class="produto-info" aria-hidden="true">
        <p class="descricao-geral">✔ Remove gordura e sujeiras difíceis em diversas superfícies.</p>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Desengordurante Multiuso
            </div>
            <img src="images/Desengordurante Multiuso 1L/WhatsApp Image 2025-03-04 at 11.45.32.jpeg" alt="Desengordurante Multiuso" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Força multiuso contra a gordura</h5>
              <p class="card-text">R$15,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Desengordurante Multiuso" data-price="15.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Amaciante de roupas -->
      <div id="amaciante" class="produto-info" aria-hidden="true">
        <p class="descricao-geral">✔ Deixa as roupas mais macias e perfumadas.</p>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Amaciante de Roupas
            </div>
            <img src="images/Amaciante de Roupas 5L/WhatsApp Image 2025-03-04 at 11.00.03.jpeg" alt="Amaciante 1" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Maciez envolvente de Confortemp</h5>
              <p class="card-text">R$27,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Amaciante de Roupas 1" data-price="27.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Amaciante de Roupas
            </div>
            <img src="images/Amaciante de Roupas 5L/WhatsApp Image 2025-03-04 at 11.05.44.jpeg" alt="Amaciante 2" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Cheiro suave e fresco de Blue</h5>
              <p class="card-text">R$27,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Amaciante de Roupas 2" data-price="27.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Alvejante sem cloro -->
      <div id="alvejante" class="produto-info" aria-hidden="true">
        <p class="descricao-geral">✔ Clareia tecidos sem danificar cores.<br>✔ Não contém cloro.</p>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Alvejante sem cloro
            </div>
            <img src="images/Alvejante sem cloro 5L/WhatsApp Image 2025-03-04 at 11.24.36.jpeg" alt="Alvejante sem cloro" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Limpa e cuida com segurança todos os dias</h5>
              <p class="card-text">R$28,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Alvejante sem cloro" data-price="28.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Água Sanitária -->
      <div id="aguaSanitaria" class="produto-info" aria-hidden="true">
        <p class="descricao-geral">✔ Desinfecção eficaz para diversas superfícies.<br>✔ Elimina germes e bactérias.</p>
        
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Água Sanitária 5L
            </div>
            <img src="images/Água sanitária 5L e 2L/WhatsApp Image 2025-03-04 at 11.20.01.jpeg" alt="Água Sanitária 5L" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Força pura na limpeza</h5>
              <p class="card-text">R$20,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Água Sanitária 5L" data-price="20.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
        <div class="produto-item">
          <div class="card">
            <div class="card-header">
              Água Sanitária 2L
            </div>
            <img src="images/Água sanitária 5L e 2L/WhatsApp Image 2025-03-04 at 11.15.02.jpeg" alt="Água Sanitária 2L" class="card-img-top" />
            <div class="card-body">
              <h5 class="card-title">Força pura na limpeza</h5>
              <p class="card-text">R$9,00</p>
              <button class="btn btn-sm btn-primary add-cart-btn" data-name="Água Sanitária 2L" data-price="9.00">Adicionar ao carrinho</button>
            </div>
          </div>
        </div>
      </div>

    </div>
</section>

<?php
include 'includes/footer.php';
?>

