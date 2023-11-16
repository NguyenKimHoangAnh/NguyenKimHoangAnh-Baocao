@extends('layouts.admin')
@section('title', 'Contact')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>TẤT CẢ LIÊN HỆ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index')  }}">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Tất cả liên hệ</li>
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
                            
                            <a class="btn btn-sm btn-danger" href="{{ route('contact.trash') }}">
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
                            <th class="text-center" style="width:170px">Họ & Tên</th>
                            <th class="text-center" style="width:170px">Email</th>
                            <th class="text-center" style="width:100px">Điện thoai</th>
                            <th class="text-center" style="width:100px">Trạng thái</th>
                            <th class="text-center" style="width:150px">Ngày tạo</th>
                            <th class="text-center" style="width:150px">Chức năng</th>
                            <th class="text-center" style="width:20px">ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                        <tr>
                            <td class="text-center">
                            <input type="checkbox" name="checkId[]" value="{{ $row->id }}">
                            </td>
                            <td class="text-center">{{ $row->name }}</td>
                            <td class="text-center">{{ $row->email }}</td>
                            <td class="text-center">{{ $row->phone }}</td>
                            <td class="text-center">
                                    @if ($row->status==1)
                                    <a class="btn btn-sm btn-secondary" href="">                  
                                      Chưa trả lời
                                    </a> 
                                    @else
                                    <a class="btn btn-sm btn-primary" href="">                  
                                      Đã trả lời
                                    </a>
                                    @endif
                            </td>
                            <td class="text-center">{{ $row->created_at }}</td>
                            <td class="text-center">                                
                                <a class="btn btn-sm btn-info" href="{{ route('contact.show',['contact'=>$row->id]) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a class="btn btn-sm btn-primary" href="{{ route('contact.edit',['contact'=>$row->id]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger" href="{{ route('contact.delete',['contact'=>$row->id]) }}" method="GET">
                                    @method('DELETE')
                                    @csrf
                                    <i class=" fas fa-trash"></i>
                                </a>                               
                            </td>
                            <td class="text-center">{{ $row->id }}</td>
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
                            
                            <a class="btn btn-sm btn-danger" href="{{ route('contact.trash') }}">
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