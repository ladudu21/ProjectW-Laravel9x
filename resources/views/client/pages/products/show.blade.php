@extends('client.pages.main')
@section('content')
<div class="container mt-5">
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-5 p-b-30">
                    <div>
                        <img src="{{ asset($product->getImg()) }}" class="product-image" alt="Product Image"
                            style="width: 400px">
                    </div>
                </div>
                <div class="col-md-7 p-b-30">
                    <div class="p-r-200 p-t-5 p-lr-0-lg">
                        <h3 class="cl2 js-name-detail p-b-14">
                            {{ $product->name }}
                        </h3>

                        <span class="mtext-106 cl2">
                            {{ number_format($product->price) }} VND
                        </span>

                        <!-- Form -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Kích cỡ
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="form-control" name="size" id="size" data-id="{{ $product->id }}">
                                            <option value="" disabled selected hidden>Chọn kích cỡ</option>
                                            @foreach ($sizes as $size)
                                            <option value="{{ $size['size'] }}">{{ $size['size'] }}</option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-204 flex-w flex-m respon6-next">
                                    <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                        <div class="btn-num-product-down  flex-c-m">
                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                        </div>
                                        <input class="mtext-104 cl3 txt-center num-product" type="number" min="1"
                                            name="quantity" id="quantity" value="1">
                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                        </div>
                                    </div>
                                    <button
                                        class="flex-c-m cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                        Thêm vào giỏ hàng
                                    </button>
                                </div>
                            </div>
                        </div>
                        @if (session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger text-center">
                            Loại sản phẩm hoặc số lượng mua không phù hợp.Vui lòng kiểm tra lại.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#description" role="tab">
                                Mô tả sản phẩm
                            </a>
                        </li>

                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information" role="tab">
                                Bảng size tiêu chuẩn
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class=" cl6">
                                    {{$product->description}}
                                </p>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <img src="/storage/images/products/sizes/size.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="cl6 p-lr-25">
                Danh mục: {{ $product->category->name }}
            </span>
        </div>
    </section>
</div>

<script>
    $('.js-addcart-detail').each(function() {
        var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
        $(this).on('click', function() {
            var qty = $('#quantity').val();
            var size = $('#size').val();
            var product_id = {{ $product->id }};

            if (size === null) {
                alert("Vui lòng chọn size!")
                return;
            }

            $.ajax({
                url: '{{ route('add_item') }}',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: product_id,
                    qty: qty,
                    size: size,
                },
                success: function(rs) {
                    if (rs.error == false){
                        swal(nameProduct, "đã thêm vào giỏ hàng !", "success")
                    }
                    else swal(nameProduct, "đã có lỗi xảy ra !", "error")
                }
            })
        });
    });

</script>
@endsection
