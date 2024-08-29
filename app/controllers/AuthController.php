<?php

// la clase extiende de control para heredar las funciones para cargar modelos y vistas
class AuthController extends BaseController
{
    private $user;
    public function __construct()
    {
        // se carga e instancia el modelo para tenerlo disponible en toda la clase
        $this->user = $this->loadModel('User');
    }

    public function login()
    {
        $errors = [];

        //validamos que se envio el form
        if(isset($_POST['submit'])) {
            if (isset($_POST['username'], $_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                //validamos que exista el username en la bd
                if ($user = $this->user->getByUserame($username)) {
                    if (password_verify($password, $user['password'])) {
                        $this->createSession($_POST['username'], $user['id']);
                    }
                }

                $errors['user_not_found'] = "El nombre de usuario y la contraseña son incorrectos.";
            } else {
                $errors['username'] = "El nombre de usuario es requerido.";
                $errors['password'] = "La contraseña  es requerida.";
            }
        }

        $datos = [
            "title" => "Login",
            "errors" => $errors,
        ];

        $this->loadView('login', $datos);
    }

    public function register()
    {
        $errors = [];

        //validamos que se envio el form
        if(isset($_POST['submit'])) {
            if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['repassword'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $repassword = $_POST['repassword'];

                if ($password != $repassword) {
                    $errors['repassword'] = "Las contraseñas  no coiciden.";
                } else {
                    //validamos que exista el username en la bd
                    if (!$this->user->getByUserame($username)) {
                        $userId = $this->user->save($_POST['username'], $_POST['password']);
                        $this->createSession($username, $userId);

                    }
                    $errors['username_found'] = "Ya existe un usuario con ese nombre de usuario.";
                }


            } else {
                $errors['username'] = "El nombre de usuario es requerido.";
                $errors['password'] = "La contraseña  es requerida.";
            }
        }

        $datos = [
            "title" => "Registro",
            "errors" => $errors,
        ];

        $this->loadView('register', $datos);
    }

    public function createSession($username, $id) {
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
        // Redirigimos al usuario a la página de tareas
        header('Location: '.URL.'/task/list');
    }

    public function logout() {

        // Destruimos la session
        session_destroy();

        // Redirigimos al login
        header("location: ".URL."/auth/login");
    }
}