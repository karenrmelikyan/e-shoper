<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\API\Order\OrderRequest;

class OrderController extends Controller
{
     public function orderDispatch(OrderRequest $request)
     {
         $data = $request->validated();

         // separate products from data
         $products = $data['products'];
         unset($data['products']);

         // count total price
         $totalPrice = 0.0;
         foreach($products as $product) {
             $totalPrice += $product['price'] * $product['qty'];
         }

         // update user data
         $user = User::where('email', $data['email'])->first();
         $user?->update($data);

         // create order
         Order::create([
             'user_id' => $user->id,
             'products' => json_encode($products),
             'total_price' => $totalPrice,
         ]);

         // dispatch job
     }
}
