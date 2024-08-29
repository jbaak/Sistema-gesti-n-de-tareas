<?php require_once APP . '/views/inc/header.php' ?>


    <div class="container">
        <div class="row">
            <div class="col-9"><h2>Listado de tareas</h2> </div>
            <div class="col-3"><a class="btn btn-success" href="<?php echo URL.'/task/create' ?>">Agregar tarea</a></div>
        </div>
    </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($datos['tasks']) && count($datos['tasks']) > 0) { ?>
                        <?php foreach ($datos['tasks'] as $k=>$task) { ?>
                            <tr id="td-<?= $task['id'] ?>">
                                <th scope="row"><?php echo $task['id'] ?></th>
                                <td><?php echo $task['title'] ?></td>
                                <td><?php echo $task['description'] ?></td>
                                <td>
                                    <?php
                                    switch ($task['status']) {
                                        case 1: echo "Pendiente"; break;
                                        case 2: echo "En progreso"; break;
                                        case 3: echo "Completada"; break;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="<?= URL.'/task/edit/'.$task['id'] ?>">Editar</a>
                                    <a class="btn btn-danger delete" data-id="<?= $task['id'] ?>" href="<?= URL.'/task/delete/'.$task['id'] ?>" )">Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td>No hay tareas agregadas</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>


<?php require_once APP . '/views/inc/footer.php' ?>