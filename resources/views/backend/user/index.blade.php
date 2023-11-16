@extends('layouts.admin')
@section('title', $title ?? 'trang quản lý')
@section('header')

@endsection
@section('content')
    <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="text-transform: uppercase;">{{ $title ?? 'trang quản lý' }}</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Bảng điều khiển</a></li>
                                <li class="breadcrumb-item active">Blank Page</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-sm btn-danger" type="submit" name="DELETE_ALL">
                                    <i class="fa-solid fa-trash-can"></i> Xóa đã chọn
                                </button>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="text-right">
                                    <a class="btn btn-sm btn-success" href="{{ route('user.create') }}">
                                        <i class="fas fa-plus"></i> Thêm
                                    </a>
                                    <a class="btn btn-sm btn-danger" href="{{ route('user.trash') }}">
                                        <i class="fas fa-trash" aria-hidden="true"></i> Thùng rác
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
                                    <th class="text-center" style="width:100px">Hình</th>
                                    <th style="width:150px">Tên tài khoản</th>
                                    <th style="width:150px">Email</th>
                                    <th style="width:100px">Phone</th>
                                    <th class="text-center">Ngày tạo</th>
                                    <th style="width:200px" class="text-center">Chức năng</th>
                                    <th class="text-center" style="width:20px">ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $row)
                                    <tr>
                                        <td class="text-center" style="width:20px">
                                            <input type="checkbox">
                                        </td>
                                        <td class="index-img">
                                            <img src="{{ asset('images/user/'.$row->image) }}" class="card-img-top index-img" alt="{{ $row->image }}">
                                        </td>
                                        <td>
                                            {{ $row->name }}
                                        </td>
                                        <td>
                                            {{ $row->email }}
                                        </td>
                                        <td>
                                            {{ $row->phone }}
                                        </td>
    
                                        <td class="text-center">
                                            {{ $row->created_at }}
                                        </td>
                                        <td class="text-center">
                                            @if ($row->status==1)
                                            <a class="btn btn-sm btn-success" href="{{ route('user.status',['user'=>$row->id]) }}">
                                                <i class="fas fa-toggle-on"></i>
                                            </a>
                                            @else
                                            <a class="btn btn-sm btn-danger" href="{{ route('user.status',['user'=>$row->id]) }}">
                                                <i class="fas fa-toggle-on"></i>
                                            </a>
                                            @endif
                                            <a class="btn btn-sm btn-info" href="{{ route('user.show',['user'=>$row->id]) }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="btn btn-sm btn-primary" href="{{ route('user.edit',['user'=>$row->id]) }}">
                                                <i class=" fas fa-edit"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="{{ route('user.delete',['user'=>$row->id]) }}" method="GET">
                                                @method('DELETE')
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
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-sm btn-danger" type="submit" name="DELETE_ALL">
                                    <i class="fa-solid fa-trash-can"></i> Xóa đã chọn
                                </button>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="text-right">
                                    <a class="btn btn-sm btn-success" href="{{ route('user.create') }}">
                                        <i class="fas fa-plus"></i> Thêm
                                    </a>
                                    <a class="btn btn-sm btn-danger" href="{{ route('user.trash') }}">
                                        <i class="fas fa-trash" aria-hidden="true"></i> Thùng rác
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </section>
        </div>
    </form>
@endsection
@section('footer')

@endsection
