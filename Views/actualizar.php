<?php require_once 'header.php'?>
    <form action="./update/<?php echo $ID?>" method="post">

        <div class="mb-3 col-8 offset-2">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre?>" required>
        </div>

        <div class="mb-3 col-8 offset-2">
            <label for="referencia" class="form-label">Referencia</label>
            <input type="text" class="form-control" id="referencia" name="referencia" value="<?php echo $referencia?>" required>
        </div>

        <div class="mb-3 col-8 offset-2">
            <label for="categoria" class="form-label">Categoria</label>
            <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $categoria?>" required>
        </div>

        <div class="mb-3 col-8 offset-2">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $stock?>" required>
        </div>

        <div class="mb-3 col-2 offset-2">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a class="btn btn-danger" href="./">Cancelar</a>
        </div>
    </form>

<?php require_once 'footer.php' ?>