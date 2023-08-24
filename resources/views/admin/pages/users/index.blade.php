@extends('admin.pages.main')
@section('content')
<div class="col-md-12 text-center">
    <h1>Danh sách người dùng</h1>
</div>
<div class="col-md-10 m-auto text-center">
    <table class="table table-hover">
        <tr class="table-info">
            <th>
                ID
            </th>
            <th>
                Tên
            </th>
            <th>
                Số điện thoại
            </th>
            <th>
                Email
            </th>
            <th>
                Địa chỉ
            </th>
            <th>
                Vai trò
            </th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>
                {{ $user->id }}
            </td>
            <td>
                {{ $user->name }}
            </td>
            <td>
                {{ $user->phone }}
            </td>
            <td>
                {{ $user->email }}
            </td>
            <td>
                {{ $user->address ?? 'Chưa cập nhật'}}
            </td>
            <td>
                {{ ($user->role == 1) ?  'Admin' : 'User'}}
            </td>
        </tr>
        @endforeach
    </table>
    {!! $users->links() !!}
</div>
@endsection