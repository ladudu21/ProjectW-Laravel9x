@extends('admin.pages.main')

@section('content')
<div class="customer mt-3">
    <ul>
        <li>Tên khách hàng: <strong>{{ $order->user->name }}</strong></li>
        <li>Số điện thoại: <strong>{{ $order->user->phone }}</strong></li>
        <li>Địa chỉ: <strong>{{ $order->user->address }}</strong></li>
        <li>Email: <strong>{{ $order->user->email }}</strong></li>
    </ul>
</div>

<div>
    <table class="table">
        <tbody>
            <tr class="table_head">
                <th class="column-2">Sản phẩm</th>
                <th class="column-3">Giá</th>
                <th class="column-4">Số lượng</th>
                <th class="column-5">Tổng</th>
            </tr>

            @foreach($order->itemOrders as $item)
            <tr>
                <td class="column-2">{{ $item->productDetail->product->name }}</td>
                <td class="column-3">{{ $item->productDetail->product->price }}</td>
                <td class="column-4">{{ $item->quantity }}</td>
                <td class="column-5">{{ $item->productDetail->product->price * $item->quantity }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-right fw-bold">Tổng Tiền:</td>
                <td>{{ $order->total }} $</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection