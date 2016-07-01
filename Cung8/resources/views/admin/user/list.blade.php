@extends('admin.layout.index')

@section('content')        
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
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
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Level</th>
                                <!-- <th>Xóa</th> -->
                                <th>Sửa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $u)
                            <tr class="odd gradeX" align="center">
                                <td>{{$u->id}}</td>
                                <td>
                                    @if($u->avatar != "")
                                        @if($u->password != "")
                                            <img width="128px" height="128px" src="upload/{{$u->avatar}}">
                                        @else
                                            <img width="128px" height="128px" src="{{$u->avatar}}">
                                        @endif    
                                    @else
                                        <img src="upload/user.png">    
                                    @endif
                                </td>
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                <td>
                                    @if($u->level == 1)
                                        {{"Admin"}}
                                    @else
                                        {{"Thường"}}
                                    @endif   
                                </td>
                                <!-- <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/user/delete/{{$u->id}}"> Xóa</a></td> -->
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/edit/{{$u->id}}">Sửa</a></td>
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
