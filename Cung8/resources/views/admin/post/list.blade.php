@extends('admin.layout.index')

@section('content')        
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
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
                                <th>Tiêu đề</th>
                                <th>Tóm tắt</th>
                                <th>Thể loại</th>
                                <th>Nội dung</th>
                                <th>Lượt xem</th>
                                <th>Nổi Bật</th>
                                <!-- <th>Xóa</th> -->
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($post as $p)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$p->id}}</td>
                                    <td><div>{{$p->title}}</div>
                                    <img width="100px" height="50px" src="upload/{{$p->image}}">
                                    </td>
                                    <td>{{$p->summary}}</td>
                                    <td>{{$p->category->name}}</td>
                                    <td>{{$p->content}}</td>
                                    <td>{{$p->view}}</td>
                                    <td>
                                        @if($p->slide == 1)
                                            {{"Có"}}
                                        @else
                                            {{"Không"}}    
                                        @endif
                                    </td>
                                   <!--  <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/post/delete/{{$p->id}}"> Xóa</a></td> -->
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/post/edit/{{$p->id}}">Sửa</a></td>
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
