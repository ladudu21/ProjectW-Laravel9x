<?php

namespace App\Services\Client;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDetail;

class ProductService
{
    const LIMIT = 8;

    //Lấy tất cả sản phẩm
    function getAll()
    {
    }

    //Lấy sản phẩm gần nhất
    public function getNewest($page = null)
    {
        return Product::orderByDesc('id')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
            })
            ->limit(self::LIMIT)
            ->get();
    }

    // Lấy sản phẩm theo danh mục
    public function getProducts($category_id, $request)
    {
        $sub_categories = Category::with('childrenRecursive')
            ->where('id', $category_id)
            ->get()
            ->toArray();

        $flatten = $this->flatten($sub_categories);

        $category_Ids = array_map(function ($value) {
            return $value['id'];
        }, $flatten);

        $result = Product::whereIn('category_id', $category_Ids);

        if ($request->input('search_product')) {
            $request->validate([
                'search_product' => 'required|string|max:50',
            ]);
            $result->where('name', 'LIKE', '%' . $request->input('search_product') . '%')->paginate(12);
        }

        if ($request->input('sort_by')) {
            switch ($request->sort_by) {
                case 'az':
                    $result->orderBy('name');
                    break;
                case 'za':
                    $result->orderBy('name', 'desc');
                    break;
                case 'priceUp':
                    $result->orderBy('price');
                    break;
                case 'priceDown':
                    $result->orderBy('price', 'desc');
                    break;
                default:
                    $result->orderBy('id');
                    break;
            }
        }

        if ($request->input('filter_size') && $request->filter_size != "all") {
            $result->whereHas('productDetails', function ($query) use ($request) {
                $query->where('size', $request->filter_size);
            });
        }

        return $result
            ->paginate(self::LIMIT)
            ->withQueryString();
    }

    // Làm phẳng mảng danh mục và con của nó
    public function flatten($array)
    {
        $flatArray = [];

        if (!is_array($array)) {
            $array = (array)$array;
        }

        foreach ($array as $key => $value) {
            if (is_array($value) || is_object($value)) {
                $flatArray = array_merge($flatArray, $this->flatten($value));
            } else {
                $flatArray[0][$key] = $value;
            }
        }

        return $flatArray;
    }

    public function getSizeProduct($product)
    {
        return ProductDetail::select('size')
            ->where([
                ['product_id', $product->id],
                ['quantity', '>', 0]
            ])
            ->groupBy('size')
            ->get();
    }
}
