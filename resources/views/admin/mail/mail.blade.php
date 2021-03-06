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
                <h1>C??NG TY THHH TH????NG M???I V?? D???CH V??? VI???N TH??NG AZ</h1>
                <p>?????a ch???: P 202 T???ng 2 - Nh?? 2C - Ng?? H??nh S??n - Tp.???? n???ng</p>
                <p>??i???n Tho???i: 0777531868</p>
            </div>
        </div>
        <div class="content">
            <h3 style="color: red;">HO?? ????N C???A ????N H??NG <span style="  color: red;">S??? {{ $order_mail->id }}</span>
                <span>Ng??y ?????t ????n
                    h??ng: {{ $now }}</span>
            </h3>
            <p>Ch??o b???n: {{ $order_name }} ch??ng t??i ???? x??c nh???n ????n h??ng c???a b???n ???? ?????t h??ng ??? c??ng ty ch??ng t??i g???m
                nh???ng th??ng tin nh?? sau:</p>
            <p>B???n ho???c m???t ai ???? ???? ????ng k?? mua t???i shop c???a m??nh v???i th??ng tin nh?? sau:</p>
            <span>TH??NG TIN ????N H??NG:</span>
            <p>M?? ????n h??ng: {{ $order_mail->order_code }}</p>
            <p>M?? thu??? ??p d???ng: 22.000 ??</p>
            <p>D???ch v???: <span>?????T H??NG TR???C TUY???N</span></p>
            <span>TH??NG TIN NG?????I NH???N:</span>
            <p>Email: {{ $shipping_mail->email }}</p>
            <p>H??? v?? t??n ng?????i g???i: {{ $shipping_mail->name }}</p>
            <p>?????a ch??? nh???n h??ng: {{ $shipping_mail->address }}</p>
            <p>S??? ??i???n tho???i: {{ $shipping_mail->phone }}</p>
            <p>Ghi ch?? ????n h??ng: {{ $shipping_mail->note }}</p>
            <p>H??nh th???c thanh to??n: <span>
                    @if ($shipping_mail->method == 1)
                    {{ 'Thanh to??n lo???i h??nh ATM' }}
                    @elseif($shipping_mail->method == 2)
                    {{ 'Nh???n ti???n m???t' }}
                    @elseif($shipping_mail->method == 3)
                    {{ 'Thanh to??n th??? ghi n???' }}
                    @endif
                    .</span></p>

            <p class="desc">N???u th??ng tin ng?????i nh???n h??ng kh??ng ????ng theo ng?????i ?????t th?? E-shopping s??? li??n h??? v???i ng?????i
                ?????t h??ng ?????
                trao ?????i th??ng tin v??? ????n h??ng ???? ?????t.</p>
        </div>
        <p style="padding: 20px; font-weight: 700">S???N PH???M ???? ???????C CH??NG T??I X??C NH???N</p>
        <div class="table_list">
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Chi ti???t ????n h??ng</th>
                        <th>S??? l?????ng</th>
                        <th>Gi?? ti???n VN??</th>
                        <th>Th??nh ti???n VN??</th>
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
                        <td>{{ number_format( $item->product_price,0,'','.')}} vn??</td>
                        <td>{{ number_format( ( $item->product_sales_quantity * $item->product_price ),0,'','.')}} vn??
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td>Ch??a c?? ????n h??ng n??o c???.</td>
                    </tr>
                    @endforelse


                    <tr>
                        <td colspan="4">T???ng c???ng ch??a c?? thu???: </td>
                        <td>{{ number_format( $sum,0,'','.')}} vn??</td>
                    </tr>
                    <tr>
                        <td colspan="4">T???ng c???ng ???? c?? thu???: </td>
                        <td>{{ number_format( $sumext,0,'','.')}} vn??</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p>Xem l???i l???ch s??? ????n h??ng ???? ?????t c???a b???n ???? ?????t t???i: <a href="#">l???ch s??? ????n h??ng c???a b???n</a></p>
            <p>
                M???i chi ti???t li??n h??? website t???i: <a href="{{ route('home.index') }}"> Shop</a> ho???c li??n h??? qua s???
                hotline: 0777531868.
                Xin c???m
                ??n qu?? kh??ch d?? ?????t h??ng c???a E-Shopping ch??ng t??i.
            </p>
        </div>
    </div>
</body>

</html>
