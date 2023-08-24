@extends('admin.pages.main')
@section('content')
<div class="container-fluid">
    <a href="{{ route('admin.products.index') }}" type="button" class="btn btn-secondary">
        <i class="fa-solid fa-circle-left"></i>
        Quay lại
    </a>
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title }}</h1>
        </div>
        <div class="col-md-8 mx-auto mt-5">
            @if (session('msg'))
            <div class="alert alert-success text-center">{{ session('msg') }}</div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger text-center">
                Thông tin điền vào chưa đúng. Vui lòng nhập lại.
            </div>
            @endif
            <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                    @error('name')
                    <span style="color:red">{{$message}}</span>
                    @enderror
                    @error('slug')
                    <span style="color:red">{{$message}}</span>
                    @enderror
                    <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}">
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục</label>
                    @error('category_id')
                    <span style="color:red">{{$message}}</span>
                    @enderror
                    <select class="form-control" name="category_id">
                        <option value="0">Không</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Giá</label>
                    @error('price')
                    <span style="color:red">{{$message}}</span>
                    @enderror
                    <input type="text" name="price" class="form-control" id="price" value="{{old('price')}}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    @error('description')
                    <span style="color:red">{{$message}}</span>
                    @enderror
                    <textarea class="form-control" id="description"
                        name="description">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Ảnh</label>
                    <input type="file" name="img" onchange="preview()">
                    <img id="imagePreview" src="" alt="Preview" width="100px" height="100px">
                </div>

                <button type="submit" class="btn-shadow btn-hover-shine btn btn-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-8">
                        <i class="fa fa-download fa-w-20"></i>
                    </span>
                    <span>Lưu</span>
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    function preview() {
        imagePreview.src=URL.createObjectURL(event.target.files[0]);
    }
</script>
@endsection