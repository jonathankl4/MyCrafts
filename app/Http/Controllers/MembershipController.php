<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;

class MembershipController extends Controller
{
    //
    public function getLogUser()
    {
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }

    public function getToko()
    {
        $user = $this->getLogUser();

        $toko = toko::find($user->id_toko);
        return $toko;
    }

    public function membershipPage()
    {

        $user = $this->getLogUser();

        return view('seller.membership', ['user' => $user]);
    }
    public function checkoutPage(Request $request)
    {

        $user = $this->getLogUser();


        $paket = $request->paket;

        $data = [];
        if ($paket == 'paket1') {
            # code...
            $data['paket'] = 'Paket 1 Bulan';
            $data['harga'] = '100000';
            $data['hemat'] = 'Harga Normal';
        } else if ($paket == 'paket2') {
            $data['paket'] = 'Paket 6 Bulan';
            $data['harga'] = '500000';
            $data['hemat'] = 'Hemat Hingga Rp 100.000';
        } else if ($paket == 'paket3') {
            $data['paket'] = 'Paket 12 Bulan';
            $data['harga'] = '900000';
            $data['hemat'] = 'Hemat Hingga Rp 300.000';
        }

        $transaction = Donation::create([
            'code'   => 'DONATION-' . mt_rand(100000, 999999),
            'name'   => $user->username,
            'email'  => $user->email,
            'amount' => $data['harga'],
            'note'   => "-",
            'pilihan' => 'membership',

        ]);
        \Midtrans\Config::$serverKey    = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('midtrans.is3ds');


        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $data['harga'],
            ),
            'customer_details' => array(
                'first_name' => $user->username,
                'email'      => $user->email,

            ),

        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->snap_token = $snapToken;
        $transaction->save();




        return view('seller.checkoutMembership', ['user' => $user, 'data' => $data, 'pembayaran' => $transaction]);
    }

    public function checkout(Request $request)
    {
        $user = $this->getLogUser();
        $toko = $this->getToko();

        $harga = $request->input('paket');

        // Cek apakah toko masih memiliki membership yang belum expired
        $currentDate = Carbon::now();
        $expiresAt = $toko->membership_expires_at;

        if ($expiresAt && $expiresAt > $currentDate) {
            // Jika masih ada membership yang berlaku, tambahkan dari membership_expires_at
            $startDate = Carbon::parse($expiresAt);
        } else {
            // Jika tidak ada membership yang berlaku, mulai dari hari ini
            $startDate = $currentDate;
        }

        // Tentukan membership berdasarkan paket yang dipilih
        switch ($harga) {
            case '100000':
                $toko->membership_type = '1-month';
                $toko->membership_expires_at = $startDate->addMonth(); // Menambah 1 bulan
                break;
            case '500000':
                $toko->membership_type = '6-months';
                $toko->membership_expires_at = $startDate->addMonths(6); // Menambah 6 bulan
                break;
            case '900000':
                $toko->membership_type = '12-months';
                $toko->membership_expires_at = $startDate->addYear(); // Menambah 12 bulan
                break;
            default:
                return response()->json(['status' => 'error', 'message' => 'Paket tidak valid.']);
        }

        $toko->status = 'Pro';
        $toko->save();

        return response()->json(['status' => 'success']);
    }

    public function checkExpiredMembership()
    {
        // Find all expired memberships
        $tokos = Toko::where('membership_expires_at', '<', Carbon::now())->get();

        foreach ($tokos as $toko) {
            // Revert to 'free' membership when expired
            $toko->update([
                'membership_type' => 'free',
                'membership_expires_at' => null,
                'status' => 'Free'
            ]);
        }

        return response()->json(['message' => 'Expired memberships have been updated.']);
    }
}
