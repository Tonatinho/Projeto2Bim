<?php
$pageTitle = 'Formulário de Contato';
$currentPage = 'login'; // Used to highlight the active nav link

// Page specific styles
$pageStyle = <<<'CSS'
    /* Estilo para o container do formulário */
    .form-container {
      max-width: 600px;
      /* Adjusted margin to account for fixed navbar */
      margin: 3rem auto; 
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    .form-header {
      text-align: center;
      margin-bottom: 2rem;
    }

    .form-header h2 {
      color: #221c92;
      font-weight: 600;
    }

    /* Estilo para os campos de formulário */
    .form-floating {
      margin-bottom: 1.5rem;
    }

    .form-control:focus {
      border-color: #221c92;
      box-shadow: 0 0 0 0.25rem rgba(34, 28, 146, 0.25);
    }

    /* Botão de envio personalizado */
    .btn-enviar {
      background-color: #25d366 !important;
      color: white !important;
      border: none !important;
      transition: transform 0.1s ease, background-color 0.3s ease;
      padding: 0.7rem 1rem;
      font-weight: 600;
      width: 100%;
      margin-top: 1rem;
    }

    .btn-enviar:hover {
      background-color: #128c7e !important;
    }

    .btn-enviar:active {
      background-color: #075e54 !important;
      transform: scale(0.98);
    }

    /* Mensagens de feedback */
    .alert {
      /* display: none; /* Controlled by JS */
      margin-bottom: 1rem;
    }
     #error-alert, #success-alert {
        display: none; /* Initially hidden */
     }

    /* Responsividade para telas menores */
    @media (max-width: 576px) {
      .form-container {
        margin: 2rem 1rem;
        padding: 1.5rem;
      }
    }
CSS;

// Page specific script
$pageScript = <<<'JS'
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Referências aos elementos
  const sugestaoForm = document.getElementById('sugestao-form');
  const nomeInput = document.getElementById('nome');
  const telefoneInput = document.getElementById('telefone');
  const emailInput = document.getElementById('email');
  const mensagemInput = document.getElementById('mensagem');
  const errorAlert = document.getElementById('error-alert');
  const successAlert = document.getElementById('success-alert');

  // Máscara para o campo de telefone
  telefoneInput.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, ''); // Corrected regex escape
    if (value.length > 11) value = value.slice(0, 11);
    
    if (value.length > 2 && value.length <= 6) {
      value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
    } else if (value.length > 6) {
      value = `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7)}`;
    }
    
    e.target.value = value;
  });

  // Validação e envio do formulário
  sugestaoForm.addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Reset validation states
    nomeInput.classList.remove('is-invalid');
    telefoneInput.classList.remove('is-invalid');
    emailInput.classList.remove('is-invalid');
    mensagemInput.classList.remove('is-invalid');
    errorAlert.style.display = 'none';
    successAlert.style.display = 'none';

    // Validação básica
    let isValid = true;
    
    if (!nomeInput.value.trim()) {
      nomeInput.classList.add('is-invalid');
      isValid = false;
    } 
    
    // Corrected phone validation to check length after removing non-digits
    if (!telefoneInput.value.trim() || telefoneInput.value.replace(/\D/g, '').length < 10) { 
      telefoneInput.classList.add('is-invalid');
      isValid = false;
    } 
    
    if (!emailInput.checkValidity() || !emailInput.value.trim()) {
      emailInput.classList.add('is-invalid');
      isValid = false;
    } 
    
    if (!mensagemInput.value.trim()) {
      mensagemInput.classList.add('is-invalid');
      isValid = false;
    } 
    
    if (isValid) {
      // Formulário válido
      successAlert.style.display = 'block';
      
      // Preparar dados para o WhatsApp
      const telefoneWhatsapp = "554499900933"; // Número de WhatsApp configurado
      const nome = encodeURIComponent(nomeInput.value.trim());
      const telefone = encodeURIComponent(telefoneInput.value.trim());
      const email = encodeURIComponent(emailInput.value.trim());
      const mensagem = encodeURIComponent(mensagemInput.value.trim());
      
      // Montar a mensagem para o WhatsApp
      const textoWhatsapp = `Nome: ${nome}%0ATelefone: ${telefone}%0AEmail: ${email}%0AMensagem: ${mensagem}`;
      
      // Redirecionar para o WhatsApp após 1 segundo
      setTimeout(() => {
        window.location.href = `https://wa.me/${telefoneWhatsapp}?text=${textoWhatsapp}`;
        // Optionally reset form after redirect attempt
         // sugestaoForm.reset(); 
         // successAlert.style.display = 'none';
      }, 1000);
    } else {
      // Formulário inválido
      errorAlert.style.display = 'block';
      // Find the first invalid input and focus it (optional)
      const firstInvalid = sugestaoForm.querySelector('.is-invalid');
      if (firstInvalid) {
          firstInvalid.focus();
      }
    }
  });

  // Limpar validação ao digitar
  document.querySelectorAll('input, textarea').forEach(input => {
    input.addEventListener('input', function() {
      this.classList.remove('is-invalid');
    });
  });
});
</script>
JS;

include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- Main Content Area -->
<div class="container mt-4">
    <div class="form-container">
      <div class="form-header">
        <h2>Envie sua mensagem</h2>
        <p class="text-muted">Preencha o formulário abaixo para enviar sua mensagem diretamente para nosso WhatsApp</p>
      </div>

      <!-- Alertas de feedback -->
      <div class="alert alert-danger" id="error-alert" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <span id="error-message">Por favor, preencha todos os campos obrigatórios.</span>
      </div>

      <div class="alert alert-success" id="success-alert" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <span>Formulário validado! Redirecionando para o WhatsApp...</span>
      </div>

      <!-- Formulário de sugestão -->
      <form id="sugestao-form">
        <div class="form-floating">
          <input type="text" class="form-control" id="nome" placeholder="Seu nome completo" required>
          <label for="nome">Nome completo</label>
          <div class="invalid-feedback">
            Por favor, informe seu nome completo.
          </div>
        </div>

        <div class="form-floating">
          <input type="tel" class="form-control" id="telefone" placeholder="(00) 00000-0000" required>
          <label for="telefone">Número de telefone</label>
          <div class="invalid-feedback">
            Por favor, informe um número de telefone válido (mínimo 10 dígitos).
          </div>
        </div>

        <div class="form-floating">
          <input type="email" class="form-control" id="email" placeholder="nome@exemplo.com" required>
          <label for="email">Email</label>
          <div class="invalid-feedback">
            Por favor, informe um email válido.
          </div>
        </div>

        <div class="form-floating">
          <textarea class="form-control" id="mensagem" placeholder="Digite sua mensagem aqui" style="height: 150px" required></textarea>
          <label for="mensagem">Mensagem</label>
          <div class="invalid-feedback">
            Por favor, digite sua mensagem.
          </div>
        </div>

        <button type="submit" class="btn btn-enviar">
          <i class="bi bi-whatsapp me-2"></i>Enviar via WhatsApp
        </button>
      </form>
    </div>
</div>

<?php
include 'includes/footer.php';
?>

