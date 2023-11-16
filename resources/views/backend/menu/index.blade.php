@extends('layouts.admin')
@section('title', 'cacacac')
@section('content')
<form action="{{ route('menu.store') }}" method="POST">
    @csrf
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>MENU</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index')  }}">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Menu</li>
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
                        <button class="btn btn-sm btn-danger" type="submit" name="">
                            <i class="fas fa-trash"></i> Xóa đã chọn
                        </button>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="text-right">
                            <a class="btn btn-sm btn-success" href="#">
                                <i class="fas fa-plus"></i> Thêm
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('menu.trash') }}">
                                <i class="fas fa-trash"></i> Thùng rác
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="accordion" id="accordionExample">
                            <div class="card Position">
                                <div class="card-body">
                                    <label>Vị trí</label>
                                    <select name="position" id="" class="form-control">
                                        <option value="mainmenu">Main Menu</option>
                                        <option value="footermenu">Footer Menu</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end card Position -->
                            <div class="card">
                                <div class="card-header" id="headingCategory">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                                            DANH MỤC SẢN PHẨM
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory" data-parent="#accordionExample">
                                    <div class="card-body">
                                        @foreach ($list_category as $category)
                                        <div class="form-check">
                                            <input class="form-check-input" name="checkIdCategory[]" type="checkbox" value="{{ $category->id }}" id="defaultCheck{{ $category->id }}">
                                            <label class="form-check-label" for="defaultCheck{{ $category->id }}">
                                                {{ $category->name }}
                                            </label></br>
                                        </div>
                                        @endforeach
                                        <div class="mt-3">
                                            <input type="submit" name="AddCategory" value="thêm menu" class="btn btn-sm btn-success form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card category -->
                            <div class="card">
                                <div class="card-header" id="headingBrand">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseBrand" aria-expanded="false" aria-controls="collapseBrand">
                                            THƯƠNG HIỆU
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseBrand" class="collapse" aria-labelledby="headingBrand" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="form-check">
                                            @foreach ($list_brand as $brand)
                                            <input class="form-check-input" name="checkIdBrand[]" type="checkbox" value="{{ $brand->id }}" id="defaultCheck{{ $brand->id }}">
                                            <label class="form-check-label" for="defaultCheck{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </label></br>
                                            @endforeach
                                        </div>
                                        <div class="mt-3">
                                            <input type="submit" name="AddBrand" value="thêm menu" class="btn btn-sm btn-success form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card brand -->
                            <div class="card">
                                <div class="card-header" id="headingTopic">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTopic" aria-expanded="false" aria-controls="collapseTopic">
                                            CHỦ ĐỀ BÀI VIẾT
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTopic" class="collapse" aria-labelledby="headingTopic" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="form-check">
                                            @foreach ($list_topic as $topic)
                                            <input class="form-check-input" name="checkIdTopic[]" type="checkbox" value="{{ $topic->id }}" id="defaultCheck{{ $topic->id }}">
                                            <label class="form-check-label" for="defaultCheck{{ $topic->id }}">
                                                {{ $topic->name }}
                                            </label></br>
                                            @endforeach
                                        </div>
                                        <div class="mt-3">
                                            <input type="submit" name="AddTopic" value="thêm menu" class="btn btn-sm btn-success form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card topic -->
                            <div class="card">
                                <div class="card-header" id="headingPage">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapsePage" aria-expanded="false" aria-controls="collapsePage">
                                            TRANG ĐƠN
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="form-check">
                                            @foreach ($list_page as $page)
                                            <input class="form-check-input" name="checkIdPage[]" type="checkbox" value="{{ $page->id }}" id="defaultCheck{{ $page->id }}">
                                            <label class="form-check-label" for="defaultCheck{{ $page->id }}">
                                                {{ $page->title }}
                                            </label></br>
                                            @endforeach
                                        </div>
                                        <div class="mt-3">
                                            <input type="submit" name="AddPage" value="thêm menu" class="btn btn-sm btn-success form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card page -->
                            <div class="card">
                                <div class="card-header" id="headingCustom">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseCustom" aria-expanded="false" aria-controls="collapseCustom">
                                            TÙY BIẾN LIÊN KẾT
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseCustom" class="collapse" aria-labelledby="headingCustom" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label>Tên menu</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Link</label>
                                            <input type="text" name="link" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <input type="submit" name="AddCustom" value="thêm menu" class="btn btn-sm btn-success form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card custom -->
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body">
                                @includeIf('backend.messageAlert', ['some' => 'data'])
                                <table class="table table-bordered" id="myTable">
                                    <thead class="bg-orange">
                                        <tr>
                                            <th class="text-center" style="width:20px"><input type="checkbox"></th>

                                            <th class="text-center" style="width:450px">Tên menu/Liên kết</th>
                                            <th class="text-center" style="width:100px">Vị trí</th>
                                            <th class="text-center" style="width:100px">Sắp xếp</th>
                                            <th class="text-center" style="width:200px">Chức năng</th>
                                            <th class="text-center" style="width:20px">ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($list_menu as $row)
                                            <tr>
                                                <td class="text-center" style="width:20px">
                                                    <input type="checkbox">
                                                </td>

                                                <td>
                                                    <strong>{{ $row->name }}</strong>
                                                </br>
                                                    {{ $row->link }}
                                                </td>
                                                <td>
                                                    {{ $row->position }}
                                                </td>

                                                <td class="text-center">
                                                    
                                                </td>
                                                <td class="text-center">
                                                    @if ($row->status==1)
                                                    <a class="btn btn-sm btn-success" href="{{ route('menu.status',['menu'=>$row->id]) }}">
                                                        <i class="fas fa-toggle-on"></i>
                                                    </a>
                                                    @else
                                                    <a class="btn btn-sm btn-danger" href="{{ route('menu.status',['menu'=>$row->id]) }}">
                                                        <i class="fas fa-toggle-on"></i>
                                                    </a>
                                                    @endif
                                                    <a class="btn btn-sm btn-info" href="{{ route('menu.show',['menu'=>$row->id]) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-primary" href="{{ route('menu.edit',['menu'=>$row->id]) }}">
                                                        <i class=" fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-sm btn-danger" href="{{ route('menu.delete',['menu'=>$row->id]) }}" method="GET">
                                                        
                                                        @csrf
                                                        <i class=" fas fa-trash"></i>
                                                    </a>                                
                                                </td>
                                                <td class="text-center" style="width:20px">
                                                    {{ $row->id }}
                                                </td>
                                            </tr>

                                            @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-sm btn-danger" href="index.php?option=product&cat=trash">
                            <i class="fas fa-trash" aria-hidden="true"></i> Xóa
                        </a>
                    </div>
                    <div class="col-md-6 text-right">
                        <a class="btn btn-sm btn-success" href="index.php?option=product&cat=create">
                            <i class="fas fa-plus"></i> Thêm
                        </a>
                        <a class="btn btn-sm btn-danger" href="index.php?option=product&cat=trash">
                            <i class="fas fa-trash"></i> Thùng rác
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