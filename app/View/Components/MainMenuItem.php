<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Menu;

class MainMenuItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $rowmenu=null;
    public function  __construct($itemmenu)
    {
        $this->rowmenu = $itemmenu;
    }


    public function render()
    {
        $menu1 = $this->rowmenu;
        $args = [
            ['status', '=', 1],
            ['parent_id', '=', $menu1->id],
            ['position', '=','mainmenu']
        ];
        $listmenu2= Menu::where($args)
        ->orderBy('sort_order','ASC')
        ->get();
        $submenu=false;
        if(count($listmenu2)>0)
        {
            $submenu=true;
        }
        return view('components.main-menu-item',compact('menu1','listmenu2','submenu'));
    }
}
