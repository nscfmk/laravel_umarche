<?php

namespace App\Http\Controllers\User;

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PrimaryCategory;



class ItemController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:users');

        $this->middleware(function ($request, $next) {

            $id = $request->route()->parameter('item');
            if (!is_null($id)) {
                $itemId = Product::availableItems()->where('products.id', $id)->exists();   //在庫が存在する商品で絞り込み→選択された商品で絞り込み→存在するor存在しないの判定
                if (!$itemId) {
                    abort(404);
                }
            }
            return $next($request);
        });

    }
   
    public function index(Request  $request)
    {

        // dd($request);

        $categories = PrimaryCategory::with('secondary')->get();
        $products = Product::availableItems()
        ->selectCategory($request->category ?? '0')
        ->sortOrder($request->sort)
        ->paginate($request->pagination ?? '20');



        return view('user.index', compact('products', 'categories'));
    }

    public function show($id){
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');

        if($quantity > 9){
            $quantity = 9;
        }
        return view('user.show' , compact('product', 'quantity'));
    }

}
