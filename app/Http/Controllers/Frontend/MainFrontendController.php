<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\NavMenu;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Filter;
use App\Models\SizeDetail;
use App\Models\Size;
use Illuminate\Support\Facades\Auth;

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

    public function showSinglePage($id)
    {
        $cartItem = Cart::where('customer_id', 1)
            ->where('product_id', $id)
            ->first();

        $cart = Session::get('cart');
        if (isset($cart) && isset($cart[$id])) {
            $sessionCart = true;
        } else {
            $sessionCart = false;
        }

        $product = Product::find($id);
        $sizes = $product->sizes;
        return view('layouts.frontend-user-side.single-product-page', [
            'product' => $product,
            'sizes' => $sizes,
            'cartItem' => $cartItem,
            'sessionCart' => $sessionCart
        ]);
    }

    public function getProductBySize($id, $productSizeId)
    {
        $product = Product::find($id);
        $sizes = $product->sizes;
        $sizeEntry = Size::find($productSizeId);

        if ($sizeEntry) {
            $sizeName = $sizeEntry->size;
            $sizeDetail = $product->sizeDetails->filter(function ($sizeDetail) use ($sizeName) {
                return $sizeDetail->size_name == $sizeName;
            })->first();
        }

        return view('layouts.frontend-user-side.single-product-page', [
            'product' => $product,
            'sizes' => $sizes,
            'productSizeId' => $productSizeId,
            'sizeDetail' => $sizeDetail
        ]);
    }

    public function addToCartFromSingleProductPage(Request $request, $id, $price)
    {
        $quantity = $request->input('quantity');
        $product = Product::findOrFail($id);

        if (1 != 1) { /* Auth::check() */

            $cartItem = Cart::where('customer_id', 1)
                ->where('product_id', $id)
                ->first();

            if (!$cartItem) {
                $customerId = 1;
                $cart = new Cart();
                $cart->quantity = $quantity;
                $cart->total = isset($product->discount) ? ($price - $product->discount->price_off) * $quantity : $price * $quantity;
                $cart->customer_id = $customerId;
                $cart->product_id = $id;
                $cart->save();
            }
        } else {
            $cart = Session::get('cart', []);

            $cart[$id] = [
                'productName' => $product->name,
                'productDescription' => $product->description,
                'quantity' => $quantity,
                'price' => isset($product->discount) ? $price - $product->discount->price_off : $price,
                'total' => isset($product->discount) ? ($price - $product->discount->price_off) * $quantity : $price * $quantity
            ];

            Session::put('cart', $cart);
        }

        return redirect()->back();
    }

    public function showCartPage()
    {
        $userId = 1;
        $cartProducts = Cart::where('customer_id', $userId)->get();
        $sessionCart = Session::get('cart');
        return view('layouts.frontend-user-side.cart', [
            'cartProducts' => $cartProducts,
            'sessionCart' => $sessionCart
        ]);
    }

    public function updateCartPage(Request $request)
    {
        $customerId = 1;
        $quantities = $request->input('quantities');

        foreach ($quantities as $productId => $quantity) {
            $product = Product::find($productId);
            $price = optional($product->discount)->price_off ? $product->price - $product->discount->price_off : $product->price;
            if (1 != 1) {/* Auth::check() */
                $cartItem = Cart::where('customer_id', $customerId)
                    ->where('product_id', $productId)
                    ->first();

                if ($cartItem) {
                    
                    $cartItem->update([
                        'quantity' => $quantity,
                        'total' => $price * $quantity
                    ]);
                }
            } else {
                $cart = Session::get('cart');

                if (isset($cart[$product->id])) {
                    // sessionCart update
                    $cart[$product->id]['quantity'] = $quantity;
                    $cart[$product->id]['price'] = $price;
                    $cart[$product->id]['total'] = $price * $quantity;

                    Session::put('cart', $cart);
                }
            }
        }
        return redirect()->back();
    }
}
