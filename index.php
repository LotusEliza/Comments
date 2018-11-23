<?php
require_once 'header.php';
$params = [];
if(isset($_GET['page'])){ //mod_rewrite teper vse prihodit v index
    $params = explode('/', $_GET['page']);//razrivaem stroku po slesham
    if(count($params) == 0){
        $params[] = 'index';
    }
}
else
    $params[] = 'index';

//var_dump($page);
$controller_name = array_shift($params);
$class = $controller_name.'Controller'; //addController
$controller_path = './controllers/'.$class.'.php';
//echo $class;
//echo '<br>';
//echo $controller;
//echo '<br>';
//echo '<br>';

//do action(routing)
if(file_exists($controller_path)){
    include $controller_path; //podkluchaem kontroller (dinamicheskiy)
    $worker = new $class;
    $worker->action($params);
}


