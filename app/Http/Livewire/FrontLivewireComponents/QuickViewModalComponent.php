<?php

namespace App\Http\Livewire\FrontLivewireComponents;

use Livewire\Component;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;

class QuickViewModalComponent extends Component
{
    public $product;
    public $productId;
    public $checkIfItemAdded;
    
    protected $listeners = ['sendDataToQuickViewModal' => 'getDataFromShowProducts'];

    public function getDataFromShowProducts($productId)
    {
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

        $cartItem = Cart::where('customer_id', 1)
            ->where('product_id', $productId)
            ->first();

        if (!$cartItem) {
            $product = Product::findOrFail($productId);
            $customerId = 1;
            $cart = new Cart();
            $cart->quantity = $quantity;
            $cart->total = isset($product->discount) ? ($product->price - $product->discount->price_off) * $quantity : $product->price * $quantity;
            $cart->customer_id = $customerId;
            $cart->product_id = $productId;
            $cart->save();
        }

        return response()->json(['success' => $productId]);
    }

    public function render()
    {
        return view('livewire.front-livewire-components.quick-view-modal-component');
    }
}
