<?php


namespace App\Controllers;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\User;
use App\Models\Shoes;
/**
* The orders controller
*/
class OrderController extends BaseController
{

	/*
    ** Add Shoes to Bag
    */
    public function addToBag($request, $response, $args){
        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] instanceof User){
            $order = Order::where('is_active', true)->first();
            if(empty($order)){
                $order = new Order();
                $order->user_id = $_SESSION['isConnected']->id;
                $order->save();
            }

            $postedData = $request->getParsedBody();
            $shoes = Shoes::find($postedData['shoes_id']);
            $orderLine = new OrderLine();
            $orderLine->order_id = $order->id;
            $orderLine->shoes_id = $shoes->id;
            $orderLine->start_date = \DateTime::createFromFormat('d/m/Y', $postedData['start_date']);
            $orderLine->end_date = \DateTime::createFromFormat('d/m/Y', $postedData['end_date']);
            $orderLine->total_price = $orderLine->start_date->diff($orderLine->end_date)->days * $shoes->price_per_day;

            if($orderLine->start_date >= new \DateTime()
                && $orderLine->start_date < $orderLine->end_date){
                $orderLines = OrderLine::where('shoes_id', $postedData['shoes_id'])->get();
                // echo '<pre>';
                // var_dump($orderLines);
                // echo '</pre>';
                // exit();

                foreach ($orderLines as $ol) {
                    if(($orderLine->start_date > $ol->start_date && $orderLine->start_date < $ol->end_date)
                        || ($orderLine->end_date > $ol->start_date && $orderLine->end_date < $ol->end_date)){
                        return $this->container->view->render($response, 'error.twig',['error' => 'Impossible de réserver dans la date séléctionnée'] ); 
                    }
                }

                $orderLine->save();
                $order->total_price = $order->total_price + $orderLine->total_price;
                $order->save();

                return $response->withRedirect($this->container->router->pathFor('details', array('id' => $postedData['shoes_id'])));
            }


            $orderLine->save();

        }else{
            return $this->container->view->render($response, 'error.twig',['error' => 'You must be logged in to order'] );
        }
    }

    public function displayBag($request, $response, $args){
        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] instanceof User){
            $active_order = Order::where([
                    ['user_id', '=', $_SESSION['isConnected']->id],
                    ['is_active', '=', true]
                ])->first();
            return $this->container->view->render($response, 'bag.twig',['active_order' => $active_order] );
        }else{
            return $this->container->view->render($response, 'error.twig',['error' => 'You must be logged in to display the bag'] );
        }
    }

    public function removeFromBag($request, $response, $args){
        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] instanceof User){
            $orderLine = OrderLine::find($args['id']);
            if(empty($orderLine)){
                return $this->container->view->render($response, 'error.twig',['error' => 'Order line not found'] );
            }

            if(!$orderLine->order->is_active){
                return $this->container->view->render($response, 'error.twig',['error' => 'This order has already been paid'] );
            }

            if($orderLine->order->user->id !== $_SESSION['isConnected']->id){
                return $this->container->view->render($response, 'error.twig',['error' => 'You are not allowed to perform this action'] );
            }
            $order = $orderLine->order;
            $order->total_price = $order->total_price - $orderLine->total_price;
            $order->save();
            $orderLine->delete();
            return $response->withRedirect($this->container->router->pathFor('display_bag'));

        }else{
            return $this->container->view->render($response, 'error.twig',['error' => 'You must be logged in to perform this action'] );
        }
    }

    public function validateOrder($request, $response, $args){
        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] instanceof User){

            $active_order = Order::where('is_active', true)->first();

            if(empty($active_order)){
                return $this->container->view->render($response, 'error.twig',['error' => 'Order not found'] );
            }

            if($active_order->user->id !== $_SESSION['isConnected']->id){
                return $this->container->view->render($response, 'error.twig',['error' => 'You are not allowed to perform this action'] );
            }

            $active_order->is_active = false;
            $new_active_order = new Order();
            $new_active_order->user_id = $_SESSION['isConnected']->id;
            $new_active_order->is_active = true;
            $new_active_order->save();
            $active_order->save();

            return $response->withRedirect($this->container->router->pathFor('display_bag'));

        }else{
            return $this->container->view->render($response, 'error.twig',['error' => 'You must be logged in to perform this action'] );
        }
    }

    public function getOldOrdersList($request, $response, $args){
        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] instanceof User){
            $old_orders = Order::where(array(
                ['user_id', '=', $_SESSION['isConnected']->id],
                ['is_active', '=', 0]
            ))->get();

            return $this->container->view->render($response, 'orders.twig',['orders' => $old_orders]);
        }else{
            return $this->container->view->render($response, 'error.twig',['error' => 'The page you requested was not found'] );
        }
    }

    public function getOldOrderDetails($request, $response, $args){
        if(isset($_SESSION['isConnected']) && $_SESSION['isConnected'] instanceof User){
            $order = Order::where(array(
                ['user_id', '=', $_SESSION['isConnected']->id],
                ['is_active', '=', 0],
                ['id', '=', $args['id']]
            ))->first();

            if(empty($order)){
                return $this->container->view->render($response, 'error.twig',['error' => 'Order not found'] );
            }

            return $this->container->view->render($response, 'order.twig',['order' => $order]);
        }else{
            return $this->container->view->render($response, 'error.twig',['error' => 'The page you requested was not found'] );
        }
    }

}