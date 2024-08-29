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
            <section class="p-3 p-md-4 p-xl-5">
                <div class="container">
                    <div class="card border-light-subtle shadow-sm">
                        <div class="row g-0">
                            <div class="col-12 col-md-6 text-bg-primary">
                                <div class="d-flex align-items-center justify-content-center h-100">
                                    <div class="col-10 col-xl-8 py-3">
                                        <img class="img-fluid rounded mb-4" loading="lazy" src="<?php echo URL.'/img/lista-de-tareas.png' ?>" width="50" alt="Bienvenido">
                                        <hr class="border-primary-subtle mb-4">
                                        <h2 class="h1 mb-4">Administrador de tareas.</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card-body p-3 p-md-4 p-xl-5">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-5">
                                                <h3>Registrarse</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="<?php echo URL.'/auth/register'?>" method="POST">
                                        <div class="row gy-3 gy-md-4 overflow-hidden">
                                            <div class="col-12">
                                                <label for="username" class="form-label">Nombre de usuario <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="username" id="username">
                                            </div>
                                            <div class="col-12">
                                                <label for="password" class="form-label">Contraseña <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" name="password" id="password">
                                            </div>
                                            <div class="col-12">
                                                <label for="repassword" class="form-label">Repetir contraseña <span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" name="repassword" id="repassword">
                                            </div>
                                            <?php if(isset($datos['errors']) && count($datos['errors']) > 0) { ?>
                                                <div class="row">
                                                    <div class="col-12 mt-2">
                                                        <?php foreach ($datos['errors'] as $k=>$error) { ?>
                                                            <div class="alert alert-danger"><?php echo $error; ?></div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button class="btn bsb-btn-xl btn-primary" type="submit" name="submit">Registrarse</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div class="col-12">
                                            <hr class="mt-5 mb-4 border-secondary-subtle">
                                            <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                                                <a href="<?php echo URL.'/auth/login' ?>" class="link-secondary text-decoration-none">Login</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</body>