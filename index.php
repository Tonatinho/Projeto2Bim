<?php
// PHP pode ficar vazio aqui, só exemplo
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Corumba Clean</title>

  <link href="css/index.css" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    .minha-navbar {
      background-color: #221c92 !important;
      box-shadow: 0 4px 10px rgb(255, 255, 255);
    }

    .navbar-brand {
      color: rgb(255, 255, 255) !important;
    }

    .nav-link {
      color: rgb(255, 255, 255) !important;
    }

    .nav-link:hover {
      color: rgb(0, 0, 0) !important;
    }

    .active {
      color: rgb(255, 255, 255) !important;
      font-weight: bold;
    }

    .image-container {
      position: relative;
      width: 100%;
      height: 100vh; /* TELA CHEIA */
      overflow: hidden;
    }

    .image-container img {
      position: absolute;
      width: 100%;
      height: 100%;
      object-fit: cover; /* Preenche a tela sem distorcer */
    }

    .botao-sobre-imagem {
      position: absolute;
      bottom: 10%; /* Mais próximo do rodapé */
      left: 50%;
      transform: translateX(-50%);
      background-color: rgb(255, 0, 0);
      color: #fff;
      padding: 14px 28px;
      text-decoration: none;
      border-radius: 8px;
      font-size: 1.2rem;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
    }

    .botao-sobre-imagem:hover {
      background-color: rgba(0, 0, 0, 0.9);
      transform: translateX(-50%) scale(1.05);
    }

    /* Estilização moderna para a seção do mapa */
    .mapa-container {
      padding: 3rem 0;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      position: relative;
      overflow: hidden;
    }

    .mapa-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23221c92' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
      opacity: 0.5;
      z-index: 0;
    }

    .mapa-titulo {
      font-family: 'Poppins', sans-serif;
      color: #221c92;
      font-size: 2.5rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 2rem;
      position: relative;
      z-index: 1;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
    }

    .mapa-titulo::after {
      content: '';
      display: block;
      width: 80px;
      height: 4px;
      background-color: #ff6600;
      margin: 0.5rem auto;
      border-radius: 2px;
    }

    .mapa-wrapper {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 1.5rem;
      position: relative;
      z-index: 1;
    }

    .mapa-frame-container {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border: 8px solid white;
    }

    .mapa-frame-container:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .mapa-frame-container iframe {
      display: block;
      width: 100%;
      height: 500px;
      border: none;
    }

    .mapa-info {
      background-color: #221c92;
      color: white;
      padding: 1.5rem;
      border-radius: 15px;
      margin-top: 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 1rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .mapa-info-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .mapa-info-icon {
      font-size: 1.5rem;
      color: #ff6600;
    }

    .mapa-info-text {
      font-size: 1rem;
      line-height: 1.4;
    }

    .mapa-info-text strong {
      display: block;
      font-size: 1.1rem;
      margin-bottom: 0.25rem;
    }

    @media (max-width: 768px) {
      .mapa-titulo {
        font-size: 2rem;
      }
      
      .mapa-frame-container iframe {
        height: 350px;
      }
      
      .mapa-info {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg minha-navbar">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Corumba Clean</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Página inicial</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#mapa">Saiba Onde Estamos</a>
          </li>
        </ul>

        <div class="d-flex align-items-center gap-3">
          <a href="login.php" class="btn btn-warning">Entre em contato</a>

          <a href="carrinho.php " class="btn btn-light position-relative">
            <i class="bi bi-cart3" style="font-size: 1.2rem;"></i>
            <span id="cart-count"
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              0
            </span>
          </a>
        </div>
      </div>
    </div>
  </nav>

  <div class="image-container">
    <img src="images/Design sem nome.png" alt="Imagem de destaque" />
    <a href="catalogo.php" class="botao-sobre-imagem">
      <i class="bi bi-card-list"></i>
      Catálogo de Produtos
    </a>
  </div>

  <!-- Seção do Mapa Estilizada -->
  <section class="mapa-container">
    <div class="mapa-wrapper">
      <h2 id="mapa" class="mapa-titulo">Localização da nossa loja</h2>
      <div class="mapa-frame-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3643.348867576904!2d-52.418592223774155!3d-24.054016179877955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ed75bcea25dfd9%3A0x7e9afaa1769b037!2sR.%20Pav%C3%A3o%2C%20389%20-%20Jardim%20Pio%20XII%2C%20Campo%20Mour%C3%A3o%20-%20PR%2C%2087306-300!5e0!3m2!1spt-BR!2sbr!4v1748111452383!5m2!1spt-BR!2sbr" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <div class="mapa-info">
        <div class="mapa-info-item">
          <i class="bi bi-geo-alt-fill mapa-info-icon"></i>
          <div class="mapa-info-text">
            <strong>Endereço</strong>
            Rua Pavão, 389 - Jardim Pio XII, Campo Mourão - PR
          </div>
        </div>
        <div class="mapa-info-item">
          <i class="bi bi-clock-fill mapa-info-icon"></i>
          <div class="mapa-info-text">
            <strong>Horário de Funcionamento</strong>
            Segunda a Sexta: 8h às 18h | Sábado: 8h às 12h
          </div>
        </div>
        <div class="mapa-info-item">
          <i class="bi bi-telephone-fill mapa-info-icon"></i>
          <div class="mapa-info-text">
            <strong>Contato</strong>
            (44) 9999-9999
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
