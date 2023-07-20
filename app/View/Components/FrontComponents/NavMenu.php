<?php

namespace App\View\Components\FrontComponents;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\NavMenu as NavMenuModel;

class NavMenu extends Component
{
   public $navItems; 
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->navItems = NavMenuModel::with('getSubItem')->whereNull('parent_id')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front-components.nav-menu');
    }
}
