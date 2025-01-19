<?= view('header') ?>

<div class="container">
    <h1 class="text-center mt-5">Actualizar Artista</h1>
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" action="<?= base_url('/actualizarobras'); ?>" enctype="multipart/form-data">
                <input type="text" id="id_obra" name="id_obra" hidden="" value="<?= $datos[0]['id_obra'] ?>">
                <label for="name_obra">Name:</label>
                <input type="text" name="name_obra" id="name_obra" class="form-control" value="<?= $datos[0]['name_obra'] ?>">
                <label for="description_obra">Description</label>
                <input type="text" name="description_obra" id="description_obra" class="form-control" value="<?= $datos[0]['description_obra'] ?>">                
                <b><label for="id_art">Artista:</label></b>                
                <select name="id_art" id="id_art" class="form-control" required>
                    <option value="">Seleccionar Artista</option>
                    <?php if (isset($artistas)): ?>
                        <?php foreach ($artistas as $artista): ?>
                            <option value="<?= $artista['id_art'] ?>" 
                                <?= isset($selectedArtistId) && $selectedArtistId == $artista['id_art'] ? 'selected' : '' ?>>
                                <?= $artista['name_art'] ?> <?= $artista['lastname_art'] ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>

                <b><label for="price_obra">Precio:</label></b>
                <input type="number" step="0.01" name="price_obra" id="price_obra" class="form-control" value="<?= $datos[0]['price_obra'] ?>">
                <b><label for="date_creation_obra">Fecha de Creación:</label></b>
                <input type="date" name="date_creation_obra" id="date_creation_obra" class="form-control" value="<?= $datos[0]['date_creation_obra'] ?>">
                <div class="form-group">
                    <label for="image_obra">Imagen Actual:</label>
                    <?php if(!empty($datos[0]['image_obra'])): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/' . $datos[0]['image_obra']) ?>" 
                                 alt="Imagen actual" 
                                 class="img-thumbnail"
                                 style="max-width: 200px;">
                        </div>
                    <?php else: ?>
                        <p>No hay imagen actual</p>
                    <?php endif; ?>
                    <input type="file" name="image_obra" id="image_obra" class="form-control">
                    <input type="hidden" name="existing_image_obra" value="<?= $datos[0]['image_obra'] ?>">
                </div>
                <br>
                <button class="btn btn-success">Actualizar</button>
                <a href="<?= base_url('/obras') ?>" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?= view('footer') ?>