@extends('client.pages.main')
@section('content')
<div class="container m-t-100">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Shoping Cart
        </span>
    </div>
</div>
<form class="bg0 p-t-130 p-b-85" method="post" id="myForm" action="">
    @if (count($items) != 0)
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        @php $total = 0; @endphp
                        <table class="table-shopping-cart">
                            <tbody>
                                <tr class="table_head">
                                    <th class="column-1">Item</th>
                                    <th class="column-1">Name</th>
                                    <th class="column-1">Size</th>
                                    <th class="column-1">Price</th>
                                    <th class="column-1">Quantity</th>
                                    <th class="column-1"></th>
                                </tr>

                                @foreach($items as $item)
                                @php
                                $priceEnd = $item->product->price * $carts[$item->product->id][$item->id];
                                $total += $priceEnd;
                                @endphp
                                <tr class="table_row">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="{{ asset($item->product->getImg()) }}" alt="IMG">
                                        </div>
                                    </td>
                                    <td class="column-1">{{ $item->product->name }}</td>
                                    <td class="column-1">{{ $item->size }}</td>
                                    <td class="column-1">$ {{ number_format($priceEnd, 0, '', '.') }}</td>
                                    <td class="column-1">
                                        <input class="mtext-104 cl3 txt-center num-item" type="number"
                                            name="num_product[{{ $item->product->id }}][{{ $item->id }}]"
                                            value="{{ $carts[$item->product->id][$item->id] }}" style="width: 80px">
                                    </td>
                                    <td class="column-1">
                                        <a href="#" onclick="removeItem({{ $item->product->id }}, {{ $item->id }})">
                                            Xóa
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                        <button type="submit" formaction="{{ route('update_item') }}"
                            class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                            Cập nhật
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Thanh toán
                    </h4>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                $ {{ number_format($total, 0, '', '.') }}
                            </span>
                        </div>
                    </div>

                    <button type="button"
                        class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer"
                        onclick="checkout()">
                        Đặt hàng
                    </button>
                </div>
            </div>
        </div>
    </div>
    @csrf
    <input type="hidden" id="method" name="_method" value="PUT">
</form>
<script>
    function removeItem(product_id, subProduct_id) {
        $.ajax({
            url: '{{ route('delete_item') }}',
            type: 'DELETE',
            data: {
                _token: "{{ csrf_token() }}",
                product_id : product_id,
                subProduct_id : subProduct_id
            },
            success: function(rs) {
                location.reload();
            }
        });
    }

    function checkout() {
        $('#method').val('POST');
        $('#myForm').attr('action', '/cart' );
        $('#myForm').submit();
    }
</script>
@else
<div class="text-center mb-5">
    <h2>Empty</h2>
</div>
@endif
@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@endsection