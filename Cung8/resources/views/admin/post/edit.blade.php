@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>{{$post->title}}</small>
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
                    @if(session('loi'))
                        <div class="alert alert-danger">
                            {{session('loi')}}
                        </div>
                    @endif
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                        <form action="admin/post/edit/{{$post->id}}" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="category" id="category">
                                    @foreach($category as $cate)
                                        <option value="{{$cate->id}}"
                                            @if($cate->id == $post->cate_id)
                                                {{"selected"}}
                                            @endif
                                        >{{$cate->name}}</option>
                                        
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="title" placeholder="Nhập tiêu đề" value="{{$post->title}}" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea class="form-control" rows="5" name="summary">{{$post->summary}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" class="ckeditor" name="content">{{$post->content}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <p><img src="upload/{{$post->image}} " width="500px"></p>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="slide" value="0" checked="" 
                                        @if($post->slide == 0)
                                            {{"checked"}}
                                        @endif
                                    type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="slide" value="1" 
                                        @if($post->slide == 1)
                                            {{"checked"}}
                                        @endif
                                    type="radio">Có
                                </label>
                            </div>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Nhập lại</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#TheLoai").change(function() {
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai, function (data) {
                    $("#LoaiTin").html(data);
                });
            });
        })
    </script>
@endsection