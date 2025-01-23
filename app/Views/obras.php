<?= view('header') ?>

<div class="container">
    <h1 class="text-center mt-5">Artistic Work</h1>
    <div class="row">
        <div class="col-sm-12" style="background-color: cadetblue; padding: 20px">
            <form method="POST" action="<?= site_url('crear-obra') ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <b><label for="name_obra">Name of work:</label></b>
                        <input type="text" name="name_obra" id="name_obra" class="form-control" required>
                    </div>
                    <div class="col">
                        <b><label for="description_obra">Description:</label></b>
                        <textarea name="description_obra" id="description_obra" class="form-control" required></textarea>
                    </div>
                    <div class="col">
                        <b><label for="price_obra">Price:</label></b>
                        <input type="number" step="0.01" name="price_obra" id="price_obra" class="form-control" required>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <b><label for="date_creation_obra">Creation Date:</label></b>
                        <input type="date" name="date_creation_obra" id="date_creation_obra" class="form-control" required>
                    </div>
                    <div class="col">
                        <b><label for="id_art">Artist:</label></b>
                        <select name="id_art" id="id_art" class="form-control" required>
                            <option value="">Select the artist</option>
                            <?php if (isset($artistas)): ?>
                                <?php foreach ($artistas as $artista): ?>
                                    <option value="<?= $artista['id_art'] ?>"><?= $artista['name_art'] ?> <?= $artista['lastname_art'] ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b><label for="image_obra">Image:</label></b>
                        <div class="custom-file">
                            <label for="image_obra" id="customLabel" class="form-label">Select an image</label>
                            <input type="file" name="image_obra" id="image_obra" class="form-control" style="display: none;" required>
                            <button type="button" class="btn btn-primary" id="customButton"><i class="bi bi-image"></i> Select image</button>
                        </div>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
    <hr>
    <h2 class="text-center">List of Works</h2>
    <p class="text-left">Total Works: <?= $totalObras ?></p> <!-- Mostrar el total de artistas -->
    <div class="row">
        <div class="col-sm-12">
            <div class="table table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Creation Date</th>
                            <th>Artist</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($datos) && is_array($datos)): ?>
                            <?php foreach ($datos as $dato): ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($dato['image_obra'])): ?>
                                            <img src="<?= base_url('uploads/' . $dato['image_obra']) ?>" alt="Imagen de la obra"
                                                class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                        <?php else: ?>
                                            <img src="<?= base_url('assets/no-image.png') ?>" alt="Sin imagen" class="img-thumbnail"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $dato['name_obra'] ?></td>
                                    <td><?= $dato['description_obra'] ?></td>
                                    <td><?= number_format($dato['price_obra'], 2) ?></td>
                                    <td><?= $dato['date_creation_obra'] ?></td>
                                    <td><?= $dato['name_art'] ?> <?= $artista['lastname_art'] ?? 'No especificado' ?></td>
                                    <td>
                                        <a href="<?= base_url('obtenerObra/' . $dato['id_obra']) ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                        <a href="<?= base_url('eliminar-obra/' . $dato['id_obra']) ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Don't exist any works</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= view('footer') ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    <?php if (session()->getFlashdata('mensaje')): ?>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '<?= session()->getFlashdata('mensaje') ?>',
            confirmButtonText: 'Acept'
        });
    <?php endif; ?>
</script>

<script>
    document.getElementById('customButton').addEventListener('click', function () {
    document.getElementById('image_obra').click();
});

document.getElementById('image_obra').addEventListener('change', function () {
    const fileName = this.files[0] ? this.files[0].name : "Select a file";
    document.getElementById('customLabel').textContent = fileName;
});

</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

</body>

</html>