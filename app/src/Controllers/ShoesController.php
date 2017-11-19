<?php

namespace App\Controllers;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\User;
use App\Models\Shoes;
use App\Models\Brand;
use App\Models\Shop;
use App\Models\Order;
use App\Models\OrderLine;
use Slim\Flash\Messages;

final class ShoesController extends BaseController
{


    public function displayShoes(Request $request, Response $response, $args)
    {
        $shoes=Shoes::all();
        $brand=Brand::all();
        return $this->container->view->render($response, 'shoes.twig',['shoes' => $shoes,'brand'=>$brand]);
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
                return $this->container->view->render($response, 'shoes.twig',['shoes' => $shoes, 'brand' => Brand::all()]);
            }
        }
    }

    public function searchShoes(Request $request, Response $response, $args){
        $brand = Brand::all();
        $search=$request->getParam('query');
         if(isset($_GET['search']) && $_GET['search'] == 'submit'){
            $shoes = Shoes::where('model', 'like', "%$search%")->orWhere('description', 'like', "%$search%")->orWhereIn('brand_id', Brand::where('legend','like',"%$search%")->distinct()->get())->distinct()->get();
            return $this->container->view->render($response, 'shoes.twig',['shoes'=> $shoes,'brand'=> $brand] );
        }

        if($request->getParam('orderByPrice')){
             if(isset($args['id'])){
                $requestedBrand = Brand::find($args['id']);
                $shoes = Shoes::where('brand_id', $args['id'])->orderBy('price_per_day', $request->getParam('orderByPrice'))->get();
                return $this->container->view->render($response, 'shoes.twig',['shoes'=> $shoes,'brand'=> $brand, 'id'=>$args['id'], 'requestedBrand' => $requestedBrand] );
             }else{
                $shoes = Shoes::orderBy('price_per_day', $request->getParam('orderByPrice'))->get();
                return $this->container->view->render($response, 'shoes.twig',['shoes'=> $shoes,'brand'=> $brand]);
             }
        }else{
            if(isset($args['id'])){
                $requestedBrand = Brand::find($args['id']);
                $shoes = Shoes::where('brand_id', $args['id'])->get();
                return $this->container->view->render($response, 'shoes.twig',['shoes'=> $shoes,'brand'=> $brand, 'id'=>$args['id'], 'requestedBrand' => $requestedBrand] );
             }else{
                $shoes = Shoes::all();
                return $this->container->view->render($response, 'shoes.twig',['shoes'=> $shoes,'brand'=> $brand] );
             }
        }
    }

}
