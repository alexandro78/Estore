<?php

namespace App\Http\Livewire\FrontLivewireComponents;

use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Filter;
use App\Models\Product;

class FilterSideBar extends Component
{

    public $minValue = 0;
    public $maxValue = 10000;
    public $products;
    public $colorCode;

    public function __construct()         
    {
        $this->products = Product::select('color_code')
        ->selectRaw('COUNT(*) as count')
        ->groupBy('color_code')
        ->get();
    }

    public function updateValues(Request $request)
    {
        $data = $request->json()->all();
        $this->minValue = $data['minValue'];
        $this->maxValue = $data['maxValue'];

        $filter = Filter::updateOrCreate(
            ['user_id' => 1],
            ['min_price' => $this->minValue, 'max_price' => $this->maxValue]
        );
        return response()->json(['minVal' => $this->minValue, 'maxVal' => $this->maxValue, 'filter' => $filter]);
    }

    public function updateColor(Request $request){
        $data = $request->json()->all();
        
        Filter::updateOrCreate(
            ['user_id' => 1],
            ['color_filter' => $data['color']]
        );
    }

    public function updateSize(Request $request){
        $data = $request->json()->all();
        
        Filter::updateOrCreate(
            ['user_id' => 1],
            ['size_filter' => $data['size']]
        );
    }

    public function render()
    {
        return view('livewire.front-livewire-components.filter-side-bar');
    }
}
