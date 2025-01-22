<?= view('header') ?>

<style>
    .custom-file {
    display: flex;
    align-items: center;
    gap: 10px;
}
</style>
<div class="container">
    <h1 class="text-center mt-5">Artists</h1>
    <div class="row">
        <div class="col-sm-12" style="background-color: cadetblue; padding: 20px">
            <form method="POST" action="<?= site_url('crear') ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">

                        <b><label for="name_art">Name:</label></b>
                        <input type="text" name="name_art" id="name_art" class="form-control" required>
                    </div>
                    <div class="col">
                        <b><label for="lastname_art">Lastname:</label></b>
                        <input type="text" name="lastname_art" id="lastname_art" class="form-control" required>
                    </div>
                    <div class="col">
                        <b><label for="nationality_art">Nationality:</label></b>
                        <input type="text" name="nationality_art" id="nationality_art" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <b><label for="description_art">Description:</label></b>
                        <input type="text" name="description_art" id="description_art" class="form-control" required>
                    </div>
                    <div class="col">
                        <b><label for="email_art">Email:</label></b>
                        <input type="email" name="email_art" id="email_art" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b><label for="image_art">Image:</label></b>
                        <div class="custom-file">
                            <label for="image_art" id="customLabel" class="form-label">Select an image</label>
                            <input type="file" name="image_art" id="image_art" class="form-control" style="display: none;" required>
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
    <h2 class="text-center">List of Artists</h2>
    <p class="text-left">Total Artists: <?= $totalArtistas ?></p> 
    <div class="row">
        <div class="col-sm-12">
            <div class="table table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Lastname</th>
                            <th>Description</th>
                            <th>Nationality</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($datos) && is_array($datos)): ?>
                            <?php foreach ($datos as $dato): ?>
                                <tr>
                                    <td>
                                        <?php if (!empty($dato['image_art'])): ?>
                                            <img src="<?= base_url('uploads/' . $dato['image_art']) ?>" alt="Imagen del artista"
                                                class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                                        <?php else: ?>
                                            <img src="<?= base_url('assets/no-image.png') ?>" alt="Sin imagen" class="img-thumbnail"
                                                style="width: 100px; height: 100px; object-fit: cover;">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $dato['name_art'] ?></td>
                                    <td><?= $dato['lastname_art'] ?></td>
                                    <td><?= $dato['description_art'] ?></td>
                                    <td><?= $dato['nationality_art'] ?></td>
                                    <td><?= $dato['email_art'] ?></td>
                                    <td><a href="<?= base_url('obtenerArtista/' . $dato['id_art']) ?>"
                                            class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="<?= base_url('eliminar/' . $dato['id_art']) ?>"
                                            class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a></td>
                                    </td>                                                                            
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Don't exist any artist</td>
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

<!-- Reemplazar el mensaje flash por este script antes de </body> -->
<script>
    <?php if (session()->getFlashdata('mensaje')): ?>
        Swal.fire({
            icon: 'success',
            title: '¡Success!',
            text: '<?= session()->getFlashdata('mensaje') ?>',
            confirmButtonText: 'Acept'
        });
    <?php endif; ?>
</script>

<script>
    document.getElementById('customButton').addEventListener('click', function () {
    document.getElementById('image_art').click();
});

document.getElementById('image_art').addEventListener('change', function () {
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