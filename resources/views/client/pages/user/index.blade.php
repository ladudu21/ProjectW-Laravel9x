@extends('client.pages.user.infomation')
@section('infomation')
<div class="row">
    <div class="col-md-12 m-auto mt-5">
        @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
        @endif
        <div class="container pt-5">
            @if ($message = Session::get('message'))
            <div class="alert alert-info alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>
        @error('new_confirm_password')
        <div class="alert alert-info alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <h1 class="m-5 text-center">Thông tin tài khoản</h1>
        <div class="col-md-10 m-auto">
            <div class="mb-3 d-flex align-items-center">
                <label for="" class="col-3">Email</label>
                <input type="text" class="form-control col-7" readonly value="{{ $user->email }}">
            </div>
            <form action="{{ route('update_user') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3 d-flex align-items-center">
                    <label for="address" class="col-3">Địa chỉ</label>
                    <input type="text" class="form-control col-7" value="{{ $user->address }}" name="address"
                        placeholder="Nhập địa chỉ">
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <label for="" class="col-3">Họ tên</label>
                    <input name="name" type="text" class="form-control col-7" value="{{ $user->name }}"
                        placeholder="Nhập họ và tên">
                    @error('name')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <label for="" class="col-3">Số điện thoại</label>
                    <input name="phone" type="text" class="form-control col-7" value="{{ $user->phone }}"
                        placeholder="Nhập số điện thoại">
                    @error('phone')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success ms-auto">
                    <i class="fa-solid fa-user-pen"></i>
                    Cập nhật
                </button>
            </form>

            <div class="mb-3">
                <!-- Button trigger modal CHANGE PASSWORD-->
                <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Đổi mật khẩu.
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cập nhật mật khẩu</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formPasswd" action="{{ route('update_password') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <input type="password" name="old_password" class="form-control"
                                            id="old_password" placeholder="Mật khẩu hiện tại">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="new_password" class="form-control"
                                            id="new_password" placeholder="Mật khẩu mới">
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" name="new_confirm_password" class="form-control"
                                            id="new_confirm_password" placeholder="Nhập lại mật khẩu">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" form="formPasswd" class="btn btn-primary">Xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection