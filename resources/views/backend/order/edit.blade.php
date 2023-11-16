@extends('layouts.admin')
@section('title',$title??'CẬP NHẬT')
@section('content')
<form action="{{ route('order.update',['order'=> $row->id]) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CẬP NHẬT TRẠNG THÁI ĐƠN HÀNG</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index')  }}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Cập nhật sản phẩm</li>
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
                        <div class="col-md-12 text-right">
                            <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Save[Cập nhật]
                            </button>
                            <a class="btn btn-sm btn-info" href="{{ route('order.index')  }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="code">Code đơn hàng</label>
                                <input name="code" id="code" readonly type="text" value="{{ old('code',$row->code) }}" class="form-control " >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="user_id">Mã khách hàng</label>
                                <input name="user_id" id="user_id" type="text" value="{{ old('user_id',$row->user_id) }}" class="form-control " readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exportdate">Ngày xuất</label>
                                <input name="exportdate" id="exportdate" type="text" value="{{ old('exportdate',$row->exportdate) }}" class="form-control " readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="deliveryaddress">Địa chỉ người nhận</label>
                                <input name="deliveryaddress" id="deliveryaddress" type="text" value="{{ old('deliveryaddress',$row->deliveryaddress) }}" class="form-control " readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="deliveryname">Tên người nhận</label>
                                <textarea name="deliveryname" id="deliveryname" cols=" 12" rows="2" class="form-control " readonly>{{ old('deliveryname',$row->deliveryname) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="deliveryphone">Điện thoại người nhận</label>
                                <textarea name="deliveryphone" id="deliveryphone" cols=" 12" rows="2" class="form-control " readonly>{{ old('deliveryphone',$row->deliveryphone) }}</textarea>
                               
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="deliveryemail">	Email người nhận</label>
                                <textarea name="deliveryemail" id="deliveryemail" cols=" 12" rows="2" class="form-control " readonly>{{ old('deliveryemail',$row->deliveryemail) }}</textarea>
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" <?= ($row->status == 1) ? 'selected' : ''; ?>>Đơn hàng mới</option>
                                    <option value="2" <?= ($row->status == 2) ? 'selected' : ''; ?>>Đã xác nhận</option>   
                                    <option value="3" <?= ($row->status == 3) ? 'selected' : ''; ?>>Đóng gói</option>   
                                    <option value="4" <?= ($row->status == 4) ? 'selected' : ''; ?>>Vận chuyển</option>   
                                    <option value="5" <?= ($row->status == 5) ? 'selected' : ''; ?>>Đã giao</option>   
                                    <option value="6" <?= ($row->status == 6) ? 'selected' : ''; ?>>Đã hủy</option>   
                                </select>
                            </div>
                        </div>                        
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button name="THEM" type="submit" class="btn btn-sm btn-success">
                                <i class="fas fa-save"></i> Save[Cập nhật]
                            </button>
                            <a class="btn btn-sm btn-info" href="{{ route('order.index')  }}">
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
    
</form>
@endsection