<?= view('header') ?>

<div class="container">
    <h1 class="text-center mt-5">Update Work</h1>
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" action="<?= base_url('/actualizarobras'); ?>" enctype="multipart/form-data">
                <input type="text" id="id_obra" name="id_obra" hidden="" value="<?= $datos[0]['id_obra'] ?>">
                <b><label for="name_obra">Name:</label></b>
                <input type="text" name="name_obra" id="name_obra" class="form-control" value="<?= $datos[0]['name_obra'] ?>">
                <b><label for="description_obra">Description</label></b>
                <input type="text" name="description_obra" id="description_obra" class="form-control" value="<?= $datos[0]['description_obra'] ?>">                
                <b><label for="id_art">Artist:</label></b>                
                <select name="id_art" id="id_art" class="form-control" required>
                    <option value="">Select Artist</option>
                    <?php if (isset($artistas)): ?>
                        <?php foreach ($artistas as $artista): ?>
                            <option value="<?= $artista['id_art'] ?>" 
                                <?= isset($selectedArtistId) && $selectedArtistId == $artista['id_art'] ? 'selected' : '' ?>>
                                <?= $artista['name_art'] ?> <?= $artista['lastname_art'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <b><label for="price_obra">Price:</label></b>
                <input type="number" step="0.01" name="price_obra" id="price_obra" class="form-control" value="<?= $datos[0]['price_obra'] ?>">
                <b><label for="date_creation_obra">Creation Date:</label></b>
                <input type="date" name="date_creation_obra" id="date_creation_obra" class="form-control" value="<?= $datos[0]['date_creation_obra'] ?>">
                <div class="form-group">
                    <b><label for="image_obra">Actual Image:</label></b>
                    <?php if(!empty($datos[0]['image_obra'])): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/' . $datos[0]['image_obra']) ?>" 
                                 alt="Imagen actual" 
                                 class="img-thumbnail"
                                 style="max-width: 200px;">
                        </div>
                    <?php else: ?>
                        <p>Don't exist actual image</p>
                    <?php endif; ?>
                    <input type="file" name="image_obra" id="image_obra" class="form-control">
                    <input type="hidden" name="existing_image_obra" value="<?= $datos[0]['image_obra'] ?>">
                </div>
                <br>
                <button class="btn btn-success">Update</button>
                <a href="<?= base_url('/obras') ?>" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?= view('footer') ?>