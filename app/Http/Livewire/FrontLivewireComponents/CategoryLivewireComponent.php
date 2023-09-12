<?php

namespace App\Http\Livewire\FrontLivewireComponents;

use Livewire\Component;
use App\Models\Category;
use App\Models\Filter;
use Illuminate\Support\Facades\Session;

class CategoryLivewireComponent extends Component
{
    public $categoryId;
    protected $listeners = [
        'clickedOnCategory' => 'saveCategoryToFilter',
    ];

    public function saveCategoryToFilter($categoryId)
    {
        $this->categoryId = $categoryId;

        if (!Session::has('sessionFilterUserId')) {
            $sessionFilterUserId = uniqid();
            Session::put('sessionFilterUserId', $sessionFilterUserId);
        } else {
            $sessionFilterUserId = Session::get('sessionFilterUserId');
        }

        Filter::updateOrCreate(
            ['current_filter' => $sessionFilterUserId],
            ['category_id' => $categoryId]
        );

        $this->emit('updateFilter');
    }

    public $categories;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->categories = Category::with('children')->whereNull('parent_id')->get();
    }
    public function render()
    {
        return view('livewire.front-livewire-components.category-livewire-component');
    }
}
