@extends('layouts.admin')
@section('title', 'TẤT CẢ SẢN PHẨM')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thùng rác</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index')  }}">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Thùng rác sản phẩm</li>
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
                            <a class="btn btn-sm btn-info" href="{{ route('product.index')  }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
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
                    <img src="{{ asset('images/product/'.$row->images) }}" alt="{{ $row->images }}" class="img-fluid">
                  </td>
                  <td>{{ $row->name }}</td>
                  <td>{{ $row->category_id }}</td>
                  <td>{{ $row->brand_id }}</td>
                  <td>{{ $row->created_at }}</td>
                  <td class="text-center">
                    <a class="btn btn-sm btn-info" href="{{ route('product.show',['product'=>$row->id]) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-sm btn-primary" href="{{ route('product.restore',['product'=>$row->id]) }}">
                        <i class="fas fa-undo-alt"></i>
                    </a>
                    <form action="{{ route('product.destroy',['product'=>$row->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
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
                        <button class="btn btn-sm btn-danger" type="submit" name="DELETE_ALL">
                            <i class="fas fa-trash"></i> Xóa đã chọn
                        </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <a class="btn btn-sm btn-info" href="{{ route('product.index')  }}">
                            <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
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