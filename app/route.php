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


$app->get('/shoes/all', 'ShoesController:searchShoes')->setName('shoes');

$app->get('/shoes/{id:[0-9]+}', 'ShoesController:searchShoes')->setname('brand');

$app->get('/shoes/search', 'ShoesController:searchShoes')->setName('searchShoes');

//Stores search on the map page
$app->get('/shops','ShopController:all')->setName('all_shops');

$app->get('/logOut','UserController:userLogOut')->setName('logOut');

$app->post('/postContact', 'UserController:postContact')->setName('postContact');

$app->get('/shoes/details/{id:[0-9]+}', 'ShoesController:detailsShoes')->setName('details');

$app->get('/shoes/bag', 'ShoesController:bag')->setName('bag');


//Get shoes list based on a given shop
$app->get('/shops/{shop_id}', 'ShoesController:getShoesByShop')->setName('shoes_by_shop');


//Check if the user is connected

$app->get('/user/check_authentication', 'UserController:checkSession')->setName('check_connection');


//Add Shoes To Bag

$app->post('/bag/add', 'OrderController:addToBag')->setName('add_to_bag');

//Display bag content

$app->get('/bag', 'OrderController:displayBag')->setName('display_bag');

//payment
$app->post('/bag/payment', 'OrderController:payment')->setName('payment');

//Remove an orderLine from bag

$app->get('/bag/remove/{id:[0-9]+}', 'OrderController:removeFromBag')->setName('remove_from_bag');

//Validate the active order / Clean the bag

$app->post('/bag/validate', 'OrderController:validateOrder')->setName('validate_order');

//Display orders history

$app->get('/orders', 'OrderController:getOldOrdersList')->setName('orders_list');

//Display Order details (paid order)

$app->get('/orders/{id:[0-9]+}', 'OrderController:getOldOrderDetails')->setName('order_details');
