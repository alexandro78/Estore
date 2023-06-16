<?php

namespace App\View\Components\FrontComponents;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Product;

class NewArrivals extends Component
{
    public $categories;
    public $bestsellers;
    public $cartItems;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->getNewArrivals();
    }

    public function getNewArrivals()
    {
        $this->categories = Category::where('show_in_new_arrivals', 1)->get();
        $this->cartItems = Cart::where('customer_id', 1)->get();
        $this->bestsellers = Category::where('show_in_new_arrivals', 1)
            ->with(['products' => function ($query) {
                $query->where('bestseller', true)->inRandomOrder()->take(15);
            }])
            ->get()
            ->pluck('products')
            ->flatten();
    }


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
        return response()->json(['success' => 'success']);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front-components.new-arrivals');
    }
}
