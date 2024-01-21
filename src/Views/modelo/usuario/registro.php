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

        body>a {

            display: block;
            text-align: center;
            margin-top: 10px;
            color: #333;
            text-decoration: none;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        form label {
            display: block;
            margin: 10px 0;
            color: #333;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
<?php ?>
<?php ?>
<h1>Registrate</h1>
<a href="<?=BASE_URL?>">Cancelar</a><br>

<form action="<?=BASE_URL?>Usuario/registro/" method="post">
    <label>Nombre: </label>
    <input type="text" name="data[nombre]" value=""><br>
    <label>Apellidos: </label>
    <input type="text" name="data[apellidos]" value=""><br>
    <label>Correo: </label>
    <input type="text" name="data[email]" value=""><br>
    <label>Password: </label>
    <input type="text" name="data[password]" value=""><br>

    <br><input type="submit" value="Registrarse">
</form>
</body>
</html>


