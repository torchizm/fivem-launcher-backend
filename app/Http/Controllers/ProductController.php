<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\ProductKey;

class ProductController extends Controller
{
    function create(Request $request) {
        ProductKey::get();

        $user = Auth()->user();

        if ($user->power < 1) {
            return redirect('/dashboard');
        } 

        return view('dashboard.developer.add');
    }

    function store(Request $request, Product $product) {
        dd($request->productToken);
        $a = ProductKey::where('token', $request->productToken)->firstOrFail();
        dd($a);
        foreach(Product::get() as $prod) {
            if ($prod->product_token == request('productToken')) {
                return back()->with('message', 'Ürün anahtarı zaten kullanılıyor.');
            }
        }

        $newProduct = Product::create([
            'name' => request('productName'),
            'user' => auth()->id(),
            'product_token' => request('productToken')
        ]);

        $newProduct->save();

        return view('dashboard.developer.index');
    }
}
