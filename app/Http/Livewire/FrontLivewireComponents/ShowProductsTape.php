<?php

namespace App\Http\Livewire\FrontLivewireComponents;

use Livewire\Component;
use App\Models\Filter;
use App\Models\Product;
use App\Models\Size;


class ShowProductsTape extends Component
{
    public $products;
    public $minVal;
    public $maxVal;

    protected $listeners = [
        'updateFilter'
    ];

    public function __construct()
    {
        $this->products = Product::all();
    }

    public function updateFilter()
    {
        $userId = 1; // Здесь указываете нужный id пользователя
        $filter = Filter::where('user_id', $userId)->first();
        $query = Product::query();

        if ($filter->size_filter != "NULL") {
            $query->whereHas('size', function ($query) use ($filter) {
                $query->where('size', $filter->size_filter);
            });       
        }

        // Фильтрация по цене, если поля min_price и max_price не являются NULL
        if (!is_null($filter->min_price)) {
            $query->where('price', '>=', $filter->min_price);
        }

        if (!is_null($filter->max_price)) {
            $query->where('price', '<=', $filter->max_price);
        }

        // Фильтрация по полю color_filter, если оно не NULL
        if (!is_null($filter->color_filter)) {
            $query->where('color_code', $filter->color_filter);
        }
        $this->products = $query->get();
    }

    public function render()
    {
        return view('livewire.front-livewire-components.show-products-tape');
    }
}
