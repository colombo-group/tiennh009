@extends('admin.layout.index')

@section('content')        
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể loại
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên thể loại</th>
                                <th>Tên không dấu</th>
                                <th>Thể loại cha</th>
                                <!-- <th>Xóa</th> -->
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category as $cate)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$cate->id}}</td>
                                    <td>{{$cate->name}}</td>
                                    <td>{{$cate->unsigned_name}}</td>
                                    <td>
                                        @if($cate->parent_cate_id != NULL)
                                            @foreach($category as $c)
                                                @if($c->id == $cate->parent_cate_id)
                                                    {{$c->name}}
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <!-- <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/category/delete/{{$cate->id}}"> Xóa</a></td> -->
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/category/edit/{{$cate->id}}">Sửa</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection
