<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <title>Đơn đặt hàng</title>
</head>

<body
    style="background-color: #e7eff8; font-family: trebuchet,sans-serif; margin-top: 0; box-sizing: border-box; line-height: 1.5;">
    <div class="container-fluid">
        <div class="container" style="background-color: #e7eff8; width: 600px; margin: auto;">
            <div class="col-12 mx-auto" style="width: 580px;  margin: 0 auto;">

                <div class="row">
                    <div class="container-fluid">
                        <div class="row" style="background-color: #e7eff8; height: 10px;">

                        </div>
                    </div>
                </div>

                <div class="row"
                    style="height: 100px; padding: 10px 20px; line-height: 90px; background-color: white; box-sizing: border-box;">
                    <h1 class="pl-2"
                        style="color: orange; line-height: 30px; float: left; padding-left: 20px; font-size: 40px; font-weight: 500;">
                        LaduduShop
                    </h1>
                </div>

                <div class="row" style="background-color: #00509d; height: 200px; padding: 35px; color: white;">
                    <div class="container-fluid">
                        <h3 class="m-0 p-0 mt-4" style="margin-top: 0; font-size: 28px; font-weight: 500;">
                            <strong style="font-size: 32px;">Đơn hàng</strong>
                            <br>
                            Cảm ơn bạn!
                        </h3>
                        <div class="row mt-5" style="margin-top: 35px; display: flex;">
                            <div class="col-6"
                                style="margin-bottom: 25px; flex: 0 0 50%; width: 50%; box-sizing: border-box;">
                                <b>{{ $order->user->name }}</b>
                                <br>
                                <span>
                                    <a style="color: white !important;" href="mailto:{{ $order->user->email }}"
                                        target="_blank">{{ $order->user->email }}</a>
                                </span>
                                <br>
                                <span>{{ $order->user->phone }}</span>
                            </div>
                            <div class="col-6" style="flex: 0 0 50%; width: 50%; box-sizing: border-box;">
                                <b>Ngày Đặt Hàng:</b> {{ date('d/m/yy H:i', strtotime($order->created_at)) }}
                                <br>
                                <b>Nơi Nhận Hàng:</b> {{ $order->user->address }}
                                <br>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2" style="margin-top: 15px;">
                    <div class="container-fluid">
                        <div class="row pl-3 py-2" style="background-color: #f4f8fd; padding: 10px 0 10px 20px;">
                            <b>Chi Tiết Đơn Hàng</b>
                        </div>
                        <div class="row pl-3 py-2" style="background-color: #fff; padding: 10px 20px 10px 20px;">
                            <table class="table table-sm table-hover"
                                style="text-align: left;  width: 100%; margin-bottom: 5px; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th style="padding: 5px 0;">Sản phẩm</th>
                                        <th style="padding: 5px 20px 5px 0; text-align: right;">Giá</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->itemOrders as $item)
                                    <tr>
                                        <td style="border-top: 1px solid #dee2e6; padding: 5px 0;">
                                            {{ $item->productDetail->product->name . ' (x' . $item->quantity .
                                            ')' }}
                                            <br>
                                            {{ '(' . $item->productDetail->size . ')' }}
                                        </td>
                                        <td
                                            style="border-top: 1px solid #dee2e6; padding: 5px 20px 5px 0; text-align: right;">
                                            {{ number_format($item->productDetail->product->price * $item->quantity) }}
                                            $
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-2" style="margin-top: 15px;">
                    <div class="container-fluid">
                        <div class="row pl-3 py-2" style="background-color: #f4f8fd; padding: 10px 0 10px 20px;">
                            <b>Chi Tiết Thanh Toán</b>
                        </div>
                        <div class="row pl-3 py-2"
                            style="background-color: #fff; font-size: 18px; padding: 2px 20px 10px 20px;">
                            <div class="col-12 p-0">
                                <hr style="border-top: 1px solid #0000001a;">
                                <table class="mt-2 w-100"
                                    style="font-size: 16px; width: 100%; text-align: left;  margin-bottom: 5px;">
                                    <tr style="font-size: 18px;">
                                        <td><b>Tổng</b></td>
                                        <td class="pr-3 text-right" style="text-align: right; padding-right: 20px;">
                                            <b>{{ $order->total }}
                                                $</b>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="container-fluid">
                        <div class="row" style="background-color: #e7eff8; height: 10px;">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>