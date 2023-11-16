@extends('layouts.admin')
@section('title',$title??'CHI TIẾT')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chi tiết danh mục</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index')  }}">Bảng điều khiển</a></li>
                        <li class="breadcrumb-item active">Chi tiết danh mục</li>
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
                            <a class="btn btn-sm btn-info" href="{{ route('user.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>                            
                            <a class="btn btn-sm btn-primary" href="{{ route('user.edit',['user'=>$row->id]) }}">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('user.trash',['user'=>$row->id]) }}">
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
                            <th>Name</th>
                            <td>{{ $row->name }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $row->slug }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{ $row->username }}</td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>{{ $row->password }}</td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td>{{ $row->gender }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $row->phone }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $row->email }}</td>
                        </tr>
                        <tr>
                            <th>Avatar</th>
                            <td class="index-img">
                                <img src="../public/images/user/{{ $row->image }}" class="card-img-top index-img" alt="{{ $row->image }}">
                            </td>
                        </tr>
                        <tr>
                            <th>Roles</th>
                            <td>{{ $row->roles }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $row->address }}</td>
                        </tr>
                        <tr>
                            <th>Ngày tạo</th>
                            <td>{{ $row->created_at }}</td>
                        </tr>
                        <tr>
                            <th>Người tạo</th>
                            <td>{{ $row->created_by }}</td>
                        </tr>
                        <tr>
                            <th>Ngày sửa cuối</th>
                            <td>{{ $row->updated_at }}</td>
                        </tr>
                        <tr>
                            <th>Người sửa cuối</th>
                            <td>{{ $row->updated_by }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái</th>
                            <td>{{ $row->status }}</td>
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
                            
                            <a class="btn btn-sm btn-info" href="{{ route('user.index') }}">
                                <i class="fas fa-arrow-circle-left"></i> Quay về danh sách
                            </a>                            
                            <a class="btn btn-sm btn-primary" href="{{ route('user.edit',['user'=>$row->id]) }}">
                                <i class=" fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger" href="{{ route('user.trash',['user'=>$row->id]) }}">
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