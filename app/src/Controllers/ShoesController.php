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
        $brand=Brand::where('legend',$args['legend'])->first();
        return $this->container->view->render($response, 'shoes.twig',['shoes' => $shoes],['brand' => $brand]);
    }

    public function detailsShoes(Request $request, Response $response, $args)
    {
        $shoes=Shoes::where('id', $args['id'])->first();
        $brand=Brand::where('legend',$args['legend'])->first();

        if($shoes->is_reserved==0){
        	$shoes->is_reserved="Available !";
        }else{
        	$shoes->is_reserved="Not available !";
        }
        return $this->container->view->render($response, 'detailsShoes.twig',['shoes' => $shoes],['brand' => $brand]);
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


}