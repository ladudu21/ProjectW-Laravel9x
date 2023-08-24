<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('client.pages.user.index', [
            'title' => 'Tài khoản',
            'user' => auth()->user()
        ]);
    }

    public function updateUser(UserRequest $request)
    {
        $this->userService->updateUser($request);
        return redirect()->back();
    }

    public function getOrders()
    {
        $orders = $this->userService->getOwnOrders();
        return view('client.pages.user.orders', [
            'title' => 'Đơn hàng',
            'orders' => $orders
        ]);
    }
}
