<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link href="{{ asset('bootstrap-3.3.6-dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/layout.css')}}">
	<title>Nơi dành riêng cho phái yếu</title>
</head>
<body>
	<div id="layout">
		<div id="header">
			<div class="center">
				<div class="search">
					<input type="text" placeholder="Tìm kiếm">
					<a href=""><img src="images/icon/search.png"></a>  	
				</div>

				<div class="logo">
                    <a href="home" title="Cung8"><img src="images/logo.png"></a>
                </div>

                <div class="text-right icon">
                    <ul class="list-inline">
						<li><a href="" title="Facebook"><img src="images/icon/facebook.png"></a></li>
                        <li><a href="" title="Twitter"><img src="images/icon/twitter.png"></a></li>
                        <li><a href="" title="Google"><img src="images/icon/google.png"></a></li>
                        <li><a href="" title="Youtube"><img src="images/icon/youtube.png"></a></li>
                    </ul>
                    <div class="contact">   
                        @if(isset($user_login))
                            <span>{{$user_login->name}}</span>
                        @else
                            {!!'<a href="login" title="Đăng nhập">Đăng nhập</a>'!!}
                        @endif
                        <a href="logout" title="Đăng xuất" class="ctRight">Đăng xuất</a>
                    </div> 
                </div>

                <div class="menu">
                	<ul>
                            <li>
                                <a href="home" title="Trang chủ"><span class="glyphicon glyphicon-home"></span> TRANG CHỦ</a>
                                <span class="borderMenu"></span>    
                            </li>
                            <?php $data = clone $category;?>
                            @for($i = 0; $i < 8; $i++)
                                <?php
                                    $cate = $data->shift();
                                    while ($cate->parent_cate_id != NULL) {
                                        $cate = $data->shift();
                                    } 
                                     
                                ?>
                               
                                <li>
                                    <a href="#" title="{{$cate->name}}">{{mb_strtoupper($cate->name, 'utf8')}}</a>
                                    <span class="borderMenu"></span> 
                                    <ul class="sub-menu">
                                        @foreach($category as $ct)
                                            @if($cate->id == $ct->parent_cate_id)
                                                <li><a href="" title="{{$ct->name}}">{{mb_strtoupper($ct->name, 'utf8')}}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                
                            @endfor
                            <li>
                                <a href="#">XEM THÊM</a>
                                <span class="borderMenu"></span>
                                <ul class="sub-menu">
                                    @while(count($data) > 0)
                                        <?php $cate = $data->shift(); ?>
                                        @if($cate->parent_cate_id == NULL)
                                            <li><a href="" title="{{$cate->name}}">{{mb_strtoupper($cate->name, 'utf8')}}</a></li>
                                        @endif
                                    @endwhile
                                </ul>
                            </li>
                        </ul>        
                </div>
			</div>
		</div><!-- end of header -->

		@yield('content')

	    	<div id="footer">
	    		<div class="center">
	    			<div class="menuFt">
	    				<ul>
                            <li>
                                <a href="home" title = "Trang chủ">TRANG CHỦ</a>
                            </li>
                            <?php $data = clone $category;?>
                            @for($i = 0; $i < 9; $i++)
                                <?php
                                    $cate = $data->shift();
                                    while ($cate->parent_cate_id != NULL) {
                                        $cate = $data->shift();
                                    } 
                                     
                                ?>
                               
                                <li>
                                    <a href="#" title="{{$cate->name}}">{{mb_strtoupper($cate->name, 'utf8')}}</a>
                                </li>
                                
                            @endfor
                        </ul>	
	    			</div>

	    			<div class="logoFt">
	    				<a href="home"><img src="images/logo.png"></a>
	    			</div>

	    			<div class="copyright">
	    				@Copyright 2016 Cung8.com, All rights reserved.  
	    			</div>
	    		</div>	
	    	</div><!-- end of footer -->
	</div><!-- end of layout -->
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{ asset('bootstrap-3.3.6-dist/js/jquery-2.2.4.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('bootstrap-3.3.6-dist/js/bootstrap.min.js')}}"></script>
</body>
</html>