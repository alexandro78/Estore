<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\NavMenu;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Filter;

class MainFrontendController extends Controller
{
    public function addToCart(Request $request)
    {
        $data = $request->json()->all();
        $product = Product::find($data['productId']);

        //это код стал не нужен потому что js проверяет если текст ADDED то слушатель не срабатывает на клик и 
        //ajax не отправляет товар в корзину.
        // $existingCartItem = Cart::where('product_id', $data['productId'])
        //     ->where('customer_id', 1)
        //     ->first();
        // If the product has not been added to the cart yet, add
        // if (!$existingCartItem) {

        $cart = new Cart();
        $cart->product_id = $data['productId'];
        $cart->customer_id = 1;
        $cart->total = $product->price;
        $cart->quantity = 1;
        $cart->save();
        return response()->json(['success' => 555555555555]);
    }

    public function  subscribe(Request $request)
    {
        $subscribe = $request->mail;

        return view('layouts.frontend-user-side.home-content');
    }

    public function priceSlider(Request $request)
    {
        $data = $request->json()->all();

        $valueMin = $data['value_min'];
        // $valueMax = $data['value_max'];
        return response()->json(['success' => 8888888888]);
        // Далее вы можете использовать значения $valueMin и $valueMax по вашему усмотрению
    }

    // public function testFun(Request $request)
    // {

    //     $data = $request->json()->all();

    //     $valueMin = $data['minValue'];
    //     // $valueMax = $data['value_max'];
    //     return response()->json(['success' => $data]);
    // }

    public function showProducts()
    {
        $userId = 1;
        $filter = Filter::where('user_id', $userId)->first();

        if ($filter) {
            $filter->delete();
        }

        return view('layouts.frontend-user-side.shop-content');
    }

    public function showHome()
    {
        return view('layouts.frontend-user-side.home-content');
    }
}
