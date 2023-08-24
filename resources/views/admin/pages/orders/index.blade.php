@extends('admin.pages.main')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12 text-center">
                <h1>{{ $title }}</h1>
            </div>
            <div class="col-md-10 m-auto">
                @if (session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
                @endif
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">STT</th>
                            <th class="text-center">Người đặt</th>
                            <th class="text-center">Giá trị đơn hàng ($)</th>
                            <th class="text-center">Thời gian đặt</th>
                            <th class="text-center">Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td class="text-center text-muted">#{{ $order->id }}</td>
                            <td class="text-center">{{ $order->user->name }}</td>
                            <td class="text-center">{{ $order->total }}</td>
                            <td class="text-center">{{ $order->created_at }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                    class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                    Chi Tiết
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection