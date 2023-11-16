@extends('layouts.admin')
@section('title','TẤT CẢ SẢN PHẨM')
@section('content')
<form action="{{ route('product.update',['product'=> $row->id]) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>SỬA SẢN PHẨM</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index')  }}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Sửa sản phẩm</li>
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
                            <a class="btn btn-sm btn-info" href="{{ route('product.index')  }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="name">Tên sản phẩm</label>
                                <input name="name" id="name" type="text" class="form-control " placeholder="Tên sản phẩm" value="{{ old('name',$row->name) }}">
                                @if ( $errors->has('name') )
                                <div class="text-danger">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="detail">Chi tiết</label>
                                <textarea name="detail" id="detail" cols="10" rows="2" class="form-control " placeholder="Chi tiết" value="">{{ old('detail',$row->detail) }}</textarea>
                                @if ( $errors->has('detail') )
                                <div class="text-danger">
                                    {{ $errors->first('detail') }}
                                </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả</label>
                                <textarea name="metadesc" id="metadesc" cols="10" rows="2" class="form-control " placeholder="Mô tả" value="">{{ old('metadesc',$row->metadesc) }}</textarea>
                               
                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khóa</label>
                                <textarea name="metakey" id="metakey" cols="10" rows="2" class="form-control " placeholder="Từ khóa" value="">{{ old('metakey',$row->metakey) }}</textarea>
                                 

                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="mb-3">
                                <label for="category_id">Danh mục</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="{{ old('category_id',$row->category_id) }}">--chon danh mục--</option>
                                    {{!!$html_category_id!!}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="brand_id">Brand</label>
                                <select name="brand_id" id="brand_id" class="form-control">
                                    <option value="{{ old('brand_id',$row->brand_id) }}">--chon thương hiệu--</option>
                                    {{!!$html_brand_id!!}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="qty">Số lượng </label>
                                <input name="qty" id="qty" type="number" class="form-control " value="1" min="1">
                            </div>
                            <div class="mb-3">
                                <label for="price">Giá</label>
                                <input name="price" id="price" type="number" class="form-control" value="1000" min="1000" step="500">
                            </div>
                            <div class=" mb-3">
                                <label for="price_sale">Giá khuyến mãi</label>
                                <input name="price_sale" id="price_sale" type="number" class="form-control ">
                            </div>
                            <div class="mb-3">
                                <label for="image">Hình ảnh</label>
                                <input name="image" id="image" type="file"  class="form-control btn-sm">
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" <?= ($row->status == 1) ? 'selected' : ''; ?>>Xuất bản</option>
                                    <option value="2" <?= ($row->status == 2) ? 'selected' : ''; ?>>Chưa xuất bản</option>
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
    
</form>
@endsection