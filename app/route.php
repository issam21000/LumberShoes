<?php
/*
	Routes
	controller needs to be registered in dependency.php
*/
$app->get('/', 'UserController:index')->setName('index');

$app->get('/userRegister', 'UserController:registerUser')->setName('register');

$app->get('/contact', 'UserController:formContact')->setName('contact');

$app->post('/userRegister/enregistrer', 'UserController:userEnregistrer')
->setName('enregistrer');

$app->post('/connecter', 'UserController:userConnected')
->setName('connected');


$app->get('/shoes', 'ShoesController:displayShoes')->setName('shoes');

$app->get('/search', 'SearchController:---')->setName('search');

//Stores search on the map page
$app->get('/shops','ShopController:all')->setName('all_shops');

$app->get('/logOut','UserController:userLogOut')->setName('logOut');

$app->post('/postContact', 'UserController:postContact')->setName('postContact');

$app->get('/shoes/{id:[0-9]+}', 'ShoesController:detailsShoes')->setName('details');

$app->get('/shoes/bag', 'ShoesController:bag')->setName('bag');


//Get shoes list based on a given shop
$app->get('/shops/{shop_id}', 'ShoesController:getShoesByShop')->setName('shoes_by_shop');


//Check if the user is connected

$app->get('/user/check_authentication', 'UserController:checkSession')->setName('check_connection');
