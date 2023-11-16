<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Link;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;

class BrandController extends Controller
{
    #danh sach
    public function index()
    {
        $list = Brand::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.brand.index', compact('list'));
    }

    #THEM
    public function create()
    {
        $list = Brand::where('status', '<>', '0')->get();
        
        $html_sort_order = '';
        foreach ($list as $item) {
            $html_sort_order .= "<option value='" . $item->id . "'>Sau: " . $item->name . "</option>";
        }
        return view('backend.brand.create', compact('html_sort_order'));
    }



    public function store(BrandStoreRequest $request)
    {
        $row = new Brand();
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');
        $row->sort_order = $request->sort_order;
        //$brand->level = $request->level;        
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->created_at =date('Y-m-d H:i:s');
        $row->created_by = 1;
        $row->status = $request->status;
        //up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $row->slug.'.'.$extention;
                $file->move(public_path('images/brand'), $fileName);
                $row->image = $fileName;
            }
        }
        
        //$brand->image=$request->image;
        if ($row->save()){
            $link = new Link();
            $link->slug= $row->slug;
            $link->table_id = $row->id;
            $link->type = 'brand';
            $link->save();
        }
        return redirect()->route('brand.index')->with('message', ['type' => 'success','msg' => 'Thêm mẫu tin thành công!']);
    }

  
    public function show($id)
    {
        $row = Brand::find($id);
        if($row==NULL)
        {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.brand.show',compact('row','title'));
    }

   
    public function edit($id)
    {
        $row = Brand::find($id);
        if($row==NULL)
        {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $list = Brand::where('status', '<>', '0')->get();
        $html_sort_order = '';
        foreach ($list as $item) {           
            if($item->sort_order == $row->sort_order - 1){
                $html_sort_order .= "<option selected value='" . ($item->sort_order + 1) . "'>Sau: " . $item->name . "</option>";
            }else
            {
                $html_sort_order .= "<option value='" . ($item->sort_order + 1) . "'>Sau: " . $item->name . "</option>";
            }
        }
        $title = 'Cập nhật mẫu tin';
        return view('backend.brand.edit',compact('row','title','html_sort_order'));
    }

   
    public function update(BrandUpdateRequest $request, $id)
    {
        $row = Brand::find($id);
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');
        $row->sort_order = $request->sort_order;
        //$brand->level = $request->level;        
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
                $file->move(public_path('images/brand'), $fileName);
                $row->image = $fileName;
            }
        }
        //$brand->image=$request->image;
        if ($row->save()){
            $link = Link::where([['table_id', '=', $id], ['type', '=', 'brand']])->first();
            $link->slug= $row->slug;            
            $link->save();
        }
        return redirect()->route('brand.index')->with('message', ['type' => 'success','msg' => 'Cập nhật mẫu tin thành công!']);
    }

    
    public function destroy($id)
    {
        $row = Brand::find($id);
        if($row==NULL)
        {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        if($row->delete()){
            $link = Link::where([['table_id', '=', $id], ['type', '=', 'brand']])->first();
            $link->delete();
        }        
        return redirect()->route('brand.trash')->with('message', ['type' => 'success','msg' => 'Xóa mẫu tin thành công!']);
    }


    public function trash()
    {
        $list = Brand::where('status', '=', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.brand.trash', compact('list'));
    }


    
    public function delete($id)
    {
        $row = Brand::find($id);
        if($row==NULL)
        {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $row->status = 0;
         $row->updated_at =date('Y-m-d H:i:s');
         $row->updated_by = 1;
         $row->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success','msg' => 'Xóa vào thùng rác thành công!']);
        }
        
    }


    public function restore($id)
    {
        $row = Brand::find($id);
        if($row==NULL)
        {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $row->status = 2;
            $row->updated_at=date('Y-m-d H:i:s');
            $row->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
            $row->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success','msg' => 'Khôi phục thành công!']);
        }
        
    }
    
    
    public function status($id)
    {
        $row = Brand::find($id);
        if($row==NULL)
        {
            return redirect()->route('brand.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $row->status = ($row->status == 1) ? 2 : 1;
         $row->updated_at =date('Y-m-d H:i:s');
         $row->updated_by = 1;
         $row->save();
        return redirect()->route('brand.index')->with('message', ['type' => 'success','msg' => 'Thay đổi trạng thái thành công!']);
        }
        
    }
}
