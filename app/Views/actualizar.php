<?= view('header') ?>

<div class="container">
    <h1 class="text-center mt-5">Actualizar Artista</h1>
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" action="<?= base_url('/actualizar'); ?>" enctype="multipart/form-data">
                <input type="text" id="id_art" name="id_art" hidden="" value="<?= $datos[0]['id_art'] ?>">
                <b><label for="name_art">Name:</label></b>
                <input type="text" name="name_art" id="name_art" class="form-control" value="<?= $datos[0]['name_art'] ?>">
                <b><label for="lastname_art">LastName</label></b>
                <input type="text" name="lastname_art" id="lastname_art" class="form-control" value="<?= $datos[0]['lastname_art'] ?>">
                <b><label for="description_art">Description</label></b>
                <input type="text" name="description_art" id="description_art" class="form-control" value="<?= $datos[0]['description_art'] ?>">
                <b><label for="nationality_art">Nationality</label></b>
                <input type="text" name="nationality_art" id="nationality_art" class="form-control" value="<?= $datos[0]['nationality_art'] ?>">
                <b><label for="email_art">Email</label></b>
                <input type="email" name="email_art" id="email_art" class="form-control" value="<?= $datos[0]['email_art'] ?>">
                <div class="form-group">
                    <b><label for="image_art">Imagen Actual:</label></b>
                    <?php if(!empty($datos[0]['image_art'])): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/' . $datos[0]['image_art']) ?>" 
                                 alt="Imagen actual" 
                                 class="img-thumbnail"
                                 style="max-width: 200px;">
                        </div>
                    <?php else: ?>
                        <p>No hay imagen actual</p>
                    <?php endif; ?>
                    <input type="file" name="image_art" id="image_art" class="form-control">
                    <input type="hidden" name="existing_image_art" value="<?= $datos[0]['image_art'] ?>">
                </div>
                <br>
                <button class="btn btn-success">Actualizar</button>
                <a href="<?= base_url('/') ?>" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?= view('footer') ?>