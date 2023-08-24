<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;

class UserService
{
    public function getAll()
    {
        return User::paginate(10);
    }

    public function updateUser($request)
    {
        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();
    }

    public function getOwnOrders()
    {
        return Order::where('user_id', auth()->user()->id)->paginate(8);
    }
}
