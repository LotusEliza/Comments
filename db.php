<?php

/**
 * Created by PhpStorm.
 * User: lotus
 * Date: 6/8/17
 * Time: 7:31 PM
 */
global $_config;

$gdb = new mysqli($_config['DBHost'],$_config['DBUser'],$_config['DBPass'],$_config['DBName']);
if ($gdb->connect_error){
    die('Connection error: ' . $gdb->connect_error);
}
