<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\order;
use App\Model\order_details;
use App\Model\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    private $shipping;
    private $order;
    private $order_details;
    public function __construct(Shipping $shipping, order $order, order_details $order_details)
    {
        $this->shipping = $shipping;
        $this->order = $order;
        $this->order_details = $order_details;
    }
    public function index()
    {
        $carts = [];
        if (session()->has('card')) {
            $carts = session()->get('card');
        }
        return view('frontend.checkout.list', compact('carts'));
    }

    public function getInformation(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        // insert shipping
        $shipping = $this->shipping->create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "note" => $request->message,
            'user_id' => auth()->user()->id,
            "method" => $request->payment_option,
            'created_at' => Carbon::now()
        ]);

        $rand_code = substr(md5(microtime()), rand(0, 26), 5);

        //insertorders
        $order = $this->order->create([
            "user_id" => auth()->user()->id,
            "shipping_id" => $shipping->id,
            "order_code" => $rand_code,
            "order_status" => 1,
            'created_at' => Carbon::now()
        ]);

        //insertorders_details
        if ($request->session()->has('card')) {
            $products  = $request->session()->get('card');
            foreach ($products as $key => $value) {

                $order_details = $this->order_details->create([
                    "order_code" => $rand_code,
                    "product_id" => $value['id'],
                    "product_name" => $value['name'],
                    "product_price" => $value['price'],
                    "product_sales_quantity" => $value['quantity'],
                    "product_ext" => "22000",
                    'created_at' => Carbon::now()
                ]);
            }
        }
        $orderdetails_mail =  $this->order_details->where('order_code', $order->order_code)->get();
        $shipping_mail = $this->shipping->find($shipping->id);
        $order_mail = $this->order->find($order->id);

        $order_email = auth()->user()->email;
        $order_name =  auth()->user()->name;
        $mail_admin = 'shopthuongmaiwebiste@gmail.com';

        $now = Carbon::now("Asia/Ho_Chi_Minh")->format("d/m/Y H:i:s");
        $title_mail = 'Đơn hàng xác nhận ngày ' . $now;
        Mail::send('frontend.mail.mail', compact('order_name', 'order_mail', 'shipping_mail', 'orderdetails_mail', 'now'), function ($email) use ($order_email, $order_name, $title_mail, $mail_admin) {
            $email->subject('Email đặt hàng thành công. ' . $title_mail);
            $email->to($order_email, $order_name, $mail_admin);
        });

        if ($request->payment_option == 1) {
            echo 'Thanh toán loại hình ATM';
        } else if ($request->payment_option == 2) {
            $request->session()->forget('card');
            return view('frontend.checkout.hashcard');
        } else {
            echo 'Thanh toán thẻ ghi nợ';
        }
        //send mail

        // return redirect()->route('home.index');
    }
}