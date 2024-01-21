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
</style>
<h1>Mis Pedidos</h1>
<?php
if (isset($_SESSION['pedido_creado'])){
    echo $_SESSION['pedido_creado']."<br>";
    unset($_SESSION['pedido_creado']);
}
if (isset($_SESSION['linea_pedido_creado'])){
    echo $_SESSION['linea_pedido_creado']."<br>";
    unset($_SESSION['linea_pedido_creado']);
}

?>

<table>
    <tr>
        <th>Provincia</th>
        <th>Direccion</th>
        <th>Localidad</th>
        <th>Coste</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Estado</th>
    </tr>
    <?php
    if (isset($misPedidos)):
        foreach ($misPedidos as $pedido):
    ?>
        <tr>
            <td><?= $pedido['provincia'] ?></td>
            <td><?= $pedido['direccion'] ?></td>
            <td><?= $pedido['localidad'] ?></td>
            <td><?= $pedido['coste'] ?></td>
            <td><?= $pedido['fecha'] ?></td>
            <td><?= $pedido['hora'] ?></td>
            <td><?= $pedido['estado'] ?></td>
        </tr>
    <?php
        endforeach;
        endif;
    ?>
</table>