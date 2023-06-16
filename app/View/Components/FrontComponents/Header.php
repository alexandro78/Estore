<?php

namespace App\View\Components\FrontComponents;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;
use App\Models\NavMenu;

class Header extends Component
{

    public $navItems;
    public $categories;
    
    // /**
    //  * Create a new component instance.
    //  */
    public function __construct()
    {
        $this->navItems = NavMenu::with('getSubItem')->whereNull('parent_id')->get();
        $this->categories = Category::with('children')->whereNull('parent_id')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front-components.header');
    }
}
