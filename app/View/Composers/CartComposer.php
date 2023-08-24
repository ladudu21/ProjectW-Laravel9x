<?php

namespace App\View\Composers;

use App\Models\Category;
use App\Services\CartService;
use Illuminate\View\View;

class CartComposer
{
    protected $users;

    public function __construct()
    {
    }

    public function compose(View $view)
    {
        $cartService = new CartService();
        $items =  $cartService->getCartItems();

        $view->with('items', $items);
    }
}
