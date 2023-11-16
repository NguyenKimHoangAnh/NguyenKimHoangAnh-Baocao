@extends('layouts.admin')
@section('title', 'PRODUCT')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>CHỦ ĐỀ BÀI VIẾT</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Tất cả chủ đề</li>
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
                    <a class="btn btn-sm btn-success" href="{{ route('topic.create') }}">
                        <i class="fas fa-plus"></i> Thêm
                    </a>
                    <a class="btn btn-sm btn-danger" href="{{ route('topic.trash') }}">
                        <i class="fas fa-trash"></i> Thùng rác
                    </a>
                </div>
            </div>
        </div>
        </div>
        <div class="card-body">
          @includeIf('backend.messageAlert', ['some' => 'data']) 
          <table class="table table-bordered table-striped">
            <thead class="bg-orange">
              <tr>
                  <th class="text-center" style="width:20px"><input type="checkbox"></th>
                  <th class="text-center" style="width:100px">Tên chủ đề</th>
                  <th class="text-center" style="width:250px">Mô tả</th>
                  <th class="text-center" style="width:250px">Slug chủ đề</th>
                  <th class="text-center">Ngày tạo</th>
                  <th class="text-center">Chức năng</th>
                  <th class="text-center" style="width:20px">ID</th>
              </tr>
          </thead>
          
          @foreach ($list as $row)
          <tr>
            <td class="text-center">
              <input type="checkbox" name="checkId[]" value="{{ $row->id }}">
            </td>
            <td class="text-center">{{ $row->name }}</td>
            <td class="text-center">{{ $row->metadesc }}</td>
            <td class="text-center">{{ $row->slug }}</td>
            <td class="text-center">{{ $row->created_at }}</td>
            <td class="text-center">
              @if ($row->status==1)
              <a class="btn btn-sm btn-success" href="{{ route('topic.status',['topic'=>$row->id]) }}">
                  <i class="fas fa-toggle-on"></i>
              </a>
              @else
              <a class="btn btn-sm btn-danger" href="{{ route('topic.status',['topic'=>$row->id]) }}">
                  <i class="fas fa-toggle-on"></i>
              </a>
              @endif
              <a class="btn btn-sm btn-info" href="{{ route('topic.show',['topic'=>$row->id]) }}">
                  <i class="fas fa-eye"></i>
              </a>
              <a class="btn btn-sm btn-primary" href="{{ route('topic.edit',['topic'=>$row->id]) }}">
                  <i class=" fas fa-edit"></i>
              </a>
              <a class="btn btn-sm btn-danger" href="{{ route('topic.delete',['topic'=>$row->id]) }}" method="GET">
                  @method('DELETE')
                  @csrf
                  <i class=" fas fa-trash"></i>
              </a>                                
          </td class="text-center">
            <td>{{ $row->id }}</td>
          </tr>              
          @endforeach
        </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
@endsection