@extends('layouts.admin')
@section('title',$title??'post')
@section('content')

<form action="{{ route('post.update',['post'=> $row->id]) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CẬP NHẬT BÀI VIẾT</h1>
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
                                <i class="fas fa-save"></i> Save[Thêm]
                            </button>
                            <a class="btn btn-sm btn-info" href="{{ route('post.index')  }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="title">Tiêu đề bài viết</label>
                                <input name="title" id="title" type="text" class="form-control "  placeholder="Tiêu đề" value="{{ old('title',$row->title) }}">
                                @if ($errors->has('title'))
                                    <div class="text-danger">
                                         {{ $errors->first('title') }}
                                    </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="detail">Chi tiết</label>
                                <textarea name="detail" id="detail" cols="10" rows="2" class="form-control "   placeholder="Chi tiết">{{ old('detail',$row->detail) }}</textarea>
                                @if ($errors->has('detail'))
                                <div class="text-danger">
                                    {{ $errors->first('detail') }}
                                </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="metadesc">Mô tả</label>
                                <textarea name="metadesc" id="metadesc" cols="10" rows="2" class="form-control "   placeholder="Mô tả">{{ old('metadesc',$row->metadesc) }}</textarea>
                                @if ($errors->has('metadesc'))
                                            <div class="text-danger">
                                                {{ $errors->first('metadesc') }}
                                            </div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="metakey">Từ khóa</label>
                                <textarea name="metakey" id="metakey" cols="10" rows="2" class="form-control "   placeholder="Từ khóa">{{ old('metakey',$row->metakey) }}</textarea>
                                @if ($errors->has('metakey'))
                                            <div class="text-danger">
                                                {{ $errors->first('metakey') }}
                                            </div>
                                @endif
                            </div>
                        </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="topic_id">Chủ đề</label>
                                    <select name="topic_id" id="topic_id"   class="form-control">
                                        <option value="">--chon chủ đề--</option>
                                        {!! $html_topic_id !!}
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="image">Hình ảnh</label>
                                    <input name="image" id="image" type="file" class="form-control btn-sm">
                                </div>
                                <div class="mb-3">
                                    <label for="status">Trạng thái</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{ ($row->status == 1) ? 'selected' : ''; }}>Xuất bản</option>
                                        <option value="2" {{ ($row->status == 2) ? 'selected' : ''; }}>Chưa xuất bản</option>    
                                    </select>
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
                            <a class="btn btn-sm btn-info" href="{{ route('post.index')  }}">
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