<?php
/* Validamos la sessión */
if(!$_SESSION['username']){
    header('location:'.URL.'/auth/login');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= URL . '/css/bootstrap.min.css' ?>">
    <title><?= $datos['title'] ?></title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?php echo  URL.'/task/list'?>">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Bienvenido <?php echo $_SESSION['username'] ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo  URL.'/auth/logout'?>">Salir</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-9 p-3 mt-1">

