<?php

namespace App\Http\Livewire\FrontLivewireComponents;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\User;

class HeaderLivewireComponent extends Component
{
    public $productsInCart;
    public $allProductPriseTotal;
    public $allProductQuantity = 0;

    protected $listeners = [
        'updateFilter' => 'updateHeaderCartAction', //'updateFilter' was taken so as not to write a new event for updating the cart header when the add to cart button is clicked
        'updateCartHeader' => 'updateHeaderCartAction',
    ];

    public function __construct()
    {
        // Session::forget('cart');
        $this->updateHeaderCartAction();
    }

    public function updateHeaderCartAction()
    {
        if (Auth::id()) {
            $userId = User::find(Auth::id());
            $customerId = $userId->customer->id;
        }
        else {
            $customerId = null;
        }

        if ($customerId) {
            $customerCart = Cart::where('customer_id', $customerId)->first();
        } else {
            $customerCart = null;
        }

        $productsInCart = optional($customerCart)->relatedProducts;
        $allProductPriseTotal = 0;
       
        if ($customerCart) {
            $productsInCart = $customerCart->relatedProducts;
            $allProductQuantity = 0;
            foreach ($productsInCart as $product) {
                $cartItem = $customerCart->relatedProducts->where('id', $product->id)->first();
                $allProductQuantity += $cartItem->pivot->quantity;
                if ($product->discount_id) {
                    $allProductPriseTotal += $product->price * $cartItem->pivot->quantity;
                    $allProductPriseTotal -= (optional($product->discount)->price_off * $cartItem->pivot->quantity);
                } else {
                    $allProductPriseTotal += $product->price * $cartItem->pivot->quantity;
                }
            }
            $this->allProductQuantity = $allProductQuantity;
        } else {
            $sessionCart = Session::get('cart', []);
            if ($sessionCart) {
                $totalItems = 0;
                foreach ($sessionCart as $item) {
                    $allProductPriseTotal += $item['total'];
                    $totalItems += $item['quantity'];
                }
                $this->allProductQuantity = $totalItems;
            }
        }
        $this->allProductPriseTotal = $allProductPriseTotal;
        $this->productsInCart = $productsInCart;
    }

    public function render()
    {
        return view('livewire.front-livewire-components.header-livewire-component');
    }
}
