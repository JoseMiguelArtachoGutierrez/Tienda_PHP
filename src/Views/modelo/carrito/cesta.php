<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TiendaAcA</title>
    <style>
        body {
            background-color: #ffffff; /* Blanco */
            color: #333333; /* Negro más claro (gris) */
            font-family: Arial, sans-serif; /* Fuente preferida */
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333333; /* Negro más claro (gris) */
            color: #ffffff; /* Blanco */
            padding: 10px;
            margin: 0;
        }

        section {
            margin: 20px;
        }

        article {
            border: 1px solid #333333; /* Negro más claro (gris) */
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 10px;
            display: flex;
            align-items: center; /* Centrar verticalmente */
            justify-content: space-between; /* Espacio entre elementos */
        }

        img {
            max-width: 50px; /* Ajusta el tamaño de la imagen según tu preferencia */
            height: auto;
        }

        p {
            margin: 10px 0;
        }

        a {
            text-decoration: none;
            color: #ffffff; /* Blanco */
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s; /* Transición suave */
        }

        a:hover {
            background-color: #333333; /* Negro más claro (gris) */
            color: #ffffff; /* Blanco */
        }

        button {
            background-color: #333333; /* Negro más claro (gris) */
            color: #ffffff; /* Blanco */
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s; /* Transición suave */
        }

        button:hover {
            background-color: #ffffff; /* Blanco */
            color: #333333; /* Negro más claro (gris) */
        }

        svg {
            width: 20px; /* Ajusta el tamaño de los íconos SVG según tu preferencia */
            height: 20px;
        }
    </style>
</head>
<body>
<?php ?>
<?php ?>
<h1>Carrito</h1>

<section>
    <?php
        $productos= \Controllers\ProductoController::todosLosProductos();
        if (isset($_SESSION['carrito']) && isset($_SESSION['carrito'][0])):
            for ($i=0;$i<count($_SESSION['carrito']);$i++):
                $carrito=$_SESSION['carrito'][$i];
                foreach ($productos as $producto):
                if ($carrito['id']==$producto['id']):
    ?>
    <a href="<?=BASE_URL?>Carrito/eliminarCarrito/">Eliminar Carrito</a>
    <article id="<?=$carrito['id']?>">
        <div>
            <img src="<?= BASE_URL."/public/assets/img/".$producto['imagen'];?>">
        </div>
        <p>
            Nombre:
            <?=   $producto['nombre'] ?>
        </p>
        <p>
            <div><a href="<?=BASE_URL?>Carrito/anadirProductoDelCarrito/<?= $carrito['id'] ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 256 256"><path fill="#000000" d="M128 24a104 104 0 1 0 104 104A104.11 104.11 0 0 0 128 24m0 192a88 88 0 1 1 88-88a88.1 88.1 0 0 1-88 88m48-88a8 8 0 0 1-8 8h-32v32a8 8 0 0 1-16 0v-32H88a8 8 0 0 1 0-16h32V88a8 8 0 0 1 16 0v32h32a8 8 0 0 1 8 8"/></svg>
            </a></div>
            <?= $carrito['cantidad'] ?>
            <div><a href="<?=BASE_URL?>Carrito/quitarProductoDelCarrito/<?= $carrito['id'] ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 32 32"><path fill="#000000" d="M16 4c6.6 0 12 5.4 12 12s-5.4 12-12 12S4 22.6 4 16S9.4 4 16 4m0-2C8.3 2 2 8.3 2 16s6.3 14 14 14s14-6.3 14-14S23.7 2 16 2"/><path fill="#000000" d="M8 15h16v2H8z"/></svg>
                </a></div>
        </p>
        <p>
            Precio :
            <?php
                $resultado=$producto['precio']*$carrito['cantidad'];
                echo $resultado ;
            ?>
        </p>
    </article>

    <?php
        endif;
        endforeach;
        endfor;
    ?>
    <button><a href="<?=BASE_URL?>Pedido/comprar">Comprar</a></button>
    <?php
        else:
    ?>
        <p>No hay ningun Producto en el carrito</p>
    <?php
        endif;
    ?>
</section>


</body>
</html>

