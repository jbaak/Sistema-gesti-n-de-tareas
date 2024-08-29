<?php

class Core
{

    protected $controller;
    protected $method;
    protected $parameters = [];

    public function __construct()
    {
        $url = $this->getUrl();

        //validamos si existe un controlador con el nombre que se envio

        if(isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . 'Controller.php'))
        {
            $this->controller = ucwords($url[0]).'Controller';
            unset($url[0]);
        } else {
            $this->controller = 'TaskController';
            $this->method = 'index';
        }

        //cargamos el controlador
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        //validamos si existe un metodo en el contralor
        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->parameters = $url ? array_values($url) : [];
        //lamamos al metodo del contrador y le pasamos los parametros
        call_user_func_array([$this->controller, $this->method], $this->parameters);
    }

    //obtenemos todo lo que viene despues de la base url, controller, metodo y parametro
    public function getUrl()
    {
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}