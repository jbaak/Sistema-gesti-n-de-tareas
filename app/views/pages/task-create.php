<?php
require_once APP . '/views/inc/header.php';

// Esto es para que cuando estes llenado el fomulario y se envie con algun campo que falta
// al ver los errores te llene los campos que ya habias capturado antes
$title = (isset($datos['data']['title']) && $datos['data']['title'] != '')? $datos['data']['title'] : '';
$description = (isset($datos['data']['description']) && $datos['data']['description'] != '')? $datos['data']['description'] : '';
$status = (isset($datos['data']['status']) && $datos['data']['status'] != '')? $datos['data']['status'] : '';

?>

    <div class="row">
        <?php
        if(isset($_GET["create"]) and $_GET["create"] === 'si'){
            ?>
            <div class="alert alert-success">
                Operación realizada correctamente. <a href="<?php echo URL.'/task/list' ?>">Volver al listado</a>
            </div>
            <?php
        }
        ?>
        <h4>Agregar tarea</h4>
        <form class="form m-2" action="<?php echo URL.'/task/create' ?>" method="POST">
            <div class="form-group">
                <label>Título</label>
                <input class="form-control" type="text" name="title"  value="<?= $title ?>"/>
            </div>
            <div class="form-group mb-2">
                <label>Descripción</label>
                <textarea class="form-control" style="white-space: pre-wrap;" name="description"><?= $description ?></textarea>
            </div>

            <div class="form-group mb-3">
                <label>Estado</label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <option selected value="0">Seleccione</option>
                    <option value="1" <?php if($status == 1) echo 'selected'?>>Pendiente</option>
                    <option value="2" <?php if($status == 2) echo 'selected'?>>En progreso</option>
                    <option value="3" <?php if($status == 3) echo 'selected'?>>Completada</option>
                </select>
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
            <input type="submit" name="submit" value="Guardar" class="btn btn-primary"/>
            <a class="btn btn-outline-danger" href="<?php echo URL.'/task/list' ?>">Cancelar</a>
        </form>
    </div>

<?php require_once APP . '/views/inc/footer.php' ?>