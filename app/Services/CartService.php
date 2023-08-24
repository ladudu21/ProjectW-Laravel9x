<?php

namespace App\Services;

use App\Models\ItemOrder;
use App\Models\Order;
use App\Models\ProductDetail;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    function addItemToCart($request)
    {
        $qty = $request->input('qty');
        $product_id = $request->input('product_id');
        $size = $request->input('size');

        $product_detail = ProductDetail::where([
            ['product_id', $product_id],
            ['size', $size]
        ])->first();

        if ($qty > $product_detail->quantity) return false;

        $product_detail_id = $product_detail->id;

        if ($qty <= 0) return false;

        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => [
                    $product_detail_id => $qty
                ]
            ]);
            return true;
        }

        try {
            $exists = Arr::exists(data_get($carts, $product_id), $product_detail_id);
            if ($exists) {
                $carts[$product_id][$product_detail_id] = $carts[$product_id][$product_detail_id] + $qty;
                Session::put('carts', $carts);
                return true;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        $carts[$product_id][$product_detail_id] = $qty;
        Session::put('carts', $carts);

        return true;
    }

    public function getCartItems()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) return [];

        $listItems = [];
        foreach ($carts as $product_id) {
            $listItems = array_merge($listItems, array_keys($product_id));
        }
        return ProductDetail::whereIn('id', $listItems)
            ->get();
    }

    public function updateItem($request)
    {
        $tmp_carts = $request->input('num_product');

        foreach ($tmp_carts as $product_id) {
            foreach ($product_id as $subProduct_id => $qty) {
                if ($qty == 0) {
                    CartService::deleteItem($product_id, $subProduct_id);
                    unset($tmp_carts[$product_id][$subProduct_id]);
                }
            }
        }

        Session::put('carts', $tmp_carts);
        return true;
    }

    public function deleteItem($product_id, $subProduct_id)
    {
        $carts = Session::get('carts');
        unset($carts[$product_id][$subProduct_id]);

        if (empty($carts[$product_id])) unset($carts[$product_id]);

        Session::put('carts', $carts);
        return true;
    }

    public function checkout()
    {
        try {
            DB::beginTransaction();

            $carts = Session::get('carts');
            $user_id = auth()->user()->id;

            if (is_null($carts)) return false;

            $order = Order::create([
                'user_id' => $user_id,
                'total' => 0
            ]);

            $addCart = $this->inforOrder($carts, $order->id);

            if ($addCart == false) {
                throw new Exception("Số lượng sp k đủ");
            }
            else $order->update([
                'total' => $addCart
            ]);

            DB::commit();
            Session::flash('success', 'Đặt hàng thành công');

            #Queue
            // $products = $this->getProducts();
            // SendMail::dispatch($request->input('name'), $request->input('email'), $products, $carts)->delay(now()->addSeconds(2));

            Session::forget('carts');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Đặt hàng thất bại');
            return false;
        }

        return true;
    }

    protected function inforOrder($carts, $order_id)
    {
        $data = [];
        $total = 0;
        foreach ($carts as $product_id) {
            foreach ($product_id as $subProduct_id => $qty) {

                $sub_product = ProductDetail::find($subProduct_id);
                if ($sub_product->quantity < $qty) return false;

                $sub_product->update([
                    'quantity' => $sub_product->quantity - $qty
                ]);

                $data[] = [
                    'order_id' => $order_id,
                    'product_detail_id' => $subProduct_id,
                    'quantity'   => $qty,
                    'price' => $sub_product->product->price * $qty
                ];

                $total += $sub_product->product->price * $qty;
            }
        }
        
        try {
            ItemOrder::insert($data);
        } catch (\Throwable $e) {
            return false;
        }
        return $total;
    }
}
