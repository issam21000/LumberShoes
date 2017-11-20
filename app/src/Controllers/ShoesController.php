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


    // public function displayShoes(Request $request, Response $response, $args)
    // {
    //     $shoes=Shoes::all();
    //     $brand=Brand::all();
    //     return $this->container->view->render($response, 'shoes.twig',['shoes' => $shoes,'brand'=>$brand]);
    // }

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
        $asc=false;
        $desc=false;
        $search=$request->getParam('query');
         if(isset($_GET['search']) && $_GET['search'] == 'submit'){
            $shoes = Shoes::where('model', 'like', "%$search%")->orWhere('description', 'like', "%$search%")->orWhereIn('brand_id', Brand::where('legend','like',"%$search%")->distinct()->get())->distinct()->get();
            return $this->container->view->render($response, 'shoes.twig',['shoes'=> $shoes,'brand'=> $brand] );
        }

        if($request->getParam('orderByPrice')){
             if(isset($args['id'])){
                $requestedBrand = Brand::find($args['id']);
                $shoes = Shoes::where('brand_id', $args['id'])->orderBy('price_per_day', $request->getParam('orderByPrice'))->get();
                if($request->getParam('orderByPrice') == 'desc'){
                  $desc = true;
                }else if($request->getParam('orderByPrice') == 'asc'){
                  $asc = true;
                }
                return $this->container->view->render($response, 'shoes.twig',['shoes'=> $shoes,'brand'=> $brand, 'id'=>$args['id'], 'requestedBrand' => $requestedBrand,'asc'=>$asc, 'desc'=>$desc] );
             }else{
                $shoes = Shoes::orderBy('price_per_day', $request->getParam('orderByPrice'))->get();
                if($request->getParam('orderByPrice') == 'desc'){
                  $desc = true;
                }else if($request->getParam('orderByPrice') == 'asc'){
                  $asc = true;
                }
                return $this->container->view->render($response, 'shoes.twig',['shoes'=> $shoes,'brand'=> $brand,'asc'=>$asc, 'desc'=>$desc]);
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

    /*
    ** Get shoes ordered by shop position
    */

    public function getNearbyShoes($request, $response, $args){

        if($request->isPost()){
            $requestBody = $request->getParsedBody();
            $userPosition = [
                'lat' => $requestBody['latitude'],
                'lng' => $requestBody['longitude']
            ];

            $shoes = Shoes::all();

            $shoes = $shoes->sort(function($shoe_x, $shoe_y) use ($userPosition) {
                if($shoe_x->shop->id == $shoe_y->shop->id){
                    return true;
                }

                return $this->getDistanceBetween(
                    ['lat' => $shoe_x->shop->latitude, 'lng' => $shoe_x->shop->longitude],
                    $userPosition
                ) > $this->getDistanceBetween(
                    ['lat' => $shoe_y->shop->latitude, 'lng' => $shoe_y->shop->longitude],
                    $userPosition
                );

            });

            return $this->container->view->render($response, 'shoes.twig',['shoes'=> $shoes,'brand'=> Brand::all()] );
        }

    }

    public function getDistanceBetween($pos1, $pos2){
        $i = 0;
        $R = 6371000;
        $φ1 = deg2rad((float)$pos1['lat']);
        $φ2 = 0;
        $Δφ = 0;
        $Δλ = 0;
        $a = 0;
        $c = 0;
        $d = 0;
        $φ2 = deg2rad((float)$pos2['lat']);
        $Δφ = deg2rad((float)$pos1['lat'] - (float)$pos2['lat']);
        $Δλ = deg2rad((float)$pos1['lng'] - (float)$pos2['lng']);
        $a = sin($Δφ/2)*sin($Δφ/2) + cos($φ1)*cos($φ1)*sin($Δλ/2)*sin($Δλ/2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $d = $R * $c;
        return $d;
    }

}
