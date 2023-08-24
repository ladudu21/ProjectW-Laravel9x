<?php

namespace App\Services\Admin;

use App\Models\Order;

class OrderService
{
    function getAll()
    {
        return Order::paginate(10);
    }
}
