<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function new(){
        return view('payment.new');
    }

    public function payu(Transaction $request){
        $validated = $request->validated();
        dd($validated);
        return view('payment.payu');
    }

    public function success(){
        return view('payment.success');
    }

    public function failure(){
        return view('payment.failure');
    }
}
