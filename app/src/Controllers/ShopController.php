<?php


	namespace App\Controllers;

	use App\Models\Shop;
	/**
	* The shops controller
	*/
	class ShopController extends BaseController
	{

		public function all($request, $response){

			$shops = Shop::all();

			return $this->container->view->render($response, 'shops.twig', ['shops' => $shops]);
		}

	}