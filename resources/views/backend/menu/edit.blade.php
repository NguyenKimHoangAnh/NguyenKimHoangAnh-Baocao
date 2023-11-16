@extends('layouts.admin')
@section('title',$title??'CẬP NHẬT')
@section('content')
<form action="{{ route('menu.update',['menu'=> $menu->id]) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CẬP NHẬT DANH MỤC</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index')  }}">Bảng điều khiển</a></li>
                            <li class="breadcrumb-item active">Cập nhật danh mục</li>
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
                            <a class="btn btn-sm btn-info" href="{{ route('menu.index')  }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            @if ($menu->type=='custom')
                                <div class="mb-3">
                                    <label for="name">Tên danh mục</label>
                                    <input name="name" id="name" readonly type="text" class="form-control " placeholder="Tên danh mục" value="{{ old('name',$menu->name) }}">
                                    @if ( $errors->has('name') )
                                    <div class="text-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="link">Liên kết</label>
                                    <input name="link" id="link" readonly type="text" class="form-control " placeholder="Liên kết" value="{{ old('name',$menu->link) }}">
                                    @if ( $errors->has('link') )
                                    <div class="text-danger">
                                        {{ $errors->first('link') }}
                                    </div>
                                    @endif
                                </div>        
                            @else                            
                                <div class="mb-3">
                                    <label for="name">Tên Menu</label>
                                    <input name="name" id="name" type="text" class="form-control " placeholder="Tên danh mục" value="{{ old('name',$menu->name) }}">
                                    @if ( $errors->has('name') )
                                    <div class="text-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="link">Liên kết</label>
                                    <input name="link" id="link" type="text" class="form-control " placeholder="Liên kết" value="{{ old('name',$menu->link) }}">
                                    @if ( $errors->has('link') )
                                    <div class="text-danger">
                                        {{ $errors->first('link') }}
                                    </div>
                                    @endif
                                </div>    
                            @endif
                                                  
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="parent_id">Menu đề cha</label>
                                <select name="parent_id" id="parent_id" class="form-control">
                                    <option value="0">--chon chủ đề--</option>
                                    {{!!$html_parent_id!!}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="sort_order">Vị trí</label>
                                <select name="sort_order" id="sort_order" class="form-control">
                                    <option value="0">--chon vị trí--</option>
                                    {{!!$html_sort_order!!}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ ($menu->status == 1) ? 'selected' : ''; }}>Xuất bản</option>
                                    <option value="2" {{ ($menu->status == 2) ? 'selected' : ''; }}>Chưa xuất bản</option>    
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
                            <a class="btn btn-sm btn-info" href="{{ route('category.index')  }}">
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