<?php

// cargamos nuestras constantes de configuración
require_once 'config/config.php';

// iniciar session
session_start();

// cargamos todo lo de la carpeta lib
spl_autoload_register(function($lib){
    require_once 'lib/' . $lib . '.php';
});

$init = new Core;