<?php

class BaseController
{
    //carga un modelo de la carpeta models
    public function loadModel($model)
    {
        require_once '../app/models/' . $model . '.php';

        return new $model;
    }

    //carga una vista de la carpeta views/pages
    public function loadView($view, $datos = [])
    {
        if(file_exists('../app/views/pages/' . $view . '.php'))
        {
            require_once '../app/views/pages/' . $view . '.php';
        }
        else
        {
            die("404 NOT FOUND");
        }
    }
}