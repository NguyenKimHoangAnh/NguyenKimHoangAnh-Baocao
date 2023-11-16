<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{
    #danh sach
    public function index()
    {
        $list = Customer::where([['status', '!=', '0'],['roles', '=', '0']])->get();
        return view('backend.customer.index', compact('list'));
    }

    #THEM
    public function create()
    {
        $list = Customer::where('status', '<>', '0')->get();        
        return view('backend.customer.create', compact('list'));
    }



    public function store(CustomerStoreRequest $request)
    {
        $row = new Customer();
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');
        $row->username = $request->username;
        $row->password = $request->password;
        $row->email = $request->email;
        $row->gender = $request->gender;
        $row->phone = $request->phone;
        $row->roles = 0;
        $row->address = $request->address;
        $row->created_at =date('Y-m-d H:i:s');
        $row->created_by = 1;
        $row->status = $request->status;
        //up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $row->slug.'.'.$extention;
                $file->move(public_path('images/customer'), $fileName);
                $row->image = $fileName;
            }
        }
        
        //$customer->image=$request->image;
        $row->save();
        return redirect()->route('customer.index')->with('message', ['type' => 'success','msg' => 'Thêm mẫu tin thành công!']);
    }

  
    public function show($id)
    {
        $row = Customer::find($id);
        if($row==NULL)
        {
            return redirect()->route('customer.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.customer.show',compact('row','title'));
    }

   
    public function edit($id)
    {
        $row = Customer::find($id);
        if($row==NULL)
        {
            return redirect()->route('customer.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $list = Customer::where('status', '<>', '0')->get();        
        $title = 'Cập nhật mẫu tin';
        return view('backend.customer.edit',compact('row','title','list'));
    }

   
    public function update(CustomerUpdateRequest $request, $id)
    {
        $row = Customer::find($id);
        $row->name = $request->name;
        $row->slug = Str::of($request->name)->slug('-');
        $row->username = $request->username;
        $row->password = $request->password;
        $row->email = $request->email;
        $row->gender = $request->gender;
        $row->phone = $request->phone;
        $row->roles = 0;
        $row->address = $request->address;
        $row->created_at =date('Y-m-d H:i:s');
        $row->created_by = 1;
        $row->status = $request->status;
        //up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $row->slug.'.'.$extention;
                $file->move(public_path('images/customer'), $fileName);
                $row->image = $fileName;
            }
        }
        
        //$customer->image=$request->image;
        $row->save();
        return redirect()->route('customer.index')->with('message', ['type' => 'success','msg' => 'Cập nhật mẫu tin thành công!']);
    }

    
    public function destroy($id)
    {
        $row = Customer::find($id);
        if($row==NULL)
        {
            return redirect()->route('customer.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $row->delete();
        return redirect()->route('customer.trash')->with('message', ['type' => 'success','msg' => 'Xóa mẫu tin thành công!']);
    }


    public function trash()
    {
        $list = Customer::where('status', '=', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.customer.trash', compact('list'));
    }


    
    public function delete($id)
    {
        $row = Customer::find($id);
        if($row==NULL)
        {
            return redirect()->route('customer.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $row->status = 0;
         $row->updated_at =date('Y-m-d H:i:s');
         $row->updated_by = 1;
         $row->save();
        return redirect()->route('customer.index')->with('message', ['type' => 'success','msg' => 'Xóa vào thùng rác thành công!']);
        }
        
    }


    public function restore($id)
    {
        $row = Customer::find($id);
        if($row==NULL)
        {
            return redirect()->route('customer.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
            $row->status = 2;
            $row->updated_at=date('Y-m-d H:i:s');
            $row->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
            $row->save();
        return redirect()->route('customer.index')->with('message', ['type' => 'success','msg' => 'Khôi phục thành công!']);
        }
        
    }
    
    
    public function status($id)
    {
        $row = Customer::find($id);
        if($row==NULL)
        {
            return redirect()->route('customer.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        else
        {
         $row->status = ($row->status == 1) ? 2 : 1;
         $row->updated_at =date('Y-m-d H:i:s');
         $row->updated_by = 1;
         $row->save();
        return redirect()->route('customer.index')->with('message', ['type' => 'success','msg' => 'Thay đổi trạng thái thành công!']);
        }
        
    }
}
