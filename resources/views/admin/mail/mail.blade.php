<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail - E Shopping</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body,
        h1 {
            font-family: 'Poppins', sans-serif;
            color: red;
        }

        p,
        span {
            color: red;
        }

        .container {
            max-width: 760px;
            background-color: #fff;
            margin: 0 auto;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            color: red;
        }

        .logo_left {
            margin-left: 32px;
        }

        .logo_text {
            font-size: 85px;
            color: green;
            z-index: 1000;
        }

        .logo_text span {
            color: #ffd52f;

        }

        .logo_right h1 {
            font-size: 20px;
        }

        .logo_right p {
            font-size: 10px;
        }

        .content {
            padding: 20px;
            font-size: 15px;
            margin-bottom: 10px;
        }

        .content span {
            font-weight: bold;
            color: black;

        }

        .content h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        .content h3 span {

            font-size: 12px;
            margin-left: 10px;
        }

        .content .desc {
            margin-top: 10px;
        }

        .table_list {
            padding: 20px;
        }

        table {
            width: 100%;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid red;
            text-align: center;
        }

        .footer {
            padding: 20px;
        }

        .footer p {
            font-style: italic;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo_left" style="margin-right: 20px;">
                <h1 class="logo_text">A<span>Z</span>
                </h1>
            </div>
            <div class="logo_right" style="margin-top: 30px;">
                <h1>CÔNG TY THHH THƯƠNG MẠI VÀ DỊCH VỤ VIỄN THÔNG AZ</h1>
                <p>Địa chỉ: P 202 Tầng 2 - Nhà 2C - Ngũ Hành Sơn - Tp.Đà nẵng</p>
                <p>Điện Thoại: 0777531868</p>
            </div>
        </div>
        <div class="content">
            <h3 style="color: red;">HOÁ ĐƠN CỦA ĐƠN HÀNG <span style="  color: red;">Số {{ $order_mail->id }}</span>
                <span>Ngày đặt đơn
                    hàng: {{ $now }}</span>
            </h3>
            <p>Chào bạn: {{ $order_name }} chúng tôi đã xác nhận đơn hàng của bạn đã đặt hàng ở công ty chúng tôi gồm
                những thông tin như sau:</p>
            <p>Bạn hoặc một ai đó đã đăng ký mua tại shop của mình với thông tin như sau:</p>
            <span>THÔNG TIN ĐƠN HÀNG:</span>
            <p>Mã đơn hàng: {{ $order_mail->order_code }}</p>
            <p>Mã thuế áp dụng: 22.000 đ</p>
            <p>Dịch vụ: <span>ĐẶT HÀNG TRỰC TUYẾN</span></p>
            <span>THÔNG TIN NGƯỜI NHẬN:</span>
            <p>Email: {{ $shipping_mail->email }}</p>
            <p>Họ và tên người gửi: {{ $shipping_mail->name }}</p>
            <p>Địa chỉ nhận hàng: {{ $shipping_mail->address }}</p>
            <p>Số điện thoại: {{ $shipping_mail->phone }}</p>
            <p>Ghi chú đơn hàng: {{ $shipping_mail->note }}</p>
            <p>Hình thức thanh toán: <span>
                    @if ($shipping_mail->method == 1)
                    {{ 'Thanh toán loại hình ATM' }}
                    @elseif($shipping_mail->method == 2)
                    {{ 'Nhận tiền mặt' }}
                    @elseif($shipping_mail->method == 3)
                    {{ 'Thanh toán thẻ ghi nợ' }}
                    @endif
                    .</span></p>

            <p class="desc">Nếu thông tin người nhận hàng không đúng theo người đặt thì E-shopping sẽ liên hệ với người
                đặt hàng để
                trao đổi thông tin về đơn hàng đã đặt.</p>
        </div>
        <p style="padding: 20px; font-weight: 700">SẢN PHẨM ĐÃ ĐƯỢC CHÚNG TÔI XÁC NHẬN</p>
        <div class="table_list">
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Chi tiết đơn hàng</th>
                        <th>Số lượng</th>
                        <th>Giá tiền VNĐ</th>
                        <th>Thành tiền VNĐ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    $sum = 0;
                    foreach ($orderdetails_mail as $key => $value){
                    $sum += ($value['product_sales_quantity'] * $value['product_price']);
                    }
                    $sumext = $sum + 22000
                    @endphp
                    @forelse ($orderdetails_mail as $item)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->product_sales_quantity }}</td>
                        <td>{{ number_format( $item->product_price,0,'','.')}} vnđ</td>
                        <td>{{ number_format( ( $item->product_sales_quantity * $item->product_price ),0,'','.')}} vnđ
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td>Chưa có đơn hàng nào cả.</td>
                    </tr>
                    @endforelse


                    <tr>
                        <td colspan="4">Tổng cộng chưa có thuế: </td>
                        <td>{{ number_format( $sum,0,'','.')}} vnđ</td>
                    </tr>
                    <tr>
                        <td colspan="4">Tổng cộng đã có thuế: </td>
                        <td>{{ number_format( $sumext,0,'','.')}} vnđ</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p>Xem lại lịch sử đơn hàng đã đặt của bạn đã đặt tại: <a href="#">lịch sử đơn hàng của bạn</a></p>
            <p>
                Mọi chi tiết liên hệ website tại: <a href="{{ route('home.index') }}"> Shop</a> hoặc liên hệ qua số
                hotline: 0777531868.
                Xin cảm
                ơn quý khách dã đặt hàng của E-Shopping chúng tôi.
            </p>
        </div>
    </div>
</body>

</html>
