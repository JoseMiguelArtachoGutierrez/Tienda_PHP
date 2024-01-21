<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TiendaAcA</title>
    <style>
        body {
            background-color: #ffffff;
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
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="submit"] {
            padding: 8px;
            margin-bottom: 10px;
        }

        table {
            width: 50%; /* La tabla ocupa la mitad de la pantalla */
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #333333;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333333;
            color: #ffffff;
        }

        /* Estilo para la clase que contiene enlaces */
        .link-td {
            background-color: #ffffff; /* Fondo blanco */
            color: #333333;
        }

        /* Estilo para los enlaces dentro de la clase link-td */
        .link-td a {
            border: 1px solid #333333;
            text-decoration: none;
            color: #ffffff;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #333333; /* Fondo negro */
            transition: background-color 0.3s, color 0.3s;
            display: inline-block;
        }

        /* Estilo para los enlaces cuando se les pasa el ratón por encima */
        .link-td a:hover {
            background-color: #ffffff; /* Fondo blanco al pasar el ratón */
            color: #333333; /* Texto negro al pasar el ratón */
        }
    </style>
</head>
<body>
<h1>Categorias</h1>

<?php
    if (isset($_SESSION['categoria_creada'])){
        echo $_SESSION['categoria_creada'];
        unset($_SESSION['categoria_creada']);
    }
    if (isset($_SESSION['categoria_modificada'])){
        echo $_SESSION['categoria_modificada'];
        unset($_SESSION['categoria_modificada']);
    }
    if (isset($_SESSION['categoria_descatalogado'])){
        echo $_SESSION['categoria_descatalogado'];
        unset($_SESSION['categoria_descatalogado']);
    }
?>

<form action="<?= BASE_URL ?>Categoria/crearCategoria" method="post">
    <label>Nueva Categoria:</label>
    <input type="text" name="data[nombre]" placeholder="Introduzca un nombre">
    <input type="submit" value="Añadir">
</form>

<?php
    if (isset($categorias)):
?>
    <table>
        <tr>
            <th>Nombre</th>
            <th>descatalogado</th>
            <th>Gestiones</th>
        </tr>
<?php
        foreach ($categorias as $categoria):
            if (isset($id) && $categoria['id']==$id):
?>
                <tr>
                    <form action="<?=BASE_URL?>Categoria/modificarCategoria" method="post">
                        <input type="text" name="data[id]" value="<?=$categoria['id']?>" style="display: none">
                        <td colspan="2"><input type="text" name="data[nombre]" placeholder="<?= $categoria['nombre']?>"></td>
                        <td><input type="submit" value="Guardar"></td>
                    </form>
                </tr>
<?php
    else:

?>
    <tr>
        <td><?=$categoria['nombre']?></td>
        <td><?php if($categoria['descatalogado']==1){
                echo "Si";
            }else{
                echo "No";
                            }?></td>
        <td class="link-td">
            <a href="<?=BASE_URL?>Categoria/modificarCategoria/<?=$categoria['id']?>">Modificar</a>
            <a href="<?=BASE_URL?>Categoria/descatalogarCategoria/<?=$categoria['id']?>"><?php if ($categoria['descatalogado']!=1){
                echo "Descatalogar";
            }else{
                    echo "Catalogar";
                } ?></a>
        </td>
    </tr>
<?php
    endif;
    endforeach;
?>
    </table>
<?php
else:
        echo "No existe ninguna Categoria";
endif;
?>
</body>
</html>

