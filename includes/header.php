<?php
// Define a default title if not set
$pageTitle = isset($pageTitle) ? $pageTitle : 'Corumba Clean';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    /* Common styles */
    body { 
        /* padding-top: 70px; REMOVED to match index.php navbar behavior */
        padding-bottom: 20px; /* Add some bottom padding */
    }
    .minha-navbar {
      background-color: #221c92 !important;
      box-shadow: 0 4px 10px rgb(255, 255, 255); /* Matched with index.php */
      /* REMOVED fixed positioning to match index.php navbar behavior
      position: fixed; 
      top: 0;
      width: 100%;
      z-index: 1030;
      */
    }
    .navbar-brand,
    .nav-link {
      color: white !important;
    }
    .nav-link:hover {
      color: rgb(0, 0, 0) !important; /* Matched with index.php */
    }
    .active {
      color: rgb(255, 255, 255) !important; /* Added from index.php */
      font-weight: bold; /* Added from index.php */
    }
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
    }
     .cart-toast {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background-color: #221c92;
      color: #fff;
      padding: 12px 20px;
      border-radius: 8px;
      box-shadow: 0 0 12px rgba(0,0,0,0.3);
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.3s ease, transform 0.3s ease;
      z-index: 9999;
      font-weight: 500;
    }
    .cart-toast.show {
      opacity: 1;
      transform: translateY(0);
    }
    .cart-toast i {
      margin-right: 8px;
    }
    /* Placeholder for page-specific styles */
    <?php if (isset($pageStyle)) { echo $pageStyle; } ?>
  </style>
</head>
<body>


