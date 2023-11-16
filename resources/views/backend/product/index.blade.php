@extends('layouts.admin')
@section('title', 'TẤT CẢ SẢN PHẨM')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>TẤT CẢ SẢN PHẨM</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index')  }}">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">TẤT CẢ SẢN PHẨM</li>
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
                      <a class="btn btn-sm btn-success" href="{{ route('product.create') }}">
                          <i class="fas fa-plus"></i> Thêm
                      </a>
                      <a class="btn btn-sm btn-danger" href="{{ route('product.trash') }}">
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
                  <th class="text-center" style="width:20px">
                      <div class="form-group select-all">
                          <input type="checkbox" id="select-all" name="checkId">
                      </div>
                  </th>
                  <th class="text-center" style="width:100px">Hình</th>
                  <th class="text-center" style="width:250px">Tên sản phẩm</th>
                  <th class="text-center" style="width:140px">Danh mục</th>
                  <th class="text-center" style="width:140px">Thương hiệu</th>
                  <th class="text-center" style="width:140px">Ngày tạo</th>
                  <th class="text-center" style="width:160px">Chức năng</th>
                  <th class="text-center" style="width:20px">ID</th>
              </tr>
          </thead>
          
          @foreach ($list as $row)
          <tr>
            <td>
              <input type="checkbox" name="checkId[]" value="{{ $row->id }}">
            </td>
            <td>
              <img src="{{ asset('images/product/'.$row->image) }}" alt="{{ $row->images }}" class="img-fluid">
            </td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->category_id }}</td>
            <td>{{ $row->brand_id }}</td>
            <td>{{ $row->created_at }}</td>
            <td class="text-center">
              @if ($row->status==1)
              <a class="btn btn-sm btn-success" href="{{ route('product.status',['product'=>$row->id]) }}">
                  <i class="fas fa-toggle-on"></i>
              </a>
              @else
              <a class="btn btn-sm btn-danger" href="{{ route('product.status',['product'=>$row->id]) }}">
                  <i class="fas fa-toggle-on"></i>
              </a>
              @endif
              <a class="btn btn-sm btn-info" href="{{ route('product.show',['product'=>$row->id]) }}">
                  <i class="fas fa-eye"></i>
              </a>
              <a class="btn btn-sm btn-primary" href="{{ route('product.edit',['product'=>$row->id]) }}">
                  <i class=" fas fa-edit"></i>
              </a>
              <a class="btn btn-sm btn-danger" href="{{ route('product.delete',['product'=>$row->id]) }}" method="GET">
                  @method('DELETE')
                  @csrf
                  <i class=" fas fa-trash"></i>
              </a>                                
          </td>
            <td>{{ $row->id }}</td>
          </tr>              
          @endforeach
        </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="row">
              <div class="col-md-6">
                  <a class="btn btn-sm btn-danger" href="">
                      <i class="fas fa-trash" aria-hidden="true"></i> Xóa
                  </a>
              </div>
              <div class="col-md-6 text-right">
                  <a class="btn btn-sm btn-success" href="{{ route('product.create') }}">
                      <i class="fas fa-plus"></i> Thêm
                  </a>
                  <a class="btn btn-sm btn-danger" href="{{ route('product.trash') }}">
                      <i class="fas fa-trash"></i> Thùng rác
                  </a>
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
        
        