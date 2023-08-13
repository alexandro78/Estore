<?php

namespace App\Http\Livewire\FrontLivewireComponents;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class QuickViewModalComponent extends Component
{
    public $product;
    public $productId;
    public $checkIfItemAdded;
    public $sessionCartItem;

    protected $listeners = ['sendDataToQuickViewModal' => 'getDataFromShowProducts'];

    public function getDataFromShowProducts($productId)
    {
        $cart = Session::get('cart');
        if (isset($cart) && isset($cart[$productId])) {
            $this->sessionCartItem = true;
        } else {
            $this->sessionCartItem = false;
        }

        $this->productId = $productId;
        $this->product = Product::find($productId);

        $this->checkIfItemAdded = Cart::where('customer_id', 1)
            ->where('product_id', $productId)
            ->first();
    }

    public function addToCardFromModal(Request $request)
    {
        $data = $request->json()->all();
        $quantity = $data['quantity'];
        $productId = $data['productId'];
        $product = Product::findOrFail($productId);


        if (1 != 1) {

            $cartItem = Cart::where('customer_id', 1)
                ->where('product_id', $productId)
                ->first();

            if (!$cartItem) {
                $customerId = 1;
                $cart = new Cart();
                $cart->quantity = $quantity;
                $cart->total = isset($product->discount) ? ($product->price - $product->discount->price_off) * $quantity : $product->price * $quantity;
                $cart->customer_id = $customerId;
                $cart->product_id = $productId;
                $cart->save();
            }
        } else {
            $cart = Session::get('cart', []);

            $cart[$productId] = [
                'productName' => $product->name,
                'productDescription' => $product->description,
                'quantity' => $quantity,
                'price' => isset($product->discount) ? $product->price - $product->discount->price_off : $product->price,
                'total' => isset($product->discount) ? ($product->price - $product->discount->price_off) * $quantity : $product->price * $quantity
            ];

            Session::put('cart', $cart);
        }

        return response()->json(['success' => $productId]);
    }

    public function render()
    {
        return view('livewire.front-livewire-components.quick-view-modal-component');
    }
}
