<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Topic;
use App\Models\Page;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $list_category = Category::where('status', '!=', '0')->orderBy('created_at', 'desc')->get();
        $list_brand = Brand::where('status', '!=', '0')->orderBy('created_at', 'desc')->get();
        $list_topic = Topic::where('status', '!=', '0')->orderBy('created_at', 'desc')->get();
        $list_page = Page::where([['status', '!=', '0'],['type', '=', 'page']])->orderBy('created_at', 'desc')->get();
        $list_menu = Menu::where('status', '!=', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.menu.index', compact('list_category','list_brand','list_topic','list_page','list_menu'));
    }

    public function create()
    {
        $list_menu = Menu::where('status', '!=', '0')->orderBy('created_at', 'desc')->get();
        
        return view('backend.menu.create', compact('list_menu'));
    }



    public function store(Request $request)
    {
       if (isset($request->AddCategory)){
        $list_id = $request->checkIdCategory;
        foreach ($list_id as $id) {
            $category = Category::find($id);
            $menu = new Menu();
            $menu->name = $category->name;
            $menu->link = $category->slug;
            $menu->table_id = $id;
            $menu->parent_id = 0;
            $menu->sort_order = 1;
            $menu->type = 'category';
            $menu->position = $request->position;
            $menu->status = 2;
            $menu->created_at= date('Y-m-d H:i:s');
            $menu->created_by = 1;
            $menu->save();
        }
        return redirect()->route('menu.index')->with('message', ['type' => 'success','msg' => 'Thêm menu thành công!']);

       }
       if (isset($request->AddBrand)){
        $list_id = $request->checkIdBrand;
        foreach ($list_id as $id) {
            $brand = Brand::find($id);
            $menu = new Menu();
            $menu->name = $brand->name;
            $menu->link = $brand->slug;
            $menu->table_id = $id;
            $menu->parent_id = 0;
            $menu->sort_order = 1;
            $menu->type = 'brand';
            $menu->position = $request->position;
            $menu->status = 2;
            $menu->created_at= date('Y-m-d H:i:s');
            $menu->created_by = 1;
            $menu->save();
        }
        return redirect()->route('menu.index')->with('message', ['type' => 'success','msg' => 'Thêm menu thành công!']);
       }
       if (isset($request->AddTopic)){
        $list_id = $request->checkIdTopic;
        foreach ($list_id as $id) {
            $topic = Topic::find($id);
            $menu = new Menu();
            $menu->name = $topic->name;
            $menu->link = $topic->slug;
            $menu->table_id = $id;
            $menu->parent_id = 0;
            $menu->sort_order = 1;
            $menu->type = 'topic';
            $menu->position = $request->position;
            $menu->status = 2;
            $menu->created_at= date('Y-m-d H:i:s');
            $menu->created_by = 1;
            $menu->save();
        }
        return redirect()->route('menu.index')->with('message', ['type' => 'success','msg' => 'Thêm menu thành công!']);
       }
       if (isset($request->AddPage)){
        $list_id = $request->checkIdPage;
        foreach ($list_id as $id) {
            $page = Page::find($id);
            $menu = new Menu();
            $menu->name = $page->title;
            $menu->link = $page->slug;
            $menu->table_id = $id;
            $menu->parent_id = 0;
            $menu->sort_order = 1;
            $menu->type = 'page';
            $menu->position = $request->position;
            $menu->status = 2;
            $menu->created_at= date('Y-m-d H:i:s');
            $menu->created_by = 1;
            $menu->save();
        }
        return redirect()->route('menu.index')->with('message', ['type' => 'success','msg' => 'Thêm menu thành công!']);
       }
       if (isset($request->AddCustom)){        
            $menu = new Menu();
            $menu->name = $request->name;
            $menu->link = $request->link;
            $menu->parent_id = 0;
            $menu->sort_order = 1;
            $menu->type = 'custom';
            $menu->position = $request->position;
            $menu->status = 2;
            $menu->created_at= date('Y-m-d H:i:s');
            $menu->created_by = 1;
            $menu->save();
        }
        return redirect()->route('menu.index')->with('message', ['type' => 'success','msg' => 'Thêm menu thành công!']);
       }






       public function status($id)
    {
        $menu = Menu::find($id);
        if($menu==NULL)
        {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $menu->status = ($menu->status == 1) ? 2 : 1;
         $menu->updated_at =date('Y-m-d H:i:s');
         $menu->updated_by = 1;
         $menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success','msg' => 'Thay đổi trạng thái thành công!']);
        }
        
    }




    public function destroy($id)
    {
        $menu = Menu::find($id);
        if($menu==NULL)
        {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $menu->delete();
        return redirect()->route('menu.trash')->with('message', ['type' => 'success','msg' => 'Xóa mẫu tin thành công!']);
    }


    public function trash()
    {
        $list_menu = Menu::where('status', '=', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.menu.trash', compact('list_menu'));
    }


    
    public function delete($id)
    {
        $menu = Menu::find($id);
        if($menu==NULL)
        {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $menu->status = 0;
         $menu->updated_at =date('Y-m-d H:i:s');
         $menu->updated_by = 1;
         $menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success','msg' => 'Xóa vào thùng rác thành công!']);
        }
        
    }


    public function restore($id)
    {
        $menu = Menu::find($id);
        if($menu==NULL)
        {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $menu->status = 2;
            $menu->updated_at=date('Y-m-d H:i:s');
            $menu->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
            $menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success','msg' => 'Khôi phục thành công!']);
        }
        
    }



    public function edit($id)
    {
        $menu = Menu::find($id);
        if($menu==NULL)
        {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $list_menu = Menu::where('status', '!=', '0')->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list_menu as $item) {
            if($item->id == $menu->parent_id){
                $html_parent_id .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            }else
            {
                $html_parent_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }
            if($item->sort_order == $menu->sort_order - 1){
                $html_sort_order .= "<option selected value='" . ($item->sort_order + 1) . "'>Sau: " . $item->name . "</option>";
            }else
            {
                $html_sort_order .= "<option value='" . ($item->sort_order + 1) . "'>Sau: " . $item->name . "</option>";
            }
        }
        $title = 'Cập nhật mẫu tin';
        return view('backend.menu.edit',compact('menu','title','html_parent_id','html_sort_order'));
    }

   
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->link = $request->link;
        $menu->parent_id = $request->parent_id;
        $menu->sort_order = $request->sort_order;
        $menu->updated_at =date('Y-m-d H:i:s');
        $menu->updated_by = 1;
        $menu->status = $request->status;
        $menu->save();
        return redirect()->route('menu.index')->with('message', ['type' => 'success','msg' => 'Cập nhật mẫu tin thành công!']);
    }

    public function show($id)
    {
        $menu = Menu::find($id);
        if($menu==NULL)
        {
            return redirect()->route('menu.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.menu.show',compact('menu','title'));
    }

    }

   