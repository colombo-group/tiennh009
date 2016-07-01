@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể loại
                            <small>{{$category->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                        <form action="admin/category/edit/{{$category->id}}" method="POST">   
                            <div class="form-group">
                                <label>Tên thể loại</label>
                                <input class="form-control" name="name" placeholder="Nhập tên thể loại" value="{{$category->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Thể loại cha</label>
                                <select class="form-control" name="parent">
                                    <option value="-1">Chọn thể loại</option>
                                    @foreach($categories as $cate)
                                        @if($cate->parent_cate_id == NULL)
                                            <option value="{{$cate->id}}"
                                            @if($cate->id == $category->parent_cate_id)
                                                {{"selected"}}
                                            @endif
                                            >{{$cate->name}}</option>
                                        @endif
                                    @endforeach
                                    
                                </select>
                            </div>
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Nhập lại</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection