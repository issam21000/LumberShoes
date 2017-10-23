<?php
/*
	Routes
	controller needs to be registered in dependency.php
*/
$app->get('/', 'App\Controllers\UserController:index')->setName('index');

$app->get('/userRegister', 'App\Controllers\UserController:registerUser')->setName('register');

$app->get('/contact', 'App\Controllers\UserController:formContact')->setName('contact');

$app->post('/userRegister/enregistrer', 'App\Controllers\UserController:userEnregistrer')
->setName('enregistrer');

$app->post('/connecter', 'App\Controllers\UserController:userConnected')
->setName('connected');


$app->get('/allshoes', 'App\Controllers\ShoesController:displayShoes')->setName('shoes');

$app->get('/search', 'App\Controllers\SearchController:---')->setName('search');

//Stores search on the map page
$app->get('/shops','ShopController:all')->setName('all_shops');

$app->get('/logOut','App\Controllers\UserController:userLogOut')->setName('logOut');

$app->post('/postContact', 'App\Controllers\UserController:postContact')->setName('postContact');

$app->get('/{id}', 'App\Controllers\ShoesController:detailsShoes')->setName('details');

