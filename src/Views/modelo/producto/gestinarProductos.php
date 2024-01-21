<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TiendaAcA</title>
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

        form {
            width: 50%;
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form h2 {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        form input, form select, form textarea {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 10px;
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

        img {
            width: 20px;
            height: 20px;
        }
        .gestiones{

            display: flex;
            gap: 5px;
            align-items: center;
        }
        .gestiones>a{
            text-align: center;
            border-radius: 10px;
            border: 1px solid #333333;
            padding: 5px;
            background-color: #333333;
        }
    </style>
</head>
<body>
<h1>Productos</h1>

<?php
if (isset($_SESSION['producto_creada'])){
    echo $_SESSION['producto_creada'];
    unset($_SESSION['producto_creada']);
}
if (isset($_SESSION['producto_modificada'])){
    echo $_SESSION['producto_modificada'];
    unset($_SESSION['producto_modificada']);
}
if (isset($_SESSION['producto_enventa'])){
    echo $_SESSION['producto_enventa'];
    unset($_SESSION['producto_enventa']);
}
?>
<form action="<?= BASE_URL ?>Producto/crearProducto" method="post">
    <h2>Crear Producto</h2>
    <td><label>Nombre:</label><input type="text" name="data[nombre]" ></td>
    <td><label>Categoria:</label><select name="data[categoria_id]">
            <?php
            $contador=0;
            foreach ($categorias as $categoria):?>

                <option value="<?=$categoria['id']?>" <?php if($contador==0){echo "selected";} ?>><?=$categoria['nombre']?></option>

            <?php
                $contador++;
                endforeach;
            ?>
        </select></td>
    <td><label>Precio:</label><input type="number" name="data[precio]" ></td>
    <td><label>Stock:</label><input type="number" name="data[stock]" ></td>
    <td><label>Oferta:</label><input type="text" minlength="2" name="data[oferta]" ></td>
    <td><label>Fecha::</label><input type="date" name="data[fecha]" value=""></td>
    <td><label>En venta:</label><select name="data[enVenta]">
            <option value="true" selected>Si</option>
            <option value="false">No</option>
    </select></td>
    <td><input type="file" name="data[imagen]" accept="image/"></td>
    <td><textarea name="data[descripcion]" ></textarea></td>
    <td><input type="submit" value="Crear Producto"></td>
</form>

<table>
    <tr>
        <th>Nombre</th>
        <th>Categoria</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Oferta</th>
        <th>Fecha</th>
        <th>En Venta</th>
        <th>Imagen</th>
        <th>Descripcion</th>
        <th>Gestiones</th>
    </tr>
    <?php
    if (isset($productos) && isset($categorias)):
        foreach ($productos as $producto):
            if (isset($id) && $producto['id']==$id):
    ?>
       <tr>
           <form action="<?=BASE_URL?>Producto/modificarProducto" method="post">
               <input type="text" name="data[id]" value="<?=$producto['id']?>" style="display: none">
               <td><input type="text" name="data[nombre]" value="<?=$producto['nombre']?>"></td>
               <td><select name="data[categoria_id]">
                   <?php
                        foreach ($categorias as $categoria):
                            if ($producto['categoria_id']==$categoria['id']):
                   ?>
                        <option value="<?=$producto['categoria_id']?>" selected><?=$categoria['nombre']?></option>
                            <?php else:?>
                        <option value="<?=$categoria['id']?>"><?=$categoria['nombre']?></option>
                   <?php
                        endif;
                        endforeach;
                    ?>
               </select></td>
               <td><input type="number" name="data[precio]" value="<?=$producto['precio']?>"></td>
               <td><input type="number" name="data[stock]" value="<?=$producto['stock']?>"></td>
               <td><input type="text" minlength="2" name="data[oferta]" value="<?=$producto['oferta']?>"></td>
               <td><input type="date" name="data[fecha]" value="<?=$producto['fecha']?>"></td>
               <td><select name="data[enVenta]">
                       <option value="true" <?php
                       if ($producto['enVenta']==true){
                           echo "selected";
                       }
                       ?>>Si</option>
                       <option value="false" <?php
                       if ($producto['enVenta']==false){
                           echo "selected";
                       }
                       ?>>No</option>
                   </select> </td>
               <td><input type="file" name="data[imagen]" accept="image/"></td>
               <td><textarea name="data[descripcion]" ><?=$producto['descripcion']?></textarea></td>
               <td><input type="submit" value="Guardar Cambios"></td>
           </form>
       </tr>

    <?php
        else:
    ?>
        <tr>
            <td><?=$producto['nombre']?></td>
            <td><?php
                foreach ($categorias as $categoria){
                    if ($producto['categoria_id']==$categoria['id']){
                        echo $categoria['nombre'];
                    }
                } ?></td>
            <td><?= $producto['precio'] ?></td>
            <td><?= $producto['stock'] ?></td>
            <td><?= $producto['oferta'] ?></td>
            <td><?= $producto['fecha'] ?></td>
            <td><?php
                    if ($producto['enVenta']){
                        echo "Si";
                    }else{
                        echo "No";
                    }
                ?></td>
            <td><img src="<?= BASE_URL."/public/assets/img/".$producto['imagen'];?>"></td>
            <td><?= $producto['descripcion'] ?></td>
            <td class="gestiones">
                <a href="<?=BASE_URL?>Producto/modificarProducto/<?=$producto['id']?>">Modificar</a>
                <a href="<?=BASE_URL?>Producto/quitarDeLaVenta/<?=$producto['id']?>"><?php if ($producto['enVenta']==1){
                        echo "Quitar De la venta";
                    }else{
                        echo "Poner a la venta";
                    } ?></a>
            </td>
        </tr>
    <?php
    endif;
    endforeach;
    endif;
    ?>
</table>

</body>
</html>

