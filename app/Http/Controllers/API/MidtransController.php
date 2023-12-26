<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        // set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.serverKey');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    
        // buat instance midtrans notification
        $notification = new Notification();
    
        // assign ke variabel untuk memudahkan koding
        $status = $notification->transaction_status;
        $type = $notification->transaction_type;
        $fraud = $notification->transaction_fraud;
        $order_id = $notification->order_id;

        // cari transkasi berdasarkan ID
        $transaction = Transaction::findOrFail($order_id);
    
        // handle notifikasion status
        if($status == 'capture')
        {
            if($type == 'credit_card')
            {
                if($fraud == 'challenge')
                {
                    $transaction->status = 'pending';
                }
                else
                {
                    $transaction->status = 'succes';
                }
            }
        }
        else if($status == 'settlement')
        {
            $transaction->status = 'succes';
        }
        else if($status == 'pending')
        {
            $transaction->status = 'pending';
        }
        else if($status == 'deny')
        {
            $transaction->status = 'CANCELLED';
        }
        else if($status == 'expire')
        {
            $transaction->status = 'CANCELLED';
        }
        else if($status == 'cancel')
        {
            $transaction->status = 'CANCELLED';
        }
    
        // simpan transaksi
        $transaction->save();

    }

    public function success()
    {
        return view('midtrans.success');
    }

    public function unfinish()
    {
        return view('midtrans.unfinish');
    }

    public function error()
    {
        return view('midtrans.error');
    }
}
