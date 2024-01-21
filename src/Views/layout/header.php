<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        body {
            background-color: #ffffff; /* Blanco */
            color: #333333; /* Negro más claro (gris) */
            font-family: Arial, sans-serif; /* Fuente preferida */
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333333; /* Negro más claro (gris) */
            color: #ffffff; /* Blanco */
            padding: 10px;
        }

        h1 {
            margin: 20px 0 10px; /* Más espacio arriba y abajo, menos espacio abajo del título */
        }

        ul {
            list-style-type: none;
            margin: 10px 0; /* Más espacio arriba y abajo */
            padding: 0;
        }

        li {
            display: inline;
            margin-right: 10px;
        }

        a {
            text-decoration: none;
            color: #ffffff; /* Blanco */
        }

        nav {
            background-color: #333333; /* Negro más claro (gris) */
            color: #ffffff; /* Blanco */
            padding: 10px;
        }

        nav a {
            color: #ffffff; /* Blanco */
            text-decoration: none;
            padding: 8px 12px;
            border: 1px solid #ffffff; /* Blanco */
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s; /* Transición suave */
        }

        nav li {
            display: inline;
            margin-right: 10px;
        }

        nav a:hover {
            background-color: #ffffff; /* Blanco */
            color: #333333; /* Negro más claro (gris) */
        }
    </style>
</head>
<body>
<header>
    <h1>TIENDA</h1>

    <ul>
        <li><a href="<?=BASE_URL?>">Ir al Inicio</a></li>
        <li><a href="<?=BASE_URL?>Carrito/verCarrito/">Mi Cesta</a></li>
        <?php if (isset($_SESSION['identity'])): ?>
            <li><a href="<?= BASE_URL ?>Usuario/logout/">Cerrar sesion</a></li>
            <li><a href="<?= BASE_URL ?>Usuario/registro/">Crear cuenta</a></li>
            <li><a href="<?=BASE_URL?>Pedido/verPedidos/<?=$_SESSION['identity']->id?>">Mis Pedidos</a></li>
            <?php if ($_SESSION['identity']->rol=="admin"):?>
                <li><a href="<?= BASE_URL ?>Categoria/gestionarCategoria/">Modificar Categorias</a></li>
                <li><a href="<?= BASE_URL ?>Producto/gestionarProducto">Modificar Productos</a></li>
                <li><a href="<?= BASE_URL ?>Pedido/gestionarPedido">Modificar Pedidos</a></li>
            <?php endif;?>
        <?php else: ?>
            <li><a href="<?= BASE_URL ?>Usuario/indetifica/">Identificate</a></li>
            <li><a href="<?= BASE_URL ?>Usuario/registro/">Crear cuenta</a></li>
        <?php endif; ?>
    </ul>
    <?php $categorias= Controllers\CategoriaController::obtenerCategorias();?>
    <nav>
        <?php foreach ($categorias as $categoria):?>
            <li>
                <a href="<?=BASE_URL?>Categoria/mostrarProductosUnaCategoria/<?=$categoria['id']?>"><?=$categoria['nombre']?></a>
            </li>
        <?php endforeach;?>
    </nav>

</header>