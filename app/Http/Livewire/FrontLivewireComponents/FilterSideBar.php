<?php

namespace App\Http\Livewire\FrontLivewireComponents;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Filter;
use App\Models\Product;
use App\Models\Color;

class FilterSideBar extends Component
{

    public $minValue = 0;
    public $maxValue = 10000;
    public $products;
    public $colorCode;

    public function __construct()
    {
        $this->products = Color::withCount(['products' => function ($query) {
            // Add additional conditions for product filtering, if necessary
        }])->get();
    }

    // update min max values in table Filters
    public function updateValues(Request $request)
    {

        if (!Session::has('sessionFilterUserId')) {
            $sessionFilterUserId = uniqid();
            Session::put('sessionFilterUserId', $sessionFilterUserId);
        } else {
            $sessionFilterUserId = Session::get('sessionFilterUserId');
        }
        $data = $request->json()->all();
        $this->minValue = $data['minValue'];
        $this->maxValue = $data['maxValue'];

        Filter::updateOrCreate(
            ['current_filter' => $sessionFilterUserId],
            ['min_price' => $this->minValue, 'max_price' => $this->maxValue]
        );
        return response()->json(['minVal' => $this->minValue, 'maxVal' => $this->maxValue]);
    }

    // update color field color_filter value in table Filters
    public function updateColor(Request $request)
    {
        $data = $request->json()->all();
        if (!Session::has('sessionFilterUserId')) {
            $sessionFilterUserId = uniqid();
            Session::put('sessionFilterUserId', $sessionFilterUserId);
        } else {
            $sessionFilterUserId = Session::get('sessionFilterUserId');
        }

        Filter::updateOrCreate(
            ['current_filter' => $sessionFilterUserId],
            ['color_filter' => $data['color']]
        );
        return response()->json(['sessionFilterUserId' => $sessionFilterUserId]);
    }

    // update size_filter value in table Filters
    public function updateSize(Request $request)
    {
        $data = $request->json()->all();
        if (!Session::has('sessionFilterUserId')) {
            $sessionFilterUserId = uniqid();
            Session::put('sessionFilterUserId', $sessionFilterUserId);
        } else {
            $sessionFilterUserId = Session::get('sessionFilterUserId');
        }

        Filter::updateOrCreate(
            ['current_filter' => $sessionFilterUserId],
            ['size_filter' => $data['size']]
        );
    }

    public function render()
    {
        return view('livewire.front-livewire-components.filter-side-bar');
    }
}
