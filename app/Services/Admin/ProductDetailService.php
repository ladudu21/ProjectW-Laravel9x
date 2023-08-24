<?php

namespace App\Services\Admin;

use App\Models\ProductDetail;

class ProductDetailService
{
    function update($request, $productDetail)
    {
        $productDetail->update($request->all());
    }

    function create($request)
    {
        if (ProductDetail::where([
            [
                'size', $request->size
            ],
            [
                'product_id', $request->product_id
            ]
        ])->exists()) return false;
        
        return ProductDetail::create($request->all());
    }
}
