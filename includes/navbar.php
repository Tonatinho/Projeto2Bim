<!-- Navbar -->
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
          <a class="nav-link <?php echo ($currentPage === 'index') ? 'active' : ''; ?>" href="index.php">Página inicial</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($currentPage === 'catalogo') ? 'active' : ''; ?>" href="catalogo.php">Catálogo</a>
        </li>
         <li class="nav-item">
          <a class="nav-link <?php echo ($currentPage === 'login') ? 'active' : ''; ?>" href="login.php">Contato</a>
        </li>
      </ul>

      <div class="d-flex align-items-center gap-3">
        <!-- Contact/Login Button - Adjust link/text as needed -->
        <!-- <a href="login.php" class="btn btn-warning">Entre em contato</a> -->

        <a href="carrinho.php" class="btn btn-light position-relative <?php echo ($currentPage === 'carrinho') ? 'active' : ''; ?>">
          <i class="bi bi-cart3" style="font-size: 1.2rem;"></i>
          <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
            0 <!-- Cart count will be updated by JS -->
          </span>
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- Toast Notification for Cart -->
<div id="cart-toast" class="cart-toast" role="alert" aria-live="assertive" aria-atomic="true">
    <i class="bi bi-check-circle-fill"></i> Item adicionado ao carrinho!
</div>
