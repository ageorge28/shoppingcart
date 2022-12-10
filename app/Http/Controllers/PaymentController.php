<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
// use App\Razorpay\Razorpay\src\Api;
use Razorpay\Api\Api;
use App\Models\Status;
use App\Models\Company;
use App\Mail\WelcomeMail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index(Request $request, $order_id)
    {
        if (is_null($order_id))
        {
            $order_id = $request->order_id;
        }
        $order = Order::find($order_id);
        // $api = new Api('rzp_test_TLlTnyFjmNuRLo', '7X0CZRfl517sCLs75fXq7Ivz');
        // $razorpayorder  = $api->order->create(['receipt' => 'order_rcptid_' . $order->id, 'amount' => $order->cart->total * 100, 'currency' => 'INR']);
        // $orderId = $razorpayorder["id"];
        session()->put('order_id', $order_id);
        $companies = Company::all();
        $title = 'Payment';
        $cart = NULL;
        return view('order', compact('companies', 'order', 'cart', 'title'));
    }

    public function payment(Request $request)
    {
        $order = Order::find(session('order_id'));
        $user = User::find($order->user_id);
        $input = $request->all();

        $api = new Api('rzp_test_TLlTnyFjmNuRLo', '7X0CZRfl517sCLs75fXq7Ivz');
        $method = NULL;

        $payment = $api->payment->fetch($input['razorpay_payment_id']);
 
        if(count($input)  && !empty($input['razorpay_payment_id'])) 
        {
            try 
            {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
            } 
            catch (\Exception $e) 
            {
                $subject = 'Fruitkha Payment Failed';
                $data = ['message' => 'Your payment for Order number ' . $order->number . ' failed. Please retry making the payment from your Dashboard'];
                Mail::to($user->email)->send(new WelcomeMail($data, $subject));

                session()->put('error', $e->getMessage());
                $companies = Company::all();
                $title = 'Payment Failed';
                $cart = NULL;
                $order->flag = 0;
                $status = 'failed';
                $order->status_id =  Status::where('status', 'Order Failed')->first()->id;
                $order->save();
                $transaction = new Transaction();
                $transaction->user_id = $order->user_id;
                $transaction->order_id = $order->id;
                $transaction->api_id = $input['razorpay_payment_id'];
                $transaction->payment_method = 'failed';
                $transaction->amount = $order->cart->total;
                $transaction->flag = 0;
                $transaction->date = now();
                $transaction->save();
                return view('payment', compact('status', 'cart', 'companies', 'title'));
                // return  $e->getMessage();
            }

            $subject = 'Fruitkha Payment Successful';          
            $data = ['message' => 'Your payment for Order number ' . $order->order_number . ' was successful. We will process your order soon'];
            Mail::to($user->email)->send(new WelcomeMail($data, $subject));
            
            // session()->put('success', 'Payment successful, your order will be despatched in the next 48 hours.');
            $status = 'success';
            $companies = Company::all();
            $title = 'Payment Successful';
            $cart = NULL;
            $order->flag = 1;
            $order->status_id = Status::where('status', 'Order Placed')->first()->id;
            $order->save();
            $transaction = new Transaction();
            $transaction->user_id = $order->user_id;
            $transaction->order_id = $order->id;
            $transaction->api_id = $input['razorpay_payment_id'];
            $transaction->payment_method = $response['method'];
            $transaction->amount = $order->cart->total;
            $transaction->flag = 1;
            $transaction->date = now();
            $transaction->save();
            return view('payment', compact('status', 'cart', 'companies', 'title'));
        }
        else
        {
            $subject = 'Fruitkha Payment Failed';
            $data = ['message' => 'Your payment for Order number ' . $order->number . ' failed. Please retry making the payment from your Dashboard'];
            Mail::to($user->email)->send(new WelcomeMail($data, $subject));

            $companies = Company::all();
            $title = 'Payment Failed';
            $cart = NULL;
            $order = Order::find(session('id'));
            $order->flag = 0;
            $status = 'failed';
            $order->status_id = Status::where('status', 'Order Failed')->first()->id();
            $order->save();
            $transaction = new Transaction();
            $transaction->user_id = $order->user_id;
            $transaction->order_id = $order->id;
            $transaction->api_id = $input['razorpay_payment_id'];
            $transaction->payment_method = 'failed';
            $transaction->amount = $order->cart->total;
            $transaction->flag = 0;
            $transaction->date = now();
            $transaction->save();
            return view('payment', compact('status', 'cart', 'companies', 'title'));
        }

        // $order_id = session('order_id');
        // $razorpay_order_id = $request->razorpay_order_id;
        // $razorpay_payment_id = $request->razorpay_payment_id;
        // $razorpay_signature = $request->razorpay_signature;
        // $signature = hash_hmac('sha256', $order_id . "|" . $request->razorpay_payment_id, env('RAZOR_SECRET'));

        // $sample = array();
        // $sample = [
        //     'order_id' => $order_id, 
        //     'razorpay_order_id' => $razorpay_order_id, 
        //     'razorpay_payment_id' => $razorpay_payment_id, 
        //     'razorpay_signature' => $razorpay_signature, 
        //     'signature' => $signature
        // ];

        // ddd($sample);

        // if ($signature == $razorpay_signature)
        // {
        //     $status = 'success';
        //     $order = Order::find(session('id'));
        //     $companies = Company::all();
        //     $cart = NULL;
        //     $order->flag = 1;
        //     $order->status_id = Status::where('status', 'Order Placed')->first()->id;
        //     $order->save();
        //     $transaction = new Transaction();
        //     $transaction->user_id = Auth::id();
        //     $transaction->order_id = $order->id;
        //     $transaction->api_id = 'test';
        //     $transaction->payment_method = 'test';
        //     $transaction->amount = $order->cart->total;
        //     $transaction->flag = 1;
        //     $transaction->date = now();
        //     $transaction->save();
        //     return view('payment', compact('status', 'cart', 'companies'));
        // }
        // else
        // {
        //     $companies = Company::all();
        //     $cart = NULL;
        //     $order = Order::find(session('id'));
        //     $order->flag = 0;
        //     $order->status_id = Status::where('status', 'Order Failed')->first()->id;
        //     $order->save();
        //     $transaction = new Transaction();
        //     $transaction->user_id = Auth::id();
        //     $transaction->order_id = $order->id;
        //     $transaction->api_id = 'test';
        //     $transaction->payment_method = 'test';
        //     $transaction->amount = $order->cart->total;
        //     $transaction->flag = 0;
        //     $transaction->date = now();
        //     $transaction->save();

        //     return view('payment', compact('status', 'cart', 'companies'));
        // }


        // // if ($status == 'success')
        // // {
        //     $order->flag = 1;
        //     $order->status_id = Status::where('status', 'Order Placed')->first()->id;
        //     $order->save();
        //     $transaction = new Transaction();
        //     $transaction->user_id = Auth::id();
        //     $transaction->order_id = $order->id;
        //     $transaction->api_id = 'test';
        //     $transaction->payment_method = 'test';
        //     $transaction->amount = $order->cart->total;
        //     $transaction->flag = 1;
        //     $transaction->date = now();
        //     $transaction->save();

        //     return view('payment', compact('status', 'cart', 'companies'));
        // }
        // elseif ($status == 'failed')
        // {
        //     $order->flag = 0;
        //     $order->status_id = Status::where('status', 'Order Failed')->first()->id;
        //     $order->save();
        //     $transaction = new Transaction();
        //     $transaction->user_id = Auth::id();
        //     $transaction->order_id = $order->id;
        //     $transaction->api_id = 'test';
        //     $transaction->payment_method = 'test';
        //     $transaction->amount = $order->cart->total;
        //     $transaction->flag = 0;
        //     $transaction->date = now();
        //     $transaction->save();

        //     return view('payment', compact('status', 'cart', 'companies'));
        // }

        // return view('payment', compact('status', 'cart', 'companies'));
    }
}
