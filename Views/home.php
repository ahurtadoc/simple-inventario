<?php require_once 'header.php'?>
<table class="table table-hover">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Referencia</th>
        <th>Categoría</th>
        <th>Stock</th>
        <th>Editar</th>
        <th>Vender</th>
        <th>Eliminar</th>
    </tr>
    </thead>
    <tbody>
    <?php  foreach ($productos as $key):?>
        <tr>
            <td><?php echo $key["nombre"];?></td>
            <td><?php echo $key["referencia"];?></td>
            <td><?php echo $key["categoria"];?></td>
            <td><?php echo $key["stock"];?></td>
            <td>
                <form action="./actualizar" method="post">
                    <button class="btn btn-primary" name="ID" value="<?php echo $key["ID"]?>">Editar</button>
                </form>
            </td>
            <td>
                <form action="./vender" method="post">
                    <button class="btn btn-secondary" name="ID" value="<?php echo $key["ID"]?>">Vender</button>
                </form>
            </td>
            <td>
                <form action="./eliminar" method="post">
                    <button class="btn btn-danger" name="ID" value="<?php echo $key["ID"]?>">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php require_once 'footer.php' ?>
