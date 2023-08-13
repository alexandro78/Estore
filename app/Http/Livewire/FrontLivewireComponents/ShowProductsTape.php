<?php

namespace App\Http\Livewire\FrontLivewireComponents;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use App\Models\Filter;
use App\Models\Product;
use App\Models\Cart;

class ShowProductsTape extends Component
{
    use WithPagination;

    public $minVal;
    public $maxVal;
    private $products;
    public $allCartItems;
    public $productIdsInCart;
    public $sessionCart;

    protected $listeners = [
        'updateFilter',
        'clickedOnModal' => 'getProductData'
    ];

    public function getProductData($productId)
    {
        $this->emit('sendDataToQuickViewModal', $productId);
    }

    public function mount()
    {
        $this->updateFilter();
        $this->allCartItems = Cart::where('customer_id', 1)->get();
        $this->productIdsInCart = $this->allCartItems->pluck('product_id')->toArray();
        $this->sessionCart = Session::get('cart');
    }

    public function addToCart($productId)
    {
        $product = Product::findOrFail($productId);
        $cartItem = Cart::where('customer_id', 1)
                ->where('product_id', $productId)
                ->first();
        if (1 != 1) { /* Auth::check() */

            if (!$cartItem) {
                $customerId = 1;
                $cart = new Cart();
                $cart->quantity = $product->quantity;
                $cart->total = isset($product->discount) ? ($product->price - $product->discount->price_off) * $product->quantity : $product->price * $product->quantity;
                $cart->customer_id = $customerId;
                $cart->product_id = $productId;
                $cart->save();
            }
            $this->allCartItems = Cart::where('customer_id', 1)->get();
            $this->productIdsInCart = $this->allCartItems->pluck('product_id')->toArray();
        } else {
            $cart = Session::get('cart', []);

            $cart[$productId] = [
                'productName' => $product->name,
                'productDescription' => $product->description,
                'quantity' => $product->quantity,
                'price' => isset($product->discount) ? $product->price - $product->discount->price_off : $product->price,
                'total' => isset($product->discount) ? ($product->price - $product->discount->price_off) * $product->quantity : $product->price * $product->quantity
            ];
            Session::put('cart', $cart);
            $this->sessionCart = Session::get('cart');
        }
    }

    public function updateFilter()
    {
        $userId = 1;
        $filter = Filter::where('user_id', $userId)->first();
        $query = Product::query();

        if (!is_null($filter)) {
            if ($filter->size_filter != "NULL") {
                $query->whereHas('size', function ($query) use ($filter) {
                    $query->where('size', $filter->size_filter);
                });
            }

            if (!is_null($filter->min_price)) {
                $query->where('price', '>=', $filter->min_price);
            }

            if (!is_null($filter->max_price)) {
                $query->where('price', '<=', $filter->max_price);
            }

            if (!is_null($filter->color_filter)) {
                $query->where('color_code', $filter->color_filter);
            }
            $this->products = $query->paginate(5);
        } else {
            $this->products = Product::paginate(5);
        }
    }

    public function render()
    {
        return view('livewire.front-livewire-components.show-products-tape', [
            'products' => $this->products
        ]);
    }
}
