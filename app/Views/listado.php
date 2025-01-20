<?= view('header') ?>

<div class="container">
    <h1 class="text-center mt-5">Artistas</h1>

    <!-- Formulario para agregar artista -->
    <div class="row">
        <div class="col-sm-12" style="background-color: cadetblue; padding: 20px">
            <form method="POST" action="<?= site_url('crear') ?>" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="name_art"><b>Nombre:</b></label>
                        <input type="text" name="name_art" id="name_art" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="lastname_art"><b>Apellido:</b></label>
                        <input type="text" name="lastname_art" id="lastname_art" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nationality_art"><b>Nacionalidad:</b></label>
                        <input type="text" name="nationality_art" id="nationality_art" class="form-control">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="description_art"><b>Descripción:</b></label>
                        <input type="text" name="description_art" id="description_art" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email_art"><b>Email:</b></label>
                        <input type="email" name="email_art" id="email_art" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label for="image_art"><b>Imagen:</b></label>
                    <input type="file" name="image_art" id="image_art" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>

    <hr>
    <h2 class="text-center">Listado de Artistas</h2>
    <p>Total de Artistas: <?= $totalArtistas ?></p>

    <!-- Tabla de artistas -->
    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Descripción</th>
                    <th>Nacionalidad</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($datos) && is_array($datos)): ?>
                    <?php foreach ($datos as $dato): ?>
                        <tr>
                            <td>
                                <img src="<?= base_url(!empty($dato['image_art']) ? 'uploads/' . $dato['image_art'] : 'assets/no-image.png') ?>"
                                    alt="Imagen del artista" class="img-thumbnail"
                                    style="width: 100px; height: 100px; object-fit: cover;">
                            </td>
                            <td><?= esc($dato['name_art']) ?></td>
                            <td><?= esc($dato['lastname_art']) ?></td>
                            <td><?= esc($dato['description_art']) ?></td>
                            <td><?= esc($dato['nationality_art']) ?></td>
                            <td><?= esc($dato['email_art']) ?></td>
                            <td>
                                <a href="<?= base_url('obtenerArtista/' . $dato['id_art']) ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="<?= base_url('eliminar/' . $dato['id_art']) ?>" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No hay datos disponibles</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= view('footer') ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (session()->getFlashdata('mensaje')): ?>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '<?= esc(session()->getFlashdata('mensaje')) ?>',
            confirmButtonText: 'Aceptar'
        });
    <?php endif; ?>
</script>
