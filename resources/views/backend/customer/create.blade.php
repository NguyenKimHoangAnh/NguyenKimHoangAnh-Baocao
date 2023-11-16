@extends('layouts.admin')
@section('title',$title??'customer')
@section('content')
<form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>THÊM KHÁCH HÀNG</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index')  }}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Thêm khách hàng</li>
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
                                <i class="fas fa-save"></i> Save[Thêm]
                            </button>
                            <a class="btn btn-sm btn-info" href="{{ route('customer.index')  }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="username">Tài khoảng</label>
                                <input name="username" id="username" type="text" class="form-control "  placeholder="Tài khoảng">
                                @if ( $errors->has('username') )
                                <div class="text-danger">
                                    {{ $errors->first('username') }}
                                </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="password">Mật khẩu</label>
                                <input name="password" id="password" type="password" class="form-control "  placeholder="Mật khẩu">
                                @if ( $errors->has('password') )
                                <div class="text-danger">
                                    {{ $errors->first('password') }}
                                </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="password">Xác nhận mật khẩu</label>
                                <input name="password_re" id="password_re" type="password" class="form-control "  placeholder="Xác nhận mật khẩu">
                                @if ( $errors->has('password') )
                                <div class="text-danger">
                                    {{ $errors->first('password') }}
                                </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input name="email" id="email" type="email" class="form-control "  placeholder="vd: abc123@gmail.com">
                                @if ( $errors->has('email') )
                                <div class="text-danger">
                                    {{ $errors->first('email') }}
                                </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="phone">Số điện thoại</label>
                                <input name="phone" id="phone" type="tel" class="form-control "  placeholder="vd:19009055">
                                @if ( $errors->has('phone') )
                                <div class="text-danger">
                                    {{ $errors->first('phone') }}
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Họ tên</label>
                                <input name="name" id="name" type="text" class="form-control "  placeholder=" ">
                                @if ( $errors->has('name') )
                                <div class="text-danger">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="gender">Giới tính</label><br>
                                <input type="radio" name="gender" id="gender" value="0" checked="checked"><label for="0">Nữ</label>
                                <input type="radio" name="gender" id="gender" value="1" ><label for="1">Nam</label>
                            </div>
                            <div class="mb-3">
                                <label for="address">Địa chỉ</label>
                                <input name="address" id="address" type="text" class="form-control "  placeholder="vd: Đường.../Phường.../Thành phố">
                                @if ( $errors->has('address') )
                                <div class="text-danger">
                                    {{ $errors->first('address') }}
                                </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="image">Avatar</label>
                                <input name="image" id="image" type="file" class="form-control btn-sm">
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1">Kích hoạt</option>
                                    <option value="2">Chưa kích hoạt</option>

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
                                <i class="fas fa-save"></i> Save[Thêm]
                            </button>
                            <a class="btn btn-sm btn-info" href="{{ route('customer.index')  }}">
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