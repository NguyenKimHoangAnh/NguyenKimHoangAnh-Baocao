<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;

class ContactController extends Controller
{
    #danh sach
    public function index()
    {
        $list = Contact::where('status', '<>', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.contact.index', compact('list'));
    }

    #THEM
    public function create()
    {
        $list = Contact::where('status', '<>', '0')->get();
        $html_parent_id = '';
        $html_sort_order = '';
        foreach ($list as $item) {
            $html_parent_id .= "<option value='" . $item->id . "'>" . $item->name . "</option>";
            $html_sort_order .= "<option value='" . $item->id . "'>Sau: " . $item->name . "</option>";
        }
        return view('backend.contact.create', compact('html_parent_id','html_sort_order'));
    }



    public function store(ContactStoreRequest $request)
    {
       
    }

  
    public function show($id)
    {
        $row = Contact::find($id);
        if($row==NULL)
        {
            return redirect()->route('contact.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.contact.show',compact('row','title'));
    }

   
    public function edit($id)
    {
        $row = Contact::find($id);
        if($row==NULL)
        {
            return redirect()->route('contact.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $list = Contact::where('status', '<>', '0')->get();        
        $title = 'Cập nhật mẫu tin';
        return view('backend.contact.edit',compact('row','title','list'));
    }

   
    public function update(Request $request, $id)
    {
        $row = Contact::find($id);
        $row->name = $request->name;     
        $row->email = $request->email;
        $row->phone = $request->phone;
        $row->detail = $request->detail;
        $row->replaydetail = $request->replaydetail;
        $row->title = $request->title;
        $row->updated_at =date('Y-m-d H:i:s');
        $row->updated_by = 1;
        $row->status = 2;       
        $row->save();       
        return redirect()->route('contact.index')->with('message', ['type' => 'success','msg' => 'Cập nhật trạng thái thành công!']);
    }

    
    public function destroy($id)
    {
        $row = Contact::find($id);
        if($row==NULL)
        {
            return redirect()->route('contact.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
       $row->delete();
        return redirect()->route('contact.trash')->with('message', ['type' => 'success','msg' => 'Xóa mẫu tin thành công!']);
    }


    public function trash()
    {
        $list = Contact::where('status', '=', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.contact.trash', compact('list'));
    }


    
    public function delete($id)
    {
        $row = Contact::find($id);
        if($row==NULL)
        {
            return redirect()->route('contact.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $row->status = 0;
         $row->updated_at =date('Y-m-d H:i:s');
         $row->updated_by = 1;
         $row->save();
        return redirect()->route('contact.index')->with('message', ['type' => 'success','msg' => 'Xóa vào thùng rác thành công!']);
        }
        
    }


    public function restore($id)
    {
        $row = Contact::find($id);
        if($row==NULL)
        {
            return redirect()->route('contact.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $row->status = 2;
            $row->updated_at=date('Y-m-d H:i:s');
            $row->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
            $row->save();
        return redirect()->route('contact.index')->with('message', ['type' => 'success','msg' => 'Khôi phục thành công!']);
        }
        
    }
    
    
    public function status($id)
    {
        $row = Contact::find($id);
        if($row==NULL)
        {
            return redirect()->route('contact.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $row->status = ($row->status == 1) ? 2 : 1;
         $row->updated_at =date('Y-m-d H:i:s');
         $row->updated_by = 1;
         $row->save();
        return redirect()->route('contact.index')->with('message', ['type' => 'success','msg' => 'Thay đổi trạng thái thành công!']);
        }
        
    }
}
