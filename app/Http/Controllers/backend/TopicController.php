<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Link;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\TopicStoreRequest;
use App\Http\Requests\TopicUpdateRequest;

class TopicController extends Controller
{
    #danh sach
    public function index()
    {
        $list = Topic::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.topic.index', compact('list'));
    }

    #THEM
    public function create()
    {
        $list = Topic::where('status', '<>', '0')->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list as $item) {
            $html_parent_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            $html_sort_order .= "<option value='" . $item->id . "'>Sau: " . $item->name . "</option>";
        }
        return view('backend.topic.create', compact('html_parent_id','html_sort_order'));
    }



    public function store(TopicStoreRequest $request)
    {
        $row = new Topic();
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');
        $row->parent_id = $request->parent_id;
        $row->sort_order = $request->sort_order;
        //$topic->level = $request->level;        
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->created_at =date('Y-m-d H:i:s');
        $row->created_by = 1;
        $row->status = $request->status;
        
        if ($row->save()){
            $link = new Link();
            $link->slug= $row->slug;
            $link->table_id = $row->id;
            $link->type = 'topic';
            $link->save();
        }
        return redirect()->route('topic.index')->with('message', ['type' => 'success','msg' => 'Thêm mẫu tin thành công!']);
    }

  
    public function show($id)
    {
        $row = Topic::find($id);
        if($row==NULL)
        {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.topic.show',compact('row','title'));
    }

   
    public function edit($id)
    {
        $row = Topic::find($id);
        if($row==NULL)
        {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $list = Topic::where('status', '<>', '0')->get();
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
        return view('backend.topic.edit',compact('row','title','html_parent_id','html_sort_order'));
    }

   
    public function update(TopicUpdateRequest $request, $id)
    {
        $row = Topic::find($id);
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');
        $row->parent_id = $request->parent_id;
        $row->sort_order = $request->sort_order;
        //$topic->level = $request->level;        
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->updated_at =date('Y-m-d H:i:s');
        $row->updated_by = 1;
        $row->status = $request->status;
        
        if ($row->save()){
            $link = Link::where([['table_id', '=', $id], ['type', '=', 'topic']])->first();
            $link->slug= $row->slug;            
            $link->save();
        }
        return redirect()->route('topic.index')->with('message', ['type' => 'success','msg' => 'Cập nhật mẫu tin thành công!']);
    }

    
    public function destroy($id)
    {
        $row = Topic::find($id);
        if($row==NULL)
        {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        if($row->delete()){
            $link = Link::where([['table_id', '=', $id], ['type', '=', 'topic']])->first();
            $link->delete();
        }
        ;
        return redirect()->route('topic.trash')->with('message', ['type' => 'success','msg' => 'Xóa mẫu tin thành công!']);
    }


    public function trash()
    {
        $list = Topic::where('status', '=', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.topic.trash', compact('list'));
    }


    
    public function delete($id)
    {
        $row = Topic::find($id);
        if($row==NULL)
        {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $row->status = 0;
         $row->updated_at =date('Y-m-d H:i:s');
         $row->updated_by = 1;
         $row->save();
        return redirect()->route('topic.index')->with('message', ['type' => 'success','msg' => 'Xóa vào thùng rác thành công!']);
        }
        
    }


    public function restore($id)
    {
        $row = Topic::find($id);
        if($row==NULL)
        {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $row->status = 2;
            $row->updated_at=date('Y-m-d H:i:s');
            $row->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
            $row->save();
        return redirect()->route('topic.index')->with('message', ['type' => 'success','msg' => 'Khôi phục thành công!']);
        }
        
    }
    
    
    public function status($id)
    {
        $row = Topic::find($id);
        if($row==NULL)
        {
            return redirect()->route('topic.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $row->status = ($row->status == 1) ? 2 : 1;
         $row->updated_at =date('Y-m-d H:i:s');
         $row->updated_by = 1;
         $row->save();
        return redirect()->route('topic.index')->with('message', ['type' => 'success','msg' => 'Thay đổi trạng thái thành công!']);
        }
        
    }
}
