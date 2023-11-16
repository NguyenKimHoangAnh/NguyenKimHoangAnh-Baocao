<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;

class MainMenu extends Component
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
            ['position', '=', 'mainmenu'],
            ['status', '=', 1],
            ['parent_id', '=', 0]            
        ];
        $listmenu= Menu::where($args)
        ->orderBy('sort_order','ASC')
        ->get();
        return view('components.main-menu',compact('listmenu'));
    }
}
