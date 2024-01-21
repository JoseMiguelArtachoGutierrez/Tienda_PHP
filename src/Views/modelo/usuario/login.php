<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    form {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }

    form p {
        margin: 10px 0;
    }

    label {
        display: block;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #333;
        color: #fff;
        cursor: pointer;
    }

    h3 {
        text-align: center;
        margin-top: 50px;
        color: #333;
    }
</style>
<?php if(!isset($_SESSION['indentity'])): ?>
    <form action="<?=BASE_URL?>Usuario/login/" method="post">
        <p>
            <label for="email">Email</label>
            <input id="email" type="text" name="data[email]" required>
        </p>
        <p>
            <label for="password">Contraseña</label>
            <input id="password" type="password" name="data[password]" required>
        </p>
        <p>
            <input type="submit" value="Loguearse">
        </p>
    </form>
<?php else: ?>
    <h3><?=$_SESSION['identity']->nombre?><?= $_SESSION['identity']->apellidos ?></h3>
<?php endif;?>