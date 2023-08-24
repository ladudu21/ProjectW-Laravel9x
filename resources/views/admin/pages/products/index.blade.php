@extends('admin.pages.main')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title }}</h1>
            @if (session('msg'))
            <div class="alert alert-success text-center">{{ session('msg') }}</div>
            @endif
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Tên</th>
                                <th class="text-center">Danh mục</th>
                                <th class="text-center">Cập nhật</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td class="text-center text-muted">#{{ $product->id }}</td>
                                <td class="text-center">{{ $product->name }}</td>
                                @if(is_null($product->category_id))
                                <td class="text-center">Không</td>
                                @else
                                <td class="text-center">{{ $product->category->name }}</td>
                                @endif
                                <td class="text-center">{{ $product->updated_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.products.show', $product) }}"
                                        class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                        Chi Tiết
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" data-toggle="tooltip"
                                        title="Sửa" data-placement="bottom"
                                        class="btn btn-outline-warning border-0 btn-sm">
                                        <span class="btn-icon-wrapper opacity-8">
                                            <i class="fa fa-edit fa-w-20"></i>
                                        </span>
                                    </a>
                                    <form class="d-inline" action="{{ route('admin.products.destroy', $product) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-hover-shine btn-outline-danger border-0 btn-sm"
                                            type="submit" data-toggle="tooltip" title="Xóa" data-placement="bottom"
                                            onclick="return confirm('Bạn thật sự muốn xóa?')">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="fa fa-trash fa-w-20"></i>
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection