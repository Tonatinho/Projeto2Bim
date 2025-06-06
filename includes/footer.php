<!-- Footer -->
<footer class="container text-center mt-5 py-3 border-top">
    <p>&copy; <?php echo date("Y"); ?> Corumba Clean. Todos os direitos reservados.</p>
</footer>

<!-- Scripts Bootstrap and Cart -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include cart.js - Make sure the path is correct relative to the final PHP files -->
<!-- Assuming cart.js is in the same directory as the PHP files -->
<script src="cart.js"></script>
<?php
// Placeholder for page-specific scripts
if (isset($pageScript)) {
    echo $pageScript;
}
?>
</body>
</html>
