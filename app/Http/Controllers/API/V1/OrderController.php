<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\API\Order\OrderRequest;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class OrderController extends Controller
{
    protected string $currentDomain;

    public function orderCreate(OrderRequest $request): JsonResponse
    {
        $this->currentDomain = $request->root();

        $data = $request->validated();

        // separate products from data
        $products = $data['products'];
        unset($data['products']);

        // count total price
        $totalPrice = 0.0;
        foreach ($products as $product) {
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

        // create end return stripe session to client
        return $this->getStripeCheckoutSession($products, $totalPrice);
    }

    public function paymentSuccess()
    {
        return '!!!payment success!!!!';
    }

    public function paymentCancel()
    {
        return '!!!payment cancel!!!!';
    }


    private function getStripeCheckoutSession(array $products, float $totalPrice): JsonResponse
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $checkout_session = Session::create([
            'payment_method_types' => ['card'],

            'line_items' => $this->getLineItems($products),

            'mode' => 'payment',
            'success_url' => $this->currentDomain . '/api/v1/stripe/success',
            'cancel_url' =>  $this->currentDomain . '/api/v1/stripe/cancel',
        ]);

        return response()->json(['id' => $checkout_session->id]);
    }

    private function getLineItems(array $products): array
    {
        $lineItems = [];
        foreach ($products as $product) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => $product['price'],
                    'product_data' => [
                        'name' => $product['title'],
                    ],
                ],
                'quantity' => $product['qty'],
            ];
        }

        return $lineItems;
    }
}
