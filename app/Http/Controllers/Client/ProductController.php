<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\Client\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    // Trang chủ danh mục
    public function index(Category $category, Request $request)
    {
        $products = $this->productService->getProducts($category->id, $request);

        return view('client.pages.category', [
            'title' => $category->name,
            'products' => $products,
            'category' => $category
        ]);
    }

    // Xem thêm sản phẩm
    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->productService->getNewest($page);
        if (count($result) != 0) {
            $html = view('client.pages.products.list', ['products' => $result])->render();

            return response()->json(['html' => $html]);
        }

        return response()->json(['html' => '']);
    }

    public function search_products(Request $request)
    {
        $products = $this->productService->getProducts($request->category_id, $request);

        return view('client.pages.products.list', ['products' => $products])->render();
    }

    public function filter_by(Request $request)
    {
        $products = $this->productService->getProducts($request->category_id, $request);

        return view('client.pages.products.list', ['products' => $products])->render();
    }

    public function show(Product $product)
    {
        return view('client.pages.products.show', [
            'title' => 'Thông tin sản phẩm',
            'product' => $product,
            'sizes' => $this->productService->getSizeProduct($product),
        ]);
    }
}
