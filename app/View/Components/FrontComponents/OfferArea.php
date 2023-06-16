<?php

namespace App\View\Components\FrontComponents;

use App\Models\Image;
use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OfferArea extends Component
{
    public $offerImage;
    public $product;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->getOffer();
    }

    private function getOffer()
    {
        $image = Image::where('offer_area', true)->first();
        if ($image) {
            $this->offerImage = $image;
        } else {
            $this->offerImage = '';
        }

        $this->product = Product::where('offer_area', true)->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front-components.offer-area');
    }
}
