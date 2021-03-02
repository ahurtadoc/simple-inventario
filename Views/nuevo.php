<?php require_once 'header.php'?>
    <form action="./nuevo" method="post">

        <div class="mb-3 col-8 offset-2">
            <label for="nombre" class="form-label">Nombre del producto</label>
            <input type="text" class="form-control" required id="nombre" name="nombre">
        </div>

        <div class="mb-3 col-8 offset-2">
            <label for="referencia" class="form-label">Referencia</label>
            <input type="text" class="form-control" required id="referencia" name="referencia">
        </div>

        <div class="mb-3 col-8 offset-2">
            <label for="categoria" class="form-label">Categoria</label>
            <input type="text" class="form-control" required id="categoria" name="categoria">
        </div>

        <div class="mb-3 col-8 offset-2">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" required id="stock" name="stock">
        </div>

        <div class="mb-3 col-2 offset-2">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a class="btn btn-danger" href="./">Cancelar</a>
        </div>
    </form>

<?php require_once 'footer.php' ?>