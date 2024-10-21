<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Transaction;

class DonationController extends Controller
{




    public function pay(Request $request){

        $transaction = Donation::create([
            'code'   => 'DONATION-' . mt_rand(100000, 999999),
            'name'   => $request->name,
            'email'  => $request->email,
            'amount' => $request->amount,
            'note'   => "-",
        ]);
        \Midtrans\Config::$serverKey    = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('midtrans.is3ds');


        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->amount,
            ),
            'customer_details' => array(
                'first_name' => $request->name,
                'email'      => $request->email,

            ),

        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->snap_token = $snapToken;
        $transaction->save();

        // return redirect()->route('bayarbro');
        return response()->json(['success' => true, 'isi'=>$transaction]);
    }
}
