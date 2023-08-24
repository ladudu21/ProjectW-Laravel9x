<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Client\ProductService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    // Trang chủ 
    public function index()
    {
        return view('client.pages.home', [
            'title' => 'Trang chủ',
            'products' => $this->productService->getNewest()
        ]);
    }
}