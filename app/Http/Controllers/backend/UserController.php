<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Tất cả tài khoản ';
        $list = User::where([['status', '<>', '0'], ['roles', '!=', '0']])->orderBy('created_at', 'desc')->get();
        return view("backend.user.index", compact('list', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Thêm Thành Viên';
        return view("backend.user.create", compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $row = new User();
        $row->name = $request->name;
        $row->username = $request->username;
        $row->password = Hash::make($request->password);
        $row->email = $request->email;
        $row->gender = $request->gender;
        $row->phone = $request->phone;
        $row->address = $request->address;
        $row->roles = 1;
        // $row->level = 1;
        $row->status = $request->status;
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = ($request->session()->exists('user_id') ? session('user_id') : 1);
        //upload file

        if ($request->hasFile('image')) {
            $path = 'images/user/';
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $row->username . '.' . $extension;
            $file->move($path, $filename);
            $row->image = $filename;
        } else {
            if ($row->gender) {
                $row->image = 'user_women.png';
            } else {
                $row->image = 'user_men.png';
            }
        }
        if ($row->save()) {
            return redirect()->route('user.index')->with('message', ['type' => 'success', 'msg' => 'Thêm thành công!']);
        }
        return redirect()->route('user.create')->with('message', ['type' => 'danger', 'msg' => 'Thêm thất bại!!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = User::find($id);
        if($row==NULL)
        {
            return redirect()->route('user.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.user.show',compact('row','title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = User::where([['status', '!=', '0'], ['id', '=', $id], ['roles', '!=', '0']])->first();
        if ($row == null) {
            return redirect()->route('user.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
        }
        $title = 'Sửa Thành Viên';
        return view('backend.user.edit', compact('title', 'row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $row = User::find($id);
        $row->name = $request->name;
        $row->username = $request->username;
        if ($request->password != null) {
            $row->password = Hash::make($request->password);
        }
        $row->email = $request->email;
        $row->gender = $request->gender;
        $row->phone = $request->phone;
        $row->address = $request->address;
        $row->roles = 1;
        // $row->level = 1;
        $row->status = $request->status;
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = ($request->session()->exists('user_id') ? session('user_id') : 1);
        //upload file

        if ($request->def_image == 1) {
            if ($row->gender) {
                $row->image = 'user_women.png';
            } else {
                $row->image = 'user_men.png';
            }
        }
        if ($request->hasFile('image')) {
            $path = 'images/user/';
            if (File::exists(public_path($path . $row->image)) && ($row->image != 'user_women.png') && ($row->image != 'user_men.png')) {
                File::delete(public_path($path . $row->image));
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $row->username . '.' . $extension;
            $file->move($path, $filename);
            $row->image = $filename;
        } else {
            if ($row->gender == 1 && (($row->image == 'user_women.png') || ($row->image == 'user_men.png'))) {
                $row->image = 'user_women.png';
            }
            if ($row->gender == 0 && (($row->image == 'user_women.png') || ($row->image == 'user_men.png'))) {
                $row->image = 'user_men.png';
            }
        }
        if ($row->save()) {
            return redirect()->route('user.index')->with('message', ['type' => 'success', 'msg' => 'Cập nhật thành công!']);
        }
        return redirect()->route('user.edit')->with('message', ['type' => 'danger', 'msg' => 'Cập nhật thất bại!!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = User::find($id);
        if($row==NULL)
        {
            return redirect()->route('user.index')->with('message', ['type' => 'danger','msg' => 'Mẫu tin không tồn tại!']);
        } else {
            $row->delete();
            return redirect()->route('user.trash')->with('message', ['type' => 'success', 'msg' => 'Xóa tài khoảng thành công']);
        }
    }
    // delete
    public function delete($id, Request $request)
    {
        $row =User::find($id);
        if ($row == null) {
            return redirect()->route('user.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
        } else {
            $row->status = 0;
            $row->updated_at = date('Y-m-d H:i:s');
            $row->updated_by = ($request->session()->exists('user_id')) ? session('user_id') : 1;
            $row->save();
            return redirect()->route('user.index')->with('message', ['type' => 'success', 'msg' => 'Chuyển vào thùng rác thành công']);
        }
    }
    // trash
    public function trash()
    {
        $title = 'Tất cả tài khoản không còn sử dụng';
        $list = User::where('status', '=', '0')->orderBy('created_at', 'desc')->get();
        return view("backend.user.trash", compact('list', 'title'));
    }
    // status
    public function status($id, Request $request)
    {
        $row = User::find($id);
        if ($row == null) {
            return redirect()->route('user.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại']);
        } else {
            $row->status = ($row->status == 1) ? 2 : 1;
            $row->updated_at = date('Y-m-d H:i:s');
            $row->updated_by = ($request->session()->exists('user_id')) ? session('user_id') : 1;
            $row->save();
            return redirect()->route('user.index')->with('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công']);
        }
    }
    // restore
    public function restore($id, Request $request)
    {
        $row = User::find($id);
       
        {
            $row->status = 2 ;
            $row->updated_at = date('Y-m-d H:i:s');
            $row->updated_by = ($request->session()->exists('user_id')) ? session('user_id') : 1;
            $row->save();
        return redirect()->route('user.index')->with('message', ['type' => 'success','msg' => 'Khôi phục thành công!']);
        }
        
    }
}
