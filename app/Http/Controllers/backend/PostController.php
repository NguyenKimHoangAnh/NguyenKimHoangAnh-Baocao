<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Topic;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    #danh sach
    public function index()
    {
        $list = Post::where([['status', '<>', '0'], ['type', '=', 'post']])->orderBy('created_at', 'desc')->get();
        return view('backend.post.index', compact('list'));
    }

    #THEM
    public function create()
    {
        $list = Topic::where('status', '<>', '0')->get();
        $html_topic_id = '';
        foreach ($list as $item) {
            $html_topic_id .= "<option value='" . $item->id . "'>Sau: " . $item->name . "</option>";  
               
        }
        // dd($html_topic_id);  
        return view('backend.post.create', compact('html_topic_id'));
    }



    public function store(PostStoreRequest $request)
    {
        $row = new Post();
        $row->title = $request->title;
        $row->slug = Str::slug($request->title, '-');
        $row->detail = $request->detail;
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->topic_id = $request->topic_id;
        $row->status = $request->status;
        $row->type = 'post';
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
        $row->status = $request->status;
        //up load file
        if ($request->has('image')) {
            $path_dir = "images/Post/";
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = $row->slug . '.' . $extension;
            $file->move($path_dir, $filename);
            $row->image = $filename;
            $row->save();
            return redirect()->route('post.index')->with('message', ['type' => 'success', 'msg' => 'Thêm sản phẩm thành công']);
        }

        //$row->image=$request->image;
        $row->save();
        return redirect()->route('post.index')->with('message', ['type' => 'success', 'msg' => 'Thêm mẫu tin thành công!']);
    }


    public function show($id)
    {
        $row = Post::find($id);
        if ($row == NULL) {
            return redirect()->route('post.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }
        $title = 'Chi tiết mẫu tin';
        return view('backend.post.show', compact('row', 'title'));
    }


    public function edit($id)
    {
        $row = Post::find($id);
        $title = 'Sửa bài viết';
        $list_topic = Topic::where('status',  '<>', '0')->get();
        
        $html_topic_id = "";
        foreach ($list_topic as $topic) {
            if ($topic->id != $id) {
                if ($row->topic_id == $topic->id) {
                    $html_topic_id .= "<option selected value='" . $topic->id . "'>" . $topic->name . "</option>";
                } else {
                    $html_topic_id .= "<option value='" . $topic->id . "'>" . $topic->name . "</option>";
                }
            }
        }
        return view('backend.post.edit', compact('row', 'html_topic_id', 'title'));
    }


    public function update(PostUpdateRequest $request, $id)
    {
        $row = Post::find($id);
        $row->title = $request->title;
        $row->slug = Str::slug($request->title, '-');
        $row->detail = $request->detail;
        $row->metakey = $request->metakey;
        $row->metadesc = $request->metadesc;
        $row->topic_id = $request->topic_id;
        $row->status = $request->status;
        $row->type = 'post';
        $row->created_at = date('Y-m-d H:i:s');
        $row->created_by = 1;
        $row->status = $request->status;
        ///up load file
        $file = $request->file('image');
        if ($file != NULL) {
            $extention = $file->getClientOriginalExtension();
            if (in_array($extention, ['png', 'jpg', 'jpeg', 'webp'])) {
                $fileName = $row->slug . '.' . $extention;
                $file->move(public_path('images/post'), $fileName);
                $row->image = $fileName;
            }
        }
        $row->save();
        return redirect()->route('post.index')->with('message', ['type' => 'success', 'msg' => 'Cập nhật mẫu tin thành công!']);
    }


    public function destroy($id)
    {
        $row = Post::find($id);
        if ($row == NULL) {
            return redirect()->route('post.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        }
        $row->delete();
        return redirect()->route('post.trash')->with('message', ['type' => 'success', 'msg' => 'Xóa mẫu tin thành công!']);
    }


    public function trash()
    {
        $list = Post::where('status', '=', '0')->orderBy('created_at', 'desc')->get();
        return view('backend.post.trash', compact('list'));
    }



    public function delete($id)
    {
        $row = Post::find($id);
        if ($row == NULL) {
            return redirect()->route('post.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        } else {
            $row->status = 0;
            $row->updated_at = date('Y-m-d H:i:s');
            $row->updated_by = 1;
            $row->save();
            return redirect()->route('post.index')->with('message', ['type' => 'success', 'msg' => 'Xóa vào thùng rác thành công!']);
        }
    }


    public function restore($id)
    {
        $row = Post::find($id);
        if ($row == NULL) {
            return redirect()->route('post.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        } else {
            $row->status = 2;
            $row->updated_at = date('Y-m-d H:i:s');
            $row->updated_by = (isset($_SESSION['user_id'])) ? $_SESSION['user_id'] : 1;
            $row->save();
            return redirect()->route('post.index')->with('message', ['type' => 'success', 'msg' => 'Khôi phục thành công!']);
        }
    }


    public function status($id)
    {
        $row = Post::find($id);
        if ($row == NULL) {
            return redirect()->route('post.index')->with('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        } else {
            $row->status = ($row->status == 1) ? 2 : 1;
            $row->updated_at = date('Y-m-d H:i:s');
            $row->updated_by = 1;
            $row->save();
            return redirect()->route('post.index')->with('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
        }
    }
}
