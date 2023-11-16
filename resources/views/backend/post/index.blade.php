@extends('layouts.admin')
@section('title', 'cacacac')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>TẤT CẢ BÀI VIẾT</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index')  }}">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Tất cả bài viết</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-sm btn-danger" type="submit" name="DELETE_ALL">
                            <i class="fas fa-trash"></i> Xóa đã chọn
                        </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="text-right">
                            <a class="btn btn-sm btn-success" href="{{ route('post.create')  }}">
                                <i class="fas fa-plus"></i> Thêm
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('post.trash')  }}">
                                <i class="fas fa-trash"></i> Thùng rác
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @includeIf('backend.messageAlert', ['some' => 'data']) 
                <table class="table table-bordered" id="myTable">                    
                    <thead class="bg-orange">
                        <tr>
                            <th class="text-center" style="width:20px"><input type="checkbox"></th>
                            <th class="text-center" style="width:100px">Hình</th>
                            <th class="text-center" style="width:250px">Tiêu đề bài viết</th>
                            <th class="text-center" style="width:250px">Chủ đề</th>
                            <th class="text-center" style="width:140px">Ngày tạo</th>
                            <th class="text-center" style="width:200px">Chức năng</th>
                            <th class="text-center" style="width:20px">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                        <tr>
                            <td>
                            <input type="checkbox" name="checkId[]" value="{{ $row->id }}">
                            </td>
                            <td>
                            <img src="{{ asset('images/post/'.$row->image) }}" alt="{{ $row->images }}" class="img-fluid">
                            </td>
                            <td>{{ $row->title }}</td>
                            <td class="text-center"><textarea cols="50" rows="5">{{ $row->detail }}</textarea></td>
                            <td class="text-center">{{ $row->created_at }}</td>
                            <td class="text-center">
                                @if ($row->status==1)
                                <a class="btn btn-sm btn-success" href="{{ route('post.status',['post'=>$row->id]) }}">
                                    <i class="fas fa-toggle-on"></i>
                                </a>
                                @else
                                <a class="btn btn-sm btn-danger" href="{{ route('post.status',['post'=>$row->id]) }}">
                                    <i class="fas fa-toggle-on"></i>
                                </a>
                                @endif
                                <a class="btn btn-sm btn-info" href="{{ route('post.show',['post'=>$row->id]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-sm btn-primary" href="{{ route('post.edit',['post'=>$row->id]) }}">
                                    <i class=" fas fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger" href="{{ route('post.delete',['post'=>$row->id]) }}" method="GET">
                                    
                                    @csrf
                                    <i class=" fas fa-trash"></i>
                                </a>                                
                            </td>
                            <td>{{ $row->id }}</td>
                        </tr>              
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-sm btn-danger" type="submit" name="DELETE_ALL">
                            <i class="fas fa-trash"></i> Xóa đã chọn
                        </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="text-right">
                            <a class="btn btn-sm btn-success" href="{{ route('post.create')  }}">
                                <i class="fas fa-plus"></i> Thêm
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('post.trash')  }}">
                                <i class="fas fa-trash"></i> Thùng rác
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection