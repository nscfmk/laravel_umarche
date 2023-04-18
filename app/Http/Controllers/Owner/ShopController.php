<?php

namespace App\Http\Controllers\Owner;

use App\Models\Shop;
use App\Models\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function($request,$next){
            $id = $request->route()->parameter('shop');
            if(!is_null($id)){
                $shopsOwnerId = Shop::findOrFail($id)->owner->id;
                $shopId = (int)$shopsOwnerId;
                $ownerId = Auth::id();
                if($shopId !== $ownerId){
                    abort(404);
                };
               };
            }) ;
    }
    public function index()
    {
        $ownerId = Auth::id();
        $shops = Shop::where('owner_id' , $ownerId)->get();
        return view('owner.shops.index', compact('shops'));
    }

    public function edit($id)
    {
        $owner = Owner::findOrFail($id);
        return view('admin.owners.edit', compact('owner'));
    }

    public function update(Request $request, $id)
    {
        $owner = Owner::findOrFail($id);
        $owner->name = $request->name;
        $owner->email = $request->email;
        $owner->password = Hash::make($request->password);

        $owner->save();

        return redirect()->route('admin.owners.index')
            ->with([
                'message' => 'オーナー情報を更新しました！！！',
                'status' => 'info',
            ]);
    }

    
}
