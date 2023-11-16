<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Product;
use App\Models\Category;
class ProductHome extends Component
{
    /**
     * Create a new component instance.
     */
    public $row_cate;

    public function __construct($rowcate)
    {
        $this->row_cate = $rowcate;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
{
    $cat = $this->row_cate;
    $listcatid = array();
    array_push($listcatid, $cat->id);
    $list_category1 = Category::where([['parent_id', '=', $cat->id], ['status', '=', '1']])->orderBy('sort_order', 'asc')->get();
    if (count($list_category1) != 0) {
        foreach ($list_category1 as $cat1) {
            array_push($listcatid, $cat1->id);
            $list_category2 = Category::where([['parent_id', '=', $cat1->id], ['status', '=', '1']])->orderBy('sort_order', 'asc')->get();
            if (count($list_category2) != 0) {
                foreach ($list_category2 as $cat2) {
                    array_push($listcatid, $cat2->id);
                }
            }
        }
    }
            
            $list_product = Product::where('status', '=', 1)->whereIn('category_id', $listcatid)
              ->orderBy('created_at', 'DESC')
              ->take(8)
              ->get();
return view('components.product-home',compact('cat','list_product'));
}
}