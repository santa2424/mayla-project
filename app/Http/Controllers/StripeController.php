<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;

class StripeController extends Controller
{
    public function testStripeKeys()
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $customers = Customer::all(['limit' => 1]);

            return response()->json([
                'status' => 'success',
                'message' => 'مفاتيح Stripe صحيحة',
                'data' => $customers
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'خطأ في Stripe: ' . $e->getMessage()
            ]);
        }
    }
}
