<?php

namespace App\Controllers;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\User;
use App\Models\Shoes;
use App\Models\Brand;
use App\Models\Shop;
use Slim\Flash\Messages;

final class ShoesController extends BaseController
{
    

    public function displayShoes(Request $request, Response $response, $args)
    {
        $shoes=Shoes::all();
        return $this->container->view->render($response, 'shoes.twig',['shoes' => $shoes]);
    }

    public function detailsShoes(Request $request, Response $response, $args)
    {
        $shoes=Shoes::find($args['id']);
        return $this->container->view->render($response, 'detailsShoes.twig',['shoes' => $shoes]);
    }


    public function bag(Request $request, Response $response, $args)
    {
        if(isset($_SESSION['isConnected'])){
        	return $response->withRedirect("/shoes/bag");	
        }else{
        	$this->container->flash->addMessage('ErrorLoginBag','You must be logged to acces the bag');
       		return $response->withRedirect("/userRegister");
        }
    }


    //Get the shoes list bases on a given shop

    public function getShoesByShop(Request $request, Response $response, $args){
        $shop = Shop::find($args['shop_id']);
        if(null != $shop){
            $shoes = $shop->shoes;
            if(!empty($shoes)){
                return $this->container->view->render($response, 'shoes.twig',['shoes' => $shoes]);
            }
        }
    }

    public function searchShoes(Request $request, Response $response, $args){
       
        $search=$_GET['query'];
        if(null !== $_GET && $_GET['search']=='submit'){
            $shoes=Shoes::where('model', 'like', "%$search%")->orWhere('description', 'like', "%$search%")->distinct()->get(); 
        } 
        return $this->container->view->render($response, 'shoes.twig',['shoes' => $shoes]);          
    }



}