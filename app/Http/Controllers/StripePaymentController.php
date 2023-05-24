<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use Stripe;

class StripePaymentController extends Controller
{
    public function stripePost(Request $request){
        // dd('asd');
        try {
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
              );
              $res = $stripe->tokens->create([
                'card' => [
                  'number' => $request->number,
                  'exp_month' => $request->exp_month,
                  'exp_year' => $request->exp_year,
                  'cvc' => $request->cvc,
                ],
              ]);

              Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

              $response = $stripe->charges->create([
                'amount' => 2000,
                'currency' => 'usd',
                'source' => $res->id,
                'description' => $request->description,
              ]);

            return response()->json([$response->status],201);

            //code...
        } catch (Exception $ex) {
            return response()->json([['response' => 'error']],500);
        }
    }
    //
}
