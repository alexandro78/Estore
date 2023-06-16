<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\NavMenu;
use App\Models\Cart;
use App\Models\Product;

class MainFrontendController extends Controller
{
    // public function showHeaderCategoryNav()
    // {
    //     return view('layouts.frontend-user-side.home-content');
    // }

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


    // public function  showNewArrivalsSection()
    // {
    //     $categories = Category::where('show_in_new_arrivals', 1)->get();
    //     $cartItems = Cart::where('customer_id', 1)->get();

    //     return view('layouts.frontend-user-side.test-sub', [
    //         'categories' => $categories,
    //         'cartItems' => $cartItems
    //     ]);
    // }


}
