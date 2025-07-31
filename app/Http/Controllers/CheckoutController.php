<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Plan;
use Illuminate\Support\Facades\Http;
class CheckoutController extends Controller
{

    public function stripe(Request $request)
    {
        $request->validate(['plan_id' => 'required|exists:plans,id']);
        $plan = Plan::find($request->plan_id);

        Stripe::setApiKey(config('stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'mode' => 'payment',
            'line_items' => [[
                'price_data' => [
                    'currency' => strtolower($plan->currency),
                    'unit_amount' => $plan->price * 100, // cents
                    'product_data' => [
                        'name' => $plan->name,
                    ],
                ],
                'quantity' => 1,
            ]],
            'success_url' => url('/success'),
            'cancel_url'  => url('/cancel'),
        ]);

        return response()->json(['url' => $session->url]);
    }


    public function paypal(Request $request)
    {
        $request->validate(['plan_id' => 'required|exists:plans,id']);
        $plan = Plan::find($request->plan_id);

        // Auth
        $auth = Http::asForm()->withBasicAuth(
            config('paypal.client_id'),
            config('paypal.client_secret')
        )->post($this->paypalUrl('/v1/oauth2/token'), [
            'grant_type' => 'client_credentials',
        ]);

        $accessToken = $auth['access_token'];

        // Create order
        $order = Http::withToken($accessToken)->post($this->paypalUrl('/v2/checkout/orders'), [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'amount' => [
                    'currency_code' => strtoupper($plan->currency),
                    'value' => $plan->price,
                ],
                'description' => $plan->name,
            ]],
            'application_context' => [
                'return_url' => url('/success'),
                'cancel_url' => url('/cancel'),
            ]
        ]);

        $approveUrl = collect($order['links'])->firstWhere('rel', 'approve')['href'];

        return response()->json(['url' => $approveUrl]);
    }

    private function paypalUrl($endpoint)
    {
        return config('paypal.sandbox')
            ? "https://api-m.sandbox.paypal.com$endpoint"
            : "https://api-m.paypal.com$endpoint";
    }
}
