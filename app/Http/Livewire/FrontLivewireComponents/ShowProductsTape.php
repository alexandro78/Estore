<?php

namespace App\Http\Livewire\FrontLivewireComponents;

use Livewire\Component;
use Livewire\WithPagination;
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
    // public $addedToCart = [];

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
    }

    public function addToCart($productId)
    {
        $cartItem = Cart::where('customer_id', 1)
            ->where('product_id', $productId)
            ->first();

        if (!$cartItem) {
            $product = Product::findOrFail($productId);
            $customerId = 1;
            $cart = new Cart();
            $cart->quantity = 1;
            $cart->total = $product->price;
            $cart->customer_id = $customerId;
            $cart->product_id = $productId;
            $cart->save();
        }
        $this->allCartItems = Cart::where('customer_id', 1)->get();
        $this->productIdsInCart = $this->allCartItems->pluck('product_id')->toArray();
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
