@extends('layouts.admin')
@section('title',$title??'CHI TIẾT')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết đơn hàng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index')  }}">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
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
                       
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="text-right">                            
                            <a class="btn btn-sm btn-info" href="{{ route('order.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>                            
                            <a class="btn btn-sm btn-primary" href="{{ route('order.edit',['order'=>$row->id]) }}">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('order.trash',['order'=>$row->id]) }}">
                                <i class=" fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered border-primary table-hover ">
                    <thead class="bg-orange">
                        <tr class="fs-1">
                            <th width="30%">
                                Tên trường
                            </th>
                            <th>
                                Giá trị
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Id</th>
                            <td>{{ $row->id }}</td>
                        </tr>
                        <tr>
                            <th>Code đơn hàng</th>
                            <td>{{ $row->code }}</td>
                        </tr>
                        <tr>
                            <th>Mã khách hàng</th>
                            <td>{{ $row->user_id }}</td>
                        </tr>

                        <tr>
                            <th>Ngày xuất</th>
                            <td>{{ $row->exportdate }}</td>
                        </tr>
                        <tr>
                            <th>Địa chỉ người nhận</th>
                            <td>{{ $row->deliveryaddress }}</td>
                        </tr>
                        <tr>
                            <th>Tên người nhận</th>
                            <td>{{ $row->deliveryname }}</td>
                        </tr>
                        <tr>
                            <th>Số điện thoại người nhận</th>
                            <td>{{ $row->deliveryname }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $row->deliveryemail }}</td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td>{{ $row->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Ngày cập nhật</th>
                            <td>{{ $row->updated_at }}</td>
                        </tr>
                        <tr>
                            <th>Người cập nhật</th>
                            <td>{{ $row->updated_by }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>
                                @if ($row->status==1)
                                <a class="btn btn-sm btn-secondary">                  
                                  Đơn hàng mới
                                </a>
                                @endif 
                                @if ($row->status==2)
                                <a class="btn btn-sm btn-primary">                  
                                  Đã xác nhận
                                </a>
                                @endif
                                @if ($row->status==3)
                                <a class="btn btn-sm btn-info">                  
                                  Đóng gói
                                </a>
                                @endif
                                @if ($row->status==4)
                                <a class="btn btn-sm btn-warning">                  
                                  Vận chuyển
                                </a>
                                @endif
                                @if ($row->status==5)
                                <a class="btn btn-sm btn-success">                  
                                  Đã giao
                                </a>
                                @endif
                                @if ($row->status==6)
                                <a class="btn btn-sm btn-danger">                  
                                  Đã hủy
                                </a>
                                @endif    
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                       
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="text-right">
                            
                            <a class="btn btn-sm btn-info" href="{{ route('order.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>                            
                            <a class="btn btn-sm btn-primary" href="{{ route('order.edit',['order'=>$row->id]) }}">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('order.trash',['order'=>$row->id]) }}">
                                <i class=" fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
    </section>
  </div>
@endsection