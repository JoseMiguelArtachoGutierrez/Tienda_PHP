
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

    <?php
        session_start();
        require_once 'vendor/autoload.php';
        require_once 'config/config.php';
        $dotenv= \Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->safeLoad();

    use src\Controllers\FrontController;

    FrontController::main();
    ?>

</body>
</html>
