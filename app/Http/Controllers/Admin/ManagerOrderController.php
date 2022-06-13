<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\History;
use App\Model\order;
use App\Model\order_details;
use App\Model\Products;
use App\Model\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class ManagerOrderController extends Controller
{
    private $order;
    private $product;
    private $shipping;
    private $history;
    private $orderdetails;

    public function __construct(order $order, order_details $orderdetails, Products $product, Shipping $shipping, History $history)
    {
        $this->order = $order;
        $this->product = $product;
        $this->history = $history;
        $this->shipping = $shipping;
        $this->orderdetails = $orderdetails;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Home';
        $key = 'List Order';
        $manager_orders = $this->order->latest()->paginate(10);
        return view('admin.manager-order.list', compact('title', 'key', 'manager_orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($order_code)
    {

        $title = 'Home';
        $key = 'List Order Details';
        $orderId = $this->order->where('order_code', $order_code)->first();
        //chi tiết đơn hàng

        $order_details = $this->order
            ->join('order_details', 'orders.order_code', '=', 'order_details.order_code')
            ->where('orders.order_code', $order_code)->get();


        foreach ($order_details as $or) {

            $items =  $this->orderdetails->find($or->id)->products;
            $row[] = $items;
        }


        return view('admin.manager-order.list-details', compact('title', 'key', 'orderId', 'order_details', 'row'));
    }

    public function print_code($order_code)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($order_code));
        return $pdf->stream();
    }
    public function print_order_convert($order_code)
    {
        $i = 1;
        $j = 1;
        $k = 1;
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $orderId = $this->order->where('order_code', $order_code)->first();

        $order_details = DB::table('orders')
            ->join('order_details', 'orders.order_code', '=', 'order_details.order_code')
            ->where('orders.order_code', $order_code)->get();
        //tổng tiền
        $sum = 0;

        foreach ($order_details as $order_detail) {
            $product_ext = $order_detail->product_ext;
            $sum += $order_detail->product_price * $order_detail->product_sales_quantity;
        }
        $html = '';
        $html .=
            '<!DOCTYPE html>
            <html lang="en">
            <head>

                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>CTYTNHHMTV AZ</title>
                <style>
                    body{
                        font-family:DejaVu Sans;
                    }
                    tr, td{
                        font-size: 10px;
                    }
                    table, th, td {
                        border: 1px solid black;
                      }
                </style>
            </head>
            <body>
                    <h1 style="font-size:20px;">CÔNG TY TNHH MTV AZ</h1>
                    <p style="font-size:10px; ">P 202 Tầng 2 - Nhà 2C - Ngũ Hành Sơn - Tp.Đà nẵng </p>
                    <p style="font-size:10px; ">Number Phone: 0777531868 </p>
                    <hr>
                    <h3 style="font-size:15px; text-align:center;">ĐƠN ĐẶT HÀNG</h3>
                    <div class="date"style="margin-left:250px; margin-top:-20px;">
                        <span style="font-size:10px; ">Ngày đặt phiếu: ' . date("d/m/Y", strtotime(Carbon::now())) . '</span>
                        <span style="font-size:10px; margin-left:10px;">Số đơn đặt: ' . strtoupper($order_code) . '</span>
                    </div>
                    <div>
                        <p style="font-size: 15px;color:green">Thông tin khách hàng</p>
                        <table >
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên khách hàng</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Số điện thoại</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <th scope="row">' . $i++ . ' </th>
                                    <td>' . $orderId->user->name . ' </td>
                                    <td>' . $orderId->user->email . '</td>
                                    <td>' . $orderId->user->phone . '</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <p style="font-size: 15px;color:green">Thông tin người nhận hàng</p>
                        <table >
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên người vận chuyển</th>
                                    <th scope="col">Địa chỉ</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Hình thức thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <th scope="row">' . $j++ . ' </th>
                                    <td style="text-align:center;">' . $orderId->shipping->name . '</td>
                                    <td style="text-align:center;">' . $orderId->shipping->address . '</td>
                                    <td style="text-align:center;">' . $orderId->shipping->phone . '</td>';

        if ($orderId->shipping->method == 1) {
            $html .=   '<td>' . "Trả bằng thẻ ATM" . '</td>';
        } elseif ($orderId->shipping->method == 2) {
            $html .= '<td>' . "Nhận tiền mặt" . '</td>';
        } else {
            $html .= '<td>' . "Thanh toán thẻ ghi nợ" . '</td>';
        }

        $html .= '
                                </tr>
                             </tbody>
                        </table>
                    </div>

                    <div>
                        <p style="font-size: 15px;color:green">Thông tin đơn đặt hàng</p>
                        <table >
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Mã đơn hàng</th>
                                    <th scope="col">Số lượng</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Ngày đặt</th>
                                </tr>
                            </thead>
                            <tbody>';

        foreach ($order_details as $order_detail) {
            $html .= '<tr>
                        <th scope="row">' . $k++ . ' </th>
                        <td style="text-align:center;">' . $order_detail->product_name . '</td>
                        <td style="text-align:center;">' . strtoupper($order_detail->order_code) . '</td>
                        <td style="text-align:center;">' . $order_detail->product_sales_quantity . '</td>
                        <td style="text-align:center;">' . number_format($order_detail->product_price, 0, '', '.') . ' đ</td>
                        <td style="text-align:center;">' . number_format(($order_detail->product_price * $order_detail->product_sales_quantity), 0, '', '.') . ' đ</td>
                        <td>' . date('d/m/Y H:i:s', strtotime($order_detail->created_at)) . '</td>

                    </tr>';
        }
        $html .= ' </tbody>
                        </table>
                    </div>';

        $html .= '<table > <tbody>
        <tr  style=" font-size:10px;" >
                    <td>
                    Thuế: <span style="background-color: #3189f3; color: #fff">' . number_format(
            $product_ext,
            0,
            '',
            '.'
        ) . ' đ</span>
                                <p>Tổng tiền chưa có thuế: <span style="background-color: #3189f3; color: #fff">' .
            number_format($sum, 0, '', '.')  . ' đ</span></p>
                                <p>Tổng tiền đã có thuế: <span style="background-color: #3189f3; color: #fff">' .
            number_format($sum + $product_ext, 0, '', '.') . ' đ</span></p>
                        </td>
                </tr> </tbody> </table>';

        $html .=   '
                        <p style="font-size:12px;">Ký tên</p>
                        <span style="font-size:13px;">Người lập phiếu</span>
                        <span style="font-size:13px; margin-left:65%">Người nhận</span>
        </body>
            </html>';

        return $html;
    }

    public function update_quantity(Request $request)
    {
        $data = '';
        if ($request->ajax()) {
            $order_id = $request->order_id;
            $order_status = $request->order_status;
            $array_id = $request->array_id;
            $array_quantity = $request->array_quantity;
            $orderId = $this->order->find($order_id);
            $orderId->update(['order_status' => $order_status]);

            if ($order_status == 2) {
                foreach ($array_id as $key => $value_id) {
                    $product = $this->product->find($value_id);
                    $product['products_sold'];
                    $product['quantity'];
                    foreach ($array_quantity as $key2 => $value_quantity) {
                        if ($key == $key2) {
                            //cập lại số lượng tồn kho
                            if (($product['quantity'] - 1) < 1) {
                                $product['quantity'] = 0;
                                $data = 'Hết hàng ' . $product['name'];
                            } else {
                                $product['quantity'] = $product['quantity'] -  $value_quantity;
                            }
                            //cập lại số lượng người đã mua
                            $product['products_sold'] +=  $value_quantity;
                        }
                    }

                    $product->update(['quantity' => $product['quantity'], 'products_sold' => $product['products_sold']]);
                }
                $order = $this->order->find($order_id);
                $shipping = $this->shipping->find($order->shipping->id);
                $orderdetails_mail =  $this->orderdetails->where('order_code', $order->order_code)->get();
                $shipping_mail = $this->shipping->find($shipping->id);
                $order_mail = $this->order->find($order->id);

                $order_email = $order->user->email;
                $order_name =   $order->user->name;
                $now = Carbon::now("Asia/Ho_Chi_Minh")->format("d/m/Y H:i:s");
                foreach ($orderdetails_mail as $order_details_history) {
                    $insert =   $this->history->create([
                        'email' => $order->user->email,
                        'phone' => $order->user->phone,
                        'name' => $order_details_history->product_name,
                        'price' => $order_details_history->product_price,
                        'quantity' => $order_details_history->product_sales_quantity,
                        'user_id' => $order->user->id,
                        'created_at' =>  $now
                    ]);
                }
                $title_mail = 'Đơn hàng xác nhận thành công ngày ' . $now;
                Mail::send('admin.mail.mail', compact('order_name', 'order_mail', 'shipping_mail', 'orderdetails_mail', 'now'), function ($email) use ($order_email, $order_name, $title_mail) {
                    $email->subject($title_mail);
                    $email->to($order_email, $order_name);
                });
            } elseif ($order_status == 3) {
                foreach ($array_id as $key => $value_id) {
                    $product = $this->product->find($value_id);
                    $product['products_sold'];
                    $product['quantity'];
                    foreach ($array_quantity as $key2 => $value_quantity) {
                        if ($key == $key2) {
                            //cập lại số lượng tồn kho
                            $product['quantity'] = $product['quantity'] +  $value_quantity;
                            //cập lại số lượng người đã mua
                            if ($product['products_sold'] <= 0) {
                                $product['products_sold'] = 0;
                            } else {
                                $product['products_sold'] -=  $value_quantity;
                            }
                        }
                    }

                    $product->update(['quantity' => $product['quantity'], 'products_sold' => $product['products_sold']]);
                }
            }
        }
        //send mail


        return response()->json([
            'code' => 200,
            'data' => $data,
            'messages' => 'Đã cập nhật thành công'
        ], 200);
    }
}