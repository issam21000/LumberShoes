<?php

namespace App\Middlewares;

use App\Models\Order;
/**
* BagCountMiddleware middleware
*/
class BagCountMiddleware extends Middleware
{
	
	public function __invoke($request, $response, $next){

		$bagCount = 0;
		if(isset($_SESSION['isConnected']) && $_SESSION['isConnected']){
			$order = $active_order = Order::where(array(
                ['is_active', '=', true],
                ['user_id', '=', $_SESSION['isConnected']->id]
            ))->first();
            if(!empty($order)){
            	$bagCount = $order->orderLines->count();
            }
		}
		$this->container->view->getEnvironment()->addGlobal('bag_count', $bagCount);
		$response = $next($request, $response);

		return $response;
	}


}