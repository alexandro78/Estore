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
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class MainFrontendController extends Controller
{
    public function addToCart(Request $request)
    {
        $data = $request->json()->all();
        $product = Product::find($data['productId']);
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
        // Next, you can use the $valueMin and $valueMax values as you see fit
    }

    public function showProducts()
    {
        $sessionFilterUserId = Session::get('sessionFilterUserId');
        $filter = Filter::where('current_filter', $sessionFilterUserId)->first();

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
        $cartItem = false;
        $sessionCart = false;
        if (1 == 1) { //auth()->check()
            $customerId = 1;
            $cart = Cart::where('customer_id', $customerId)->first();
            $cartItem = $cart->relatedProducts->find($id);
        } else {
            $cart = Session::get('cart');
            if (isset($cart) && isset($cart[$id])) {
                $sessionCart = true;
            } else {
                $sessionCart = false;
            }
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
        $cartItem = false;
        if (1 == 1) { //auth()->check()
            $customerId = 1;
            $cart = Cart::where('customer_id', $customerId)->first();
            $cartItem = $cart->relatedProducts->find($id);
        }
        $product = Product::find($id);
        $sizes = $product->sizes;
        $sizeEntry = Size::find($productSizeId);

        if ($sizeEntry) {
            $sizeName = $sizeEntry->size;
            $sizeDetail = $product->sizeDetails->filter(function ($sizeDetail) use ($sizeName) {
                return $sizeDetail->size_name == $sizeName;
            })->first();
        }

        $cart = Session::get('cart');
        if (isset($cart) && isset($cart[$id])) {
            $sessionCart = true;
        } else {
            $sessionCart = false;
        }

        return view('layouts.frontend-user-side.single-product-page', [
            'product' => $product,
            'sizes' => $sizes,
            'productSizeId' => $productSizeId,
            'sizeDetail' => $sizeDetail,
            'cartItem' => $cartItem,
            'sessionCart' => $sessionCart
        ]);
    }

    //FIXME: Місце додавання товару в кошик або сесійний кошик зі сторінки окремого товару.
    public function addToCartFromSingleProductPage(Request $request, $id, $price)
    {
        $quantity = $request->input('quantity');
        $product = Product::findOrFail($id);
        $customerId = 1;

        if (1 != 1) { /* Auth::check() */
            $cart = Cart::where('customer_id', $customerId)->first();
            if (!$cart) {
                $cart = new Cart();
                $cart->customer_id = $customerId;
                $cart->save();
            }
            if (!$cart->relatedProducts->contains($id)) {
                $cart->relatedProducts()->attach($id, ['quantity' => $quantity, 'total' => isset($product->discount) ? ($product->price - $product->discount->price_off) * $quantity : $product->price * $quantity]);
                $cart->save();
            }
        } else {
            $cart = Session::get('cart', []);

            $cart[$id] = [
                'productName' => $product->name,
                'productDescription' => $product->description,
                'quantity' => $quantity,
                'price' => isset($product->discount) ? ($price - $product->discount->price_off) * $quantity : $price * $quantity,
                'total' => isset($product->discount) ? ($price - $product->discount->price_off) * $quantity : $price * $quantity
            ];

            Session::put('cart', $cart);
        }

        return redirect()->back();
    }

    //FIXME: місце виводу продуктів к корзину
    public function showCartPage()
    {
        $customerId = 1;
        $customerCart = Cart::where('customer_id', $customerId)->first();
        $productsInCart = optional($customerCart)->relatedProducts;
        $allProductPriseTotal = 0;
        if ($customerCart) {
            $productsInCart = $customerCart->relatedProducts;

            foreach ($productsInCart as $product) {
                $cartItem = $customerCart->relatedProducts->where('id', $product->id)->first();
                if ($product->discount_id) {
                    $allProductPriseTotal += $product->price * $cartItem->pivot->quantity;
                    $allProductPriseTotal -= (optional($product->discount)->price_off * $cartItem->pivot->quantity);
                } else {
                    $allProductPriseTotal += $product->price * $cartItem->pivot->quantity;
                }
            }
        }
        $sessionCart = Session::get('cart', []);
        if (1 == 1) {
            foreach ($sessionCart as $item) {
                $allProductPriseTotal += $item['total'];
            }
        }


        return view('layouts.frontend-user-side.cart', [
            'allProductPriseTotal' => $allProductPriseTotal,
            'productsInCart' => $productsInCart,
            'sessionCart' => $sessionCart
        ]);
    }

    public function updateCartPage(Request $request)
    {
        $customerId = 1;
        $quantities = $request->input('quantities');
        if ($quantities) {
            foreach ($quantities as $productId => $quantity) {
                $product = Product::find($productId);

                if ($product) {
                    $price =  optional($product->discount)->price_off ? $product->price - $product->discount->price_off : $product->price;
                } else {
                    $price = 0;
                }

                if (1 != 1) {/* Auth::check() */
                    $customerCart = Cart::where('customer_id', $customerId)->first();
                    $customerCart->relatedProducts()->updateExistingPivot($productId, [
                        'quantity' => $quantity,
                        'total' => $price * $quantity,
                    ]);
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
        }
        return redirect()->back();
    }

    public function clearCart()
    {
        $customerId = 1;
        if (1 == 1)/* Auth::check() */ {
            $customerCart = Cart::where('customer_id', $customerId)->first();
            if ($customerCart) {
                $customerCart->relatedProducts()->detach();
                $customerCart->delete();
            }
        }
        if (Session::has('cart')) {
            Session::forget('cart');
        }
        return redirect()->back();
    }

    public function proceedToCheckout(Request $request)
    {
        $customerId = 1;
        $request->validate([
            'radio-input' => 'required'
        ]);
        $selectedShippingMethod = $request->input('radio-input');
        Session::put('selectedShippingMethod', $selectedShippingMethod);

        $customerId = 1;
        $allProductPriseTotal = 0;
        $productsInCart = NULL;
        if (1 != 1)/* Auth::check() */ {
            $customerCart = Cart::where('customer_id', $customerId)->first();
            $productsInCart = $customerCart->relatedProducts;

            foreach ($productsInCart as $product) {
                if ($product->discount_id) {
                    $allProductPriseTotal += $product->price * $product->pivot->quantity;
                    $allProductPriseTotal -= (optional($product->discount)->price_off * $product->pivot->quantity);
                } else {
                    $allProductPriseTotal += $product->price * $product->pivot->quantity;
                }
            }
        } else {
            $sessionCart = Session::get('cart');
            if (1 == 1) {
                foreach ($sessionCart as $item) {
                    $allProductPriseTotal += $item['total'];
                }
            }
        }

        return view('layouts.frontend-user-side.checkout', [
            'productsInCart' => $productsInCart,
            'selectedShippingMethod' => $selectedShippingMethod,
            'allProductPriseTotal' => $allProductPriseTotal,
            'sessionCart' => $sessionCart
        ]);
    }

    public function saveNewOrder(Request $request)
    {
        $selectedShippingMethod = Session::get('selectedShippingMethod');
        $selectedPaymentMethod = $request->input('payment_method');

        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $company = $request->input('company');
        $country = $request->input('country');
        $deliveryPoint = $request->input('delivery_point');
        $streetAddress = $request->input('street_address');
        $postcode = $request->input('postcode');
        $city = $request->input('city');
        $phoneNumber = $request->input('phone_number');
        $emailAddress = $request->input('email_address');
        $customCheck1 = $request->input("terms_of_agreement");
        $customCheck2 = $request->input("create_account");

        $allProductPriseTotal = 0;
        if (1 != 1) {
            $customerId = 1;
            $customerCart = Cart::where('customer_id', $customerId)->first();
            $productsInCart = $customerCart->relatedProducts;
            if ($customerCart) {
                $productsInCart = $customerCart->relatedProducts;

                foreach ($productsInCart as $product) {
                    if ($product->discount_id) {
                        $allProductPriseTotal += $product->price * $product->pivot->quantity;
                        $allProductPriseTotal -= (optional($product->discount)->price_off * $product->pivot->quantity);
                    } else {
                        $allProductPriseTotal += $product->price * $product->pivot->quantity;
                    }
                }
            }
        }

        date_default_timezone_set('Europe/Kiev');
        $orderDate = date('d.m.Y');
        $ordertTime = date('H:i');
        $orderNumber = mt_rand(1000, 9999) . date('is');

        $order = new Order();
        $order->order_date = $orderDate;
        $order->order_number = $orderNumber;
        $order->delivery_service = $selectedShippingMethod;
        $order->street_delivery_point = $deliveryPoint;
        $order->payment_method = $selectedPaymentMethod;
        $order->payment_status = 'pending';
        $order->total = 8888;
        $order->shipping_address = $streetAddress;
        $order->shipping_status = 'pending';
        $order->first_name = $firstName;
        $order->last_name = $lastName;
        $order->phone_number = $phoneNumber;
        $order->company = $company;
        $order->country = $country;
        $order->street_address = $streetAddress;
        $order->postcode = $postcode;
        $order->city = $city;
        $order->email_address = $emailAddress;
        $order->status = 'pending';
        $order->notes = null;

        $order->customer_id = 1;
        $order->cart_id = $customerCart->id; //FIXME: зупинився на цьому місці (потрібно створити корзину для незареестрованних користувачів)
        $order->save();
        $customerCart->customer_id = null;
        $customerCart->save();


        return view('layouts.frontend-user-side.saved-order', [
            'selectedShippingMethod' => $selectedShippingMethod,
            'selectedPaymentMethod' => $selectedPaymentMethod,
            'city' => $city,
            'orderNumber' => $orderNumber,
            'orderDate' => $orderDate,
            'ordertTime' => $ordertTime,
            'allProductPriseTotal' => $allProductPriseTotal,
            'productsInCart' => $productsInCart
        ]);
    }


    public function createCategorySession($id)
    {
        session()->put('categorySession', $id);
        $sessionCategory = session('categorySession');
    }
}
