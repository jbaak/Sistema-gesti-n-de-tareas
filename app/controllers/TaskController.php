<?php

// la clase extiende de control para heredar las funciones para cargar modelos y vistas
class TaskController extends BaseController
{
    private $task;
    public function __construct()
    {
        // se carga e instancia el modelo para tenerlo disponible en toda la clase
        $this->task = $this->loadModel('Task');
    }

    public function index()
    {
        $datos = [
            "title" => "Home",
        ];

        $this->loadView('task-index', $datos);
    }

    public function list()
    {
        $datos = [
            "title" => "Tareas",
            "tasks" => $this->task->getTaskByIdUser($_SESSION['id']),
        ];

        $this->loadView('task-list', $datos);
    }

    public function create()
    {
        $errors = [];
        $data = [];

        //validamos que se envio el form
        if(isset($_POST['submit'])) {

            // esto es para llenar los campos capturados en caso de error
            $data['title'] = $_POST['title'];
            $data['description'] = $_POST['description'];
            $data['status'] = $_POST['status'];

            if (empty($_POST['title'] )) {
                $errors['title'] = "El título  es requerido.";
            }

            if (empty($_POST['description'] )) {
                $errors['description'] = "La descripción  es requerida.";
            }

            if (empty($_POST['status'] ) || $_POST['status'] == 0) {
                $errors['status'] = "El status  es requerido.";
            }

            // si no ocurrio ningun error guardamos la tarea
            if (empty($errors)) {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $status = $_POST['status'];
                $idUser = $_SESSION['id'];

                $this->task->save($title, $description, $status, $idUser);
                header("location: ".URL."/task/create?create=si");
            }
        }

        $datos = [
            "title" => "Crear tarea",
            "errors" => $errors,
            "data" => $data,
        ];

        $this->loadView('task-create', $datos);
    }

    public function edit($id)
    {
        $errors = [];
        $task = $this->task->getById($id);

        //validamos que se envio el form
        if(isset($_POST['submit'])) {

            //validamos que se enviaron los campos
            if (empty($_POST['title'] )) {
                $errors['title'] = "El título  es requerido.";
            }

            if (empty($_POST['description'] )) {
                $errors['description'] = "La descripción  es requerida.";
            }

            if (empty($_POST['status'] ) || $_POST['status'] == 0) {
                $errors['status'] = "El status  es requerido.";
            }

            // si no ocurrio ningun error editamos la tarea
            if (empty($errors)) {

                $data = [
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'status' => $_POST['status'],
                ];
                $id = $_POST['id'];

                $this->task->update($id, $data);
                header("location: ".URL."/task/edit/{$id}?edit=si");
            }
        }

        $datos = [
            "title" => "Editar tarea",
            "errors" => $errors,
            "task" => $task,

        ];

        $this->loadView('task-edit', $datos);
    }

    public function delete($id) {
        $this->task->delete($id);
    }

}