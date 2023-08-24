@extends('admin.pages.main')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title }}</h1>
            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center">
                            <div class="col-12">
                                <img src="{{ asset($product->getImg()) }}" class="product-image" alt="Product Image"
                                    style="width: 400px">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <p class="my-3">Tên sản phẩm: {{ $product->name }}</p>
                            <p>Mô tả:</p>
                            <textarea>{{ $product->description }}</textarea>
                            @if(is_null($product->category_id))
                            <p class="text-muted">Danh mục: Không</p>
                            @else
                            <p class="text-muted">Danh mục: {{ $product->category->name }}</p>
                            @endif

                            <div class="bg-gray py-2 px-3 mt-4">
                                <h2 class="mb-0">
                                    Giá: {{ $product->price }} VND
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Quản lý</h1>
            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Size</th>
                                <th>Số lượng</th>
                                <th>
                                    <button type="button" class="btn btn-primary btn-add" data-toggle="modal"
                                        data-target="#addModal">
                                        Thêm
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productDetails as $productDetail)
                            <tr>
                                <td>{{ $productDetail->size }}</td>
                                <td>{{ $productDetail->quantity }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-edit" data-toggle="modal"
                                        data-target="#editModal{{$productDetail->id}}">
                                        Sửa
                                    </button>
                                </td>
                                </td>
                            </tr>

                            <div class="modal" id="editModal{{ $productDetail->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Sửa chi tiết sản phẩm</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editDetailForm" method="POST"
                                                action="{{ route('admin.product-details.update', $productDetail) }}">
                                                @method('PUT')
                                                @csrf
                                                <div class="form-group">
                                                    <label for="size">Size</label>
                                                    <p id="size">{{ $productDetail->size }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity">Số lượng</label>
                                                    <input type="number" min="1" step="1" maxlength="10"
                                                        class="form-control" id="quantity" name="quantity" required
                                                        value="{{ $productDetail->quantity }}">
                                                </div>
                                                <button type="submit" id="submitUpdate"
                                                    class="btn btn-primary">sửa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<div class="modal" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm size sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addDetailForm" method="POST" action="{{ route('admin.product-details.store') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="form-group">
                        <label for="size">Size</label>
                        <select name="size" id="size" class="form-control">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Số lượng</label>
                        <input type="number" min="1" step="1" maxlength="10" class="form-control" id="quantity"
                            name="quantity" required>
                    </div>
                    <button type="submit" id="submitUpdate" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection