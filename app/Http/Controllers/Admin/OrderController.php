<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Admin\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        return view('admin.pages.orders.index', [
            'title' => 'Đơn hàng',
            'orders' => $this->orderService->getAll()
        ]);
    }

    public function show(Order $order)
    {
        return view('admin.pages.orders.show', [
            'title' => 'Chi tiết đơn hàng',
            'order' => $order,
        ]);
    }
}
