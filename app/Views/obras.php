<?= view('header') ?>

<div class="container">
    <h1 class="text-center mt-5">Obras</h1>

    <!-- Formulario para crear una nueva obra -->
    <div class="row">
        <div class="col-sm-12 bg-info p-4 text-white">
            <form method="POST" action="<?= site_url('crear-obra') ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <label for="name_obra"><b>Nombre de la Obra:</b></label>
                        <input type="text" name="name_obra" id="name_obra" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="description_obra"><b>Descripción:</b></label>
                        <textarea name="description_obra" id="description_obra" class="form-control"></textarea>
                    </div>
                    <div class="col">
                        <label for="price_obra"><b>Precio:</b></label>
                        <input type="number" step="0.01" name="price_obra" id="price_obra" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="date_creation_obra"><b>Fecha de Creación:</b></label>
                        <input type="date" name="date_creation_obra" id="date_creation_obra" class="form-control">
                    </div>
                    <div class="col">
                        <label for="id_art"><b>Artista:</b></label>
                        <select name="id_art" id="id_art" class="form-control" required>
                            <option value="">Seleccionar Artista</option>
                            <?php if (isset($artistas)): ?>
                                <?php foreach ($artistas as $artista): ?>
                                    <option value="<?= $artista['id_art'] ?>">
                                        <?= $artista['name_art'] ?> <?= $artista['lastname_art'] ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="image_obra"><b>Imagen de la Obra:</b></label>
                        <input type="file" name="image_obra" id="image_obra" class="form-control">
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Listado de obras -->
    <hr>
    <h2 class="text-center">Listado de Obras</h2>
    <p>Total de Obras: <?= $totalObras ?></p>

    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Fecha Creación</th>
                            <th>Artista</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($datos) && is_array($datos)): ?>
                            <?php foreach ($datos as $dato): ?>
                                <tr>
                                    <td>
                                        <img src="<?= base_url(!empty($dato['image_obra']) ? 'uploads/' . $dato['image_obra'] : 'assets/no-image.png') ?>"
                                            alt="Imagen de la obra" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                    </td>
                                    <td><?= esc($dato['name_obra']) ?></td>
                                    <td><?= esc($dato['description_obra']) ?></td>
                                    <td><?= number_format($dato['price_obra'], 2) ?></td>
                                    <td><?= esc($dato['date_creation_obra']) ?></td>
                                    <td><?= esc($dato['name_art'] ?? 'No especificado') ?> <?= esc($dato['lastname_art'] ?? '') ?></td>
                                    <td>
                                        <a href="<?= base_url('obtenerObra/' . $dato['id_obra']) ?>" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <a href="<?= base_url('eliminar-obra/' . $dato['id_obra']) ?>" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">No hay obras disponibles</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= view('footer') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (session()->getFlashdata('mensaje')): ?>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '<?= session()->getFlashdata('mensaje') ?>',
            confirmButtonText: 'Aceptar'
        });
    <?php endif; ?>
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>
