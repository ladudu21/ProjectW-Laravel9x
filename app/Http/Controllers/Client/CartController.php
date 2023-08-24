<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addItem(Request $request)
    {

        $result = $this->cartService->addItemToCart($request);
        if ($result) {
            return response()->json([
                'error' => false,
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }

    public function show()
    {
        return view('client.pages.cart', [
            'title' => 'Giỏ hàng',
            'carts' => Session::get('carts')
        ]);
    }

    public function updateItem(Request $request)
    {
        $this->cartService->updateItem($request);
        return redirect()->back();
    }

    public function deleteItem(Request $request)
    {
        $this->cartService->deleteItem($request->product_id, $request->subProduct_id);
        return response()->json([
            'error' => false
        ]);
    }

    public function checkout()
    {
        $this->cartService->checkout();
        return redirect()->back();
    }
}
