@extends('layouts.admin')
@section('title', 'PRODUCT')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DANH SÁCH ĐƠN HÀNG</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index')  }}">Bảng điều khiển</a></li>
              <li class="breadcrumb-item active">Danh sách đơn hàng</li>
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
                    <a class="btn btn-sm btn-danger" href="{{ route('order.trash') }}">
                        <i class="fas fa-trash"></i> Thùng rác
                    </a>
                </div>
            </div>
        </div>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
        </div>
        <div class="card-body">
          @includeIf('backend.messageAlert', ['some' => 'data'])
          <table class="table table-bordered table-striped">
            <thead class="bg-orange">
              <tr>
                <th class="text-center" style="width:20px"><input type="checkbox"></th>
                <th style="width:170px">Code đơn hàng</th>
                <th style="width:170px">Email</th>
                <th style="width:100px">Điện thoai</th>
                <th class="text-center">Ngày tạo</th>
                <th class="text-center">Trạng thái</th>
                <th class="text-center" style="width:150px">Chức năng</th>
                <th class="text-center" style="width:20px">ID</th>
            </tr>
          </thead>
          
          @foreach ($list as $row)
          <tr>
            <td>
              <input type="checkbox" name="checkId[]" value="{{ $row->id }}">
            </td>            
            <td>{{ $row->code }}</td>
            <td>{{ $row->deliveryemail }}</td>
            <td>{{ $row->deliveryphone }}</td>
            <td>{{ $row->created_at }}</td>
            <td class="text-center">
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
            <td class="text-center">              
              <a class="btn btn-sm btn-info" href="{{ route('order.show',['order'=>$row->id]) }}">
                  <i class="fas fa-eye"></i>
              </a>     
              <a class="btn btn-sm btn-primary" href="{{ route('order.edit',['order'=>$row->id]) }}">
                <i class="fas fa-edit"></i>
              </a>          
              <a class="btn btn-sm btn-danger" href="{{ route('order.delete',['order'=>$row->id]) }}" method="GET">
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
                <button class="btn btn-sm btn-danger" type="submit" name="DELETE_ALL">
                    <i class="fas fa-trash"></i> Xóa đã chọn
                </button>
            </div>
            <div class="col-md-6 text-right">
                <div class="text-right">                    
                    <a class="btn btn-sm btn-danger" href="{{ route('order.trash') }}">
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