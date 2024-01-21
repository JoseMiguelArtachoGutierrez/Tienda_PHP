<style>
    body {
        background-color: #f4f4f4;
        color: #333333;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }

    h1 {
        background-color: #333333;
        color: #ffffff;
        padding: 10px;
        margin: 0;
        text-align: center;
    }

    table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #dddddd;
    }

    th {
        background-color: #333333;
        color: #ffffff;
    }

    tr:hover {
        background-color: #f0f0f0;
    }

    td>a {
        border: 1px solid #333333;
        text-decoration: none;
        color: #ffffff;
        margin-right: 10px;
        padding: 5px;
        border-radius: 3px;
        background-color: #333333;
        transition: background-color 0.3s;
    }

    a:hover {
        background-color: #eeeeee;
        color: #333333;
    }
    .ultimo{
        display: flex;
    }
</style>
<h1>Gestionar Pedidos</h1>
<?php
if (isset($_SESSION['pedido_modificada'])){
    echo $_SESSION['pedido_modificada']."<br>";
    unset($_SESSION['pedido_modificada']);
}
if (isset($_SESSION['pedido_eliminado'])){
    echo $_SESSION['pedido_eliminado']."<br>";
    unset($_SESSION['pedido_eliminado']);
}
if (isset($_SESSION['linea_pedido_eliminado'])){
    echo $_SESSION['linea_pedido_eliminado']."<br>";
    unset($_SESSION['linea_pedido_eliminado']);
}
?>
<table>
    <tr>
        <th>Usuario</th>
        <th>Provincia</th>
        <th>Localidad</th>
        <th>Direccion</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Estado</th>
        <th>Gestiones</th>
    </tr>
    <?php
    if (isset($todosLosPedidos)):
        foreach ($todosLosPedidos as $pedido):
            ?>
            <tr>
                <td><?= $pedido['usuario_id'] ?></td>
                <td><?= $pedido['provincia'] ?></td>
                <td><?= $pedido['localidad'] ?></td>
                <td><?= $pedido['direccion'] ?></td>
                <td><?= $pedido['coste'] ?></td>
                <td><?= $pedido['fecha'] ?></td>
                <td><?= $pedido['hora'] ?></td>
                <td><?= $pedido['estado'] ?></td>
                <td class="ultimo">
                    <a href="<?=BASE_URL?>Pedido/enviarPedido/<?= $pedido['id'] ?>">Enviar</a>
                    <a href="<?=BASE_URL?>Pedido/eliminarPedido/<?= $pedido['id'] ?>">Eliminar</a>
                </td>
            </tr>
        <?php
        endforeach;
    endif;
    ?>
</table>