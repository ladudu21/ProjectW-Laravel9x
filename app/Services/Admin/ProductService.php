<?php

namespace App\Services\Admin;

use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\ProductDetail;

class ProductService
{
    public function getAll()
    {
        return Product::orderby('id')
            ->simplePaginate(10);
    }

    function getProductDetails($id)
    {
        return ProductDetail::where('product_id', $id)->get();
    }

    function create($request)
    {
        $data = $request->except('_token');
        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $path = 'storage/' . $request->img->storeAs('images', $imageName, 'public');
            $data['img'] = $path;
        }

        return Product::create($data);
    }

    public function update($request, $product)
    {   
        $data = $request->all();
        $data['img'] = $product->img;
        return $product->update($data);
    }

    function delete($product)
    {
        $product->delete();
    }
}
