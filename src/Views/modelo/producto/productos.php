<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TiendaAcA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body>h1 {
            text-align: center;
            color: #333;
        }

        div {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        div img {
            width: 50px; /* Puedes ajustar el tamaño según tus necesidades */
            height: 50px; /* Puedes ajustar el tamaño según tus necesidades */
            margin-right: 10px;
        }

        h3, p {
            margin: 0;
            color: #333;
        }

        a {
            color: #333;
            text-decoration: none;
            padding: 5px 10px;
            background-color: #333;
            color: #fff;
            border-radius: 3px;
        }

        a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
<?php
    if (isset($mostrarEstaCategoria) && $mostrarEstaCategoria=="Esta Categoria no existe"){echo "<br>".$mostrarEstaCategoria;}
?>
<h1>Productos</h1>

<?php
    $productos= Controllers\ProductoController::todosLosProductos();

    echo "<br>";
    if (!isset($mensajeProducto)):
    foreach ($productos as $producto):
        $mostrar=true;
        if (isset($mostrarEstaCategoria) && $producto['categoria_id']!=$mostrarEstaCategoria){
            $mostrar=false;
        }
        if ($mostrar):
            if ($producto['stock']!=0):
?>
<div><div><img src="<?= BASE_URL."/public/assets/img/".$producto['imagen'];?>"> </div>
    <h3><?=$producto['nombre']?></h3>
    <p><?=$producto['precio']?>€</p>
    <p><?=$producto['descripcion']?></p>
    <a href='<?=BASE_URL?>Carrito/anadirCarrito/<?=$producto['id']?>'>Comprar</a></div>
    <hr>
<?php
endif;
endif;
endforeach;
else:
        echo $mensajeProducto;
endif;
?>

</body>
</html>

