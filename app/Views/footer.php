<footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; <?= date('Y') ?> Galería de Arte. Todos los derechos reservados.</p>
    </footer>

    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <?php if (session()->getFlashdata('mensaje')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '<?= session()->getFlashdata('mensaje') ?>',
                confirmButtonText: 'Aceptar'
            });
        </script>
    <?php endif; ?>
</body>
</html>
