<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;

class SliderController extends Controller
{
    #danh sach
    public function index()
    {
        $list = Slider::where('status', '<>', '0')->get();
        return view('backend.slider.index', compact('list'));
    }

    #THEM
    public function create()
    {
        $list = Slider::where('status', '<>', '0')->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list as $item) {
            $html_parent_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            $html_sort_order .= "<option value='" . $item->id . "'>Sau: " . $item->name . "</option>";
        }
        return view('backend.slider.create', compact('html_parent_id','html_sort_order'));
    }



    public function store(SliderStoreRequest $request)
    {
        $row = new Slider();
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');
        $row->link = $request->link;
        $row->position = $request->position;
        $row->sort_order = $request->sort_order;  
        $row->created_at =date('Y-m-d H:i:s');
        $row->created_by = 1;
        $row->status = $request->status;
        //up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $row->slug.'.'.$extention;
                $file->move(public_path('images/slider'), $fileName);
                $row->image = $fileName;
            }
        }
        
        //$slider->image=$request->image;
        $row->save();
        return redirect()->route('slider.index')->with('message', ['type' => 'success','msg' => 'Thêm mẫu tin thành công!']);
    }

  
    public function show($id)
    {
        $row = Slider::find($id);
        if($row==NULL)
        {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.slider.show',compact('row','title'));
    }

   
    public function edit($id)
    {
        $row = Slider::find($id);
        if($row==NULL)
        {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $list = Slider::where('status', '<>', '0')->get();
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
        return view('backend.slider.edit',compact('row','title','html_parent_id','html_sort_order'));
    }

   
    public function update(SliderUpdateRequest $request, $id)
    {
        $row = Slider::find($id);
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');
        $row->link = $request->link;
        $row->position = $request->position;
        $row->sort_order = $request->sort_order;  
        $row->created_at =date('Y-m-d H:i:s');
        $row->created_by = 1;
        $row->status = $request->status;
        //up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $row->slug.'.'.$extention;
                $file->move(public_path('images/slider'), $fileName);
                $row->image = $fileName;
            }
        }
        
        //$slider->image=$request->image;
        $row->save();
        return redirect()->route('slider.index')->with('message', ['type' => 'success','msg' => 'Cập nhật mẫu tin thành công!']);
    }

    
    public function destroy($id)
    {
        $row = Slider::find($id);
        if($row==NULL)
        {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $row->delete();
        return redirect()->route('slider.trash')->with('message', ['type' => 'success','msg' => 'Xóa mẫu tin thành công!']);
    }


    public function trash()
    {
        $list = Slider::where('status', '=', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.slider.trash', compact('list'));
    }


    
    public function delete($id)
    {
        $row = Slider::find($id);
        if($row==NULL)
        {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $row->status = 0;
         $row->updated_at =date('Y-m-d H:i:s');
         $row->updated_by = 1;
         $row->save();
        return redirect()->route('slider.index')->with('message', ['type' => 'success','msg' => 'Xóa vào thùng rác thành công!']);
        }
        
    }


    public function restore($id)
    {
        $row = Slider::find($id);
        if($row==NULL)
        {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $row->status = 2;
            $row->updated_at=date('Y-m-d H:i:s');
            $row->updated_by =1;
            $row->save();
        return redirect()->route('slider.index')->with('message', ['type' => 'success','msg' => 'Khôi phục thành công!']);
        }
        
    }
    
    
    public function status($id)
    {
        $row = Slider::find($id);
        if($row==NULL)
        {
            return redirect()->route('slider.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $row->status = ($row->status == 1) ? 2 : 1;
         $row->updated_at =date('Y-m-d H:i:s');
         $row->updated_by = 1;
         $row->save();
        return redirect()->route('slider.index')->with('message', ['type' => 'success','msg' => 'Thay đổi trạng thái thành công!']);
        }
        
    }
}
