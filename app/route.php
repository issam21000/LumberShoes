<?php
/*
	Routes
	controller needs to be registered in dependency.php
*/
$app->get('/', 'App\Controllers\UserController:index')->setName('index');

$app->get('/userRegister', 'App\Controllers\UserController:registerUser')->setName('register');

$app->get('/contact', 'App\Controllers\UserController:formContact')->setName('contact');

$app->post('/userRegister/enregistrer', 'App\Controllers\UserController:userEnregistrer')->setName('
	enregistrer');

$app->post('/userRegister/connecter', 'App\Controllers\UserController:userConnecter')
->setName('connecter');

$app->get('/shop', 'App\Controllers\ShopController:---')->setName('shop');

$app->get('/shoes', 'App\Controllers\ShoesController:---')->setName('shoes');

$app->get('/search', 'App\Controllers\SearchController:---')->setName('search');

















