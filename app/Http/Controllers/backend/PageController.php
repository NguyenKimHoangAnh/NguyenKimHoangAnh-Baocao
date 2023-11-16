<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Link;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\PageStoreRequest;
use App\Http\Requests\PageUpdateRequest;

class PageController extends Controller
{
    #danh sach
    public function index()
    {
        $list = Page::where([['status', '<>', '0'],['type', '=', 'page']])->get();
        return view('backend.page.index', compact('list'));
    }

    #THEM
    public function create()
    {
        $list = Page::where([['status', '<>', '0'],['type', '=', 'page']])->get();
        
        return view('backend.page.create', compact('list'));
    }



    public function store(PageStoreRequest $request)
    {
        $row = new Page();
        $row->title = $request->title;
        $row->slug = Str::slug($request->title, '-');
        $row->detail = $request->detail;
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;        
        $row->status = $request->status;
        $row->type = 'page';
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
        $row->status = $request->status;
        //up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $row->slug.'.'.$extention;
                $file->move(public_path('images/page'), $fileName);
                $row->image = $fileName;
            }
        }
        
        //$row->image=$request->image;
        if ($row->save()){
            $link = new Link();
            $link->slug= $row->slug;
            $link->table_id = $row->id;
            $link->type = 'page';
            $link->save();
        }
        return redirect()->route('page.index')->with('message', ['type' => 'success','msg' => 'Thêm mẫu tin thành công!']);
    }

  
    public function show($id)
    {
        $row = Page::find($id);
        if($row==NULL)
        {
            return redirect()->route('page.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.page.show',compact('row','title'));
    }

   
    public function edit($id)
    {
        $row = Page::find($id);
        if($row==NULL)
        {
            return redirect()->route('page.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $list = Page::where([['status', '<>', '0'],['type', '=', 'page']])->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list as $item) {
            if($item->id == $row->parent_id){
                $html_parent_id .= "<option selected value='" . $item->id . "'>" . $item->name . "</option>";
            }else
            {
                $html_parent_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            }
            if($item->sort_order == $row->sort_order - 1){
                $html_sort_order .= "<option selected value='" . ($item->sort_order + 1) . "'>Sau: " . $item->name . "</option>";
            }else
            {
                $html_sort_order .= "<option value='" . ($item->sort_order + 1) . "'>Sau: " . $item->name . "</option>";
            }
        }
        $title = 'Cập nhật mẫu tin';
        return view('backend.page.edit',compact('row','title','html_parent_id','html_sort_order'));
    }

   
    public function update(PageUpdateRequest $request, $id)
    {
        $row = Page::find($id);
        $row->title = $request->title;
        $row->slug = Str::of($request->title)->slug('-');
        //$Page->level = $request->level;        
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->updated_at =date('Y-m-d H:i:s');
        $row->updated_by = 1;
        $row->status = $request->status;
        //up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $row->slug.'.'.$extention;
                $file->move(public_path('images/page'), $fileName);
                $row->image = $fileName;
            }
        }
        
        //$page->image=$request->image;
        if ($row->save()){
            $link = Link::where([['table_id', '=', $id], ['type', '=', 'page']])->first();
            $link->slug= $row->slug;            
            $link->save();
        }
        return redirect()->route('page.index')->with('message', ['type' => 'success','msg' => 'Cập nhật mẫu tin thành công!']);
    }

    
    public function destroy($id)
    {
        $row = Page::find($id);
        if($row==NULL)
        {
            return redirect()->route('page.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        if($row->delete()){
            $link = Link::where([['table_id', '=', $id], ['type', '=', 'page']])->first();
            $link->delete();
        } 
        return redirect()->route('page.trash')->with('message', ['type' => 'success','msg' => 'Xóa mẫu tin thành công!']);
    }


    public function trash()
    {
        $list = Page::where('status', '=', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.page.trash', compact('list'));
    }


    
    public function delete($id)
    {
        $row = Page::find($id);
        if($row==NULL)
        {
            return redirect()->route('page.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $row->status = 0;
         $row->updated_at =date('Y-m-d H:i:s');
         $row->updated_by = 1;
         $row->save();
        return redirect()->route('page.index')->with('message', ['type' => 'success','msg' => 'Xóa vào thùng rác thành công!']);
        }
        
    }


    public function restore($id)
    {
        $row = Page::find($id);
        if($row==NULL)
        {
            return redirect()->route('page.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $row->status = 2;
            $row->updated_at=date('Y-m-d H:i:s');
            $row->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
            $row->save();
        return redirect()->route('page.index')->with('message', ['type' => 'success','msg' => 'Khôi phục thành công!']);
        }
        
    }
    
    
    public function status($id)
    {
        $row = Page::find($id);
        if($row==NULL)
        {
            return redirect()->route('page.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $row->status = ($row->status == 1) ? 2 : 1;
         $row->updated_at =date('Y-m-d H:i:s');
         $row->updated_by = 1;
         $row->save();
        return redirect()->route('page.index')->with('message', ['type' => 'success','msg' => 'Thay đổi trạng thái thành công!']);
        }
        
    }
}
