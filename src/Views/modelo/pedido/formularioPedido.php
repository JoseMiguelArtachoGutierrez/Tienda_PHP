<style>
    <style>
    body {
        background-color: #f0f0f0;
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
    }

    form {
        width: 50%; /* Ajusta el ancho del formulario según tus necesidades */
        margin: 20px auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 10px;
    }

    input[type="text"], input[type="date"], input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #333333;
        color: #ffffff;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #ffffff;
        color: #333333;
    }
</style>
</style>
<h1>Formulario Direccion</h1>
<?php
    $productos=\Controllers\ProductoController::todosLosProductos();

?>
<form action="<?= BASE_URL ?>Pedido/crearPedido" method="post">

    <input type="text" name="data[usuario_id]" value="<?=$_SESSION['identity']->id?>" style="display: none">
    <label>Provincia: </label><input type="text" name="data[provincia]"><br><br>
    <label>Localidad: </label><input type="text" name="data[localidad]"><br><br>
    <label>Direccion: </label><input type="text" name="data[direccion]"><br><br>
    <input type="text" name="data[coste]" value="<?php
        $cantidadTotal=0;
        foreach ($_SESSION['carrito'] as $carrito){
            foreach ($productos as $producto){
                if ($carrito['id']== $producto['id']){
                    $cantidadTotal+=$producto['precio']*$carrito['cantidad'];
                }
            }
        }
        echo $cantidadTotal;

    ?>" style="display: none">
    <input type="date" name="data[fecha]" value="<?= date("Y-m-d"); ?>" style="display: none">
    <input type="text" name="data[hora]" value="<?= date("H:i:s")?>" style="display: none">

    <input type="submit" value="Confirmar Direccion">
</form>