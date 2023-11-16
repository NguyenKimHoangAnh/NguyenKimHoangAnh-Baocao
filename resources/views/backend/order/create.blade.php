@extends('layouts.admin')

@section('title', $title)
@section('content')
@endphp
@endphp
<form action="{{ route('order.store') }}" method="post" enctype="multipart/form-data">
  @csrf
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card-header">
          
          
        <div class="row">
          <div class="col-12 text-right">
            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i>Lưu</button>
            <a href="{{ route('order.index') }}" class="btn btn-sm btn-primary"><i class=""></i>Quay về danh sách</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-9">
            <div class="mb-3">
              <label for="code">Code</label>
              <textarea type="number" name="code" id="code" class="form-control" value="{{  old('code') }}" class="form-control"></textarea>
              @if ($errors ->has('code'))
              <div class="text-danger">
                {{ $errors->first('code') }}
              </div>
              @endif
            </div>
            <div class="mb-3">
              <label for="user_id">Mã khách hàng</label>
              <textarea type="number" name="user_id" id="user_id" class="form-control" value="{{  old('user_id') }}" class="form-control"></textarea>
              @if ($errors ->has('user_id'))
              <div class="text-danger">
                {{ $errors->first('user_id') }}
              </div>
              @endif
            </div>
            <div class="mb-3">
              <label for="deliveryaddress">Địa chỉ người nhận</label>
              <textarea type="text" name="deliveryaddress" id="deliveryaddress" class="form-control" value="{{  old('deliveryaddress') }}" class="form-control"></textarea>
              @if ($errors ->has('deliveryaddress'))
              <div class="text-danger">
                {{ $errors->first('deliveryaddress') }}
              </div>
              @endif
            </div>
            <div class="mb-3">
              <label for="deliveryname">Tên người nhận</label>
              <input type="text" name="deliveryname" id="deliveryname" value="{{  old('deliveryname') }}" class="form-control">
              @if ($errors->has('deliveryname'))
                 <div class="text-danger">
                    {{ $errors->first('deliveryname') }}
                 </div>
               @endif
            </div>
            <div class="mb-3">
              <label for="deliveryphone">Phone Người Nhận</label>
              <textarea type="tel" name="deliveryphone" placeholder="0912345678" pattern="[0-9]{4}[0-9]{3}[0-9]{3}" id="deliveryphone" value="{{  old('deliveryphone') }}" class="form-control"></textarea>
              @if ($errors ->has('deliveryphone'))
              <div class="text-danger">
                {{ $errors->first('deliveryphone') }}
              </div>
              @endif
            </div>
            <div class="mb-3">
              <label for="deliveryemail">Emai Người Nhận</label>
              <textarea type="email" name="deliveryemail" id="deliveryemail" value="{{  old('deliveryemail') }}" class="form-control"></textarea>
              @if ($errors ->has('deliveryemail'))
              <div class="text-danger">
                {{ $errors->first('deliveryemail') }}
              </div>
              @endif
            </div>
        </div>
        <div class="col-md-3">
          <div class="mb-3">
              <label for="exportdate">Ngày xuất</label>
              <input type="datetime-local" name="exportdate" id="exportdate" class="form-control" value="{{  old('exportdate') }}" class="form-control">
              @if ($errors ->has('exportdate'))
              <div class="text-danger">
                {{ $errors->first('exportdate') }}
              </div>
              @endif
            </div>
      </div>
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
</form>
@endsection