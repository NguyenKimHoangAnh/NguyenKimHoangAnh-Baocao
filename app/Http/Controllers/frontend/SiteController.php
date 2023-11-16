<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\Product;
use App\Models\Post;
use App\Models\Page;
use App\Models\Topic;
use App\Models\ProductSale;


class SiteController extends Controller
{
    public function index($slug = NULL)
    {
        if ($slug == NULL) {
            return $this->home();
        } else {
            $link = Link::where('slug', '=', $slug)->first();
            if ($link != NULL) {
                $type = $link->type;
                switch ($type) {
                    case 'category': {
                        return $this->product_category($slug);
                    }
                    case 'brand': {
                        return $this->product_brand($slug);
                    }
                    case 'topic': {
                        return $this->post_topic($slug);
                    }
                    case 'page': {
                        return $this->post_page($slug);
                    }
                }
            } else {
                $product = Product::where([['slug', '=', $slug], ['status', '=', 1]])->first();
                if ($product != NULL) {
                    return $this->product_detail($product);
                } else {
                    $args = [
                        ['slug', '=', $slug],
                        ['status', '=', 1],
                        ['type', '=', 'post']
                    ];
                    $post = Post::where($args)->first();
                    if ($post != NULL) {
                        return $this->post_detail($post);
                    } else {
                        return $this->error_404($slug);
                    }
                }
            }
        }
    }

   private function home()
{
    $title = 'Home';
    $args = [
        ['status', '=', 1],
        ['parent_id', '=', 0]
    ];
    $list_product = Product::orderBy('created_at', 'desc')->take(6)->get();
    $list_category = Category::where($args)->orderBy('sort_order')->get();
    

    return view('frontend.home', compact('list_product', 'list_category', 'title'));
}


    public function product()
    {
        $list_product = Product::where('status', '=', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(12);
            
        return view('frontend.product.product', compact('list_product'));
    }

    private function product_category($slug)
    {
        // Kiểm tra sự tồn tại của danh mục
        $categoryExists = Category::where('status', 1)->where('slug', $slug)->exists();

        if ($categoryExists) {
            // Lấy thông tin của danh mục
            $category = Category::where('status', 1)->where('slug', $slug)->orderBy('sort_order')->first();

            // Tạo mảng chứa ID của danh mục và các danh mục con
            $listcatid = [$category->id];

            // Lấy danh sách danh mục cấp 1
            $list_category1 = Category::where('parent_id', $category->id)->where('status', 1)->get();
            foreach ($list_category1 as $category1) {
                array_push($listcatid, $category1->id);

                // Lấy danh sách danh mục cấp 2
                $list_category2 = Category::where('parent_id', $category1->id)->where('status', 1)->get();
                foreach ($list_category2 as $category2) {
                    array_push($listcatid, $category2->id);
                }
            }

            // Lấy danh sách sản phẩm thuộc các danh mục đã chọn
            $list_product = Product::where('status', 1)
                ->whereIn('category_id', $listcatid)
                ->orderBy('created_at', 'DESC')
                ->paginate(9);

            return view('frontend.category.index', compact('list_product', 'category'));
        } else {
            return $this->error_404($slug);
        }
    }

 private function product_brand($slug)
    {
        $args = [
            ['slug', '=', $slug],
            ['status', '=', 1]
        ];
        $brand = Brand::where($args)->first();
        if ($brand != NULL) {
            $list_product = Product::where([['status', '=', 1], ['brand_id', '=', $brand->id]])
                ->orderBy('created_at', 'DESC')
                ->paginate(9);
                

            return view('frontend.product.product-brand', compact('brand', 'list_product'));
        } else {
            return $this->error_404($slug);
        }
    }

public function productdetail($product)
{
    $product = Product::find($product);
    if ($product instanceof Product) {
        // Lấy các thuộc tính của sản phẩm
        $name = $product->name;
        $description = $product->description;
        $listcatid = [$product->category_id];

        $args1 = [
            ['parent_id', '=', $product->category_id],
            ['status', '=', 1]
        ];
        $list_category1 = Category::where($args1)->pluck('id')->toArray();

        if (!empty($list_category1)) {
            $listcatid = array_merge($listcatid, $list_category1);

            $args2 = [
                ['parent_id', 'in', $list_category1],
                ['status', '=', 1]
            ];
            $list_category2 = Category::where($args2)->pluck('id')->toArray();

            if (!empty($list_category2)) {
                $listcatid = array_merge($listcatid, $list_category2);
            }
        }

        $related_products = Product::where('status', '=', 1)
            ->whereIn('category_id', $listcatid)
            ->where('id', '!=', $product->id)
            ->orderBy('created_at', 'DESC')
            ->take(4)
            ->get();
        
        // Kiểm tra biến $product

        return view('frontend.product.product-detail', compact('product', 'related_products'));
    }
}    
private function post_detail($post)
    {
        $args = [
            ['status','=',1],
            ['type', '=', 'post'],
            ['id','!=', $post->id ]
        ];
        $list_post = Post::where($args)
        ->orderBy('created_at','DESC')
        ->take(2)
        ->get();
        return view('frontend.post-detail', compact('post', 'list_post'));
    }
    #error 404
    private function error_404($slug)
    {
        return view('frontend.404');
    }
    //product-category
       public function showPC()
    {
        // Get all products and categories
        $products = Product::all();
        $categories = Category::all();

        // Pass data to the view
        return view('frontend.category.index', compact('products', 'categories'));
    }

    public function showProductsCategory($categoryId)
    {
        // Get products by category
        $category = Category::find($categoryId);

        if (!$category) {
            abort(404); // Category not found
        }

        $products = $category->products;

        // Pass data to the view
        return view('frontend.product.productscategory', compact('products', 'category'));
    }
      

    

}