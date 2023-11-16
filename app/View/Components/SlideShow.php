<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Slider;

class SlideShow extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        $args = [
            ['status', '=', 1],
            ['position', '=', 'slideshow']
        ];
        $list_slider = Slider::where($args)
        ->orderBy('sort_order','ASC')
        ->get();
        return view('components.slide-show',compact('list_slider'));
    }
}
