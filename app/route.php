<?php
/*
	Routes
	controller needs to be registered in dependency.php
*/
$app->get('/', 'App\Controllers\UserController:index');

$app->get('/userRegister', 'App\Controllers\UserController:registerUser');

$app->get('/contact', 'App\Controllers\UserController:formContact');

$app->get('/users', 'App\Controllers\UserController:dispatch')->setName('userpage');