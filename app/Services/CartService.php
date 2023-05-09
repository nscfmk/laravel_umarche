<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Cart;

class CartService
{
    public static function getItemsInCart($items)
    {
        $products = [];
        // dd($items);
                foreach ($items as $item) {
            $p = Product::findOrFail($item->product_id);
            $owner = $p->shop->owner->select('name', 'email')->first()->toArray(); //オーナー情報 

            $values = array_values($owner); //連想配列の値を取得
            $keys = ['ownerName', 'email'];  //連想配列のキー値を設定
            $ownerInfo = array_combine($keys, $values); //値とキー値を設定して新しい配列を作成する

            $product = Product::where('id', $item->product_id)->select('id', 'name', 'price')->get()->toArray(); // 商品情報の配列
            $quantity = Cart::where('product_id', $item->product_id)
                ->select('quantity')->get()->toArray(); // 在庫数の配列

            $result = array_merge($product[0], $ownerInfo, $quantity[0]); // 配列の結合
            array_push($products, $result);

        }
        return $products;
    }
}
