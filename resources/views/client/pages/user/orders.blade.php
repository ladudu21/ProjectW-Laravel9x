@extends('client.pages.user.infomation')
@section('infomation')
<div class="row container-fluid">
    <div class="col-md-12 m-auto mt-5">
        <h1 class="m-5 text-center">Đơn hàng đã đặt</h1>
        <table class="table table-hover">
            <thead>
                <tr class="table-info">
                    <td>Mã hóa đơn</td>
                    <td>Ngày đặt</td>
                    <td>Tổng tiền</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <th>{{ $order->id }}</th>
                    <th>{{ $order->created_at }}</th>
                    <th>{{ $order->total }} $</th>
                    <th>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-link" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $order->id }}">
                            Chi tiết
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $order->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr class="table table-info">
                                                                <th>Ảnh Sản phẩm</th>
                                                                <th>Tên Sản Phẩm</th>
                                                                <th>Số lượng</th>
                                                                <th>Giá</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->itemOrders as $item)
                                                            <tr>
                                                                <td>
                                                                    <img style="width: 100px"
                                                                        src="{{ $item->productDetail->product->getImg() }}"
                                                                        alt="">
                                                                </td>
                                                                <td>{{ $item->productDetail->product->name }}
                                                                </td>
                                                                <td>{{ $item->productDetail->quantity }}</td>
                                                                <td>{{ $item->productDetail->product->price }}
                                                                    $
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="table table-success">
                                                                <td colspan="3"> Tổng tiền</td>
                                                                <td>{{ $order->total }} $</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary"
                                            data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $orders->links() !!}
    </div>
</div>
@endsection