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
    public $productsIdInCart = [];


    protected $listeners = [
        'updateFilter',
        'addToCart' => 'addToCart',
        'clickedOnModal' => 'getProductData'
    ];

    public function getProductData($productId)
    {
        $this->emit('sendDataToQuickViewModal', $productId);
    }

    public function mount()
    {
        $this->updateFilter();

        $customerId = 1;
        if (1 == 1) { /* Auth::check() */
            $cart = Cart::where('customer_id', $customerId)->first();
            if ($cart) {
                $this->productIdsInCart = $cart->relatedProducts->pluck('id')->toArray();
            }
        } else {
            $this->sessionCart = Session::get('cart');
        }
    }

    public function addToCart($productId)
    {
        $customerId = 1;
        $product = Product::findOrFail($productId);

        //FIXME: The place to add a product to the cart or session cart from the product listing page.
        if (1 == 1) { /* Auth::check() */
            $cart = Cart::where('customer_id', $customerId)->first();
            if (!$cart) {
                $cart = new Cart();
                $cart->customer_id = 1;
                $cart->save();
            }
            if (!$cart->relatedProducts->contains($productId)) {
                $cart->relatedProducts()->attach($productId, ['quantity' => 1, 'total' => isset($product->discount) ? ($product->price - $product->discount->price_off) : $product->price]);
                $cart->save();
                $this->productsIdInCart[$productId] = true;
            }
        } else {
            $cart = Session::get('cart', []);

            $cart[$productId] = [
                'productName' => $product->name,
                'productDescription' => $product->description,
                'product_size' => null,
                'product_color' => null,
                'quantity' => 1,
                'price' => isset($product->discount) ? $product->price - $product->discount->price_off : $product->price,
                'total' => isset($product->discount) ? ($product->price - $product->discount->price_off) : $product->price
            ];
            Session::put('cart', $cart);
        }
    }

    public function updateFilter()
    {
        $sessionFilterUserId = Session::get('sessionFilterUserId');

        $filter = Filter::where('current_filter', $sessionFilterUserId)->first();
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

            // Use the relationship for color filtering
            if (!is_null($filter->color_filter)) {
                $query->whereHas('colors', function ($query) use ($filter) {
                    $query->where('color_code', $filter->color_filter);
                });
            }

            // Modify filtering by category_id
            if (!is_null($filter->category_id)) {
                $query->whereHas('categoryBelongsToProducts', function ($query) use ($filter) {
                    $query->where('category_id', $filter->category_id);
                });
            }

            $this->products = $query->paginate(5);
        } else {
            $this->products = Product::paginate(5);
        }
    }

    public function render()
    {
        return view('livewire.front-livewire-components.show-products-tape', [
            'products' => $this->products,
        ]);
    }
}
