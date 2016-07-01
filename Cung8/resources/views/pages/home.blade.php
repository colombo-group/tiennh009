@extends('templates.layout')
<link rel="stylesheet" href="{{ asset('css/home.css')}}">
@section('content')
<div id="sliderBar">
			<div class="center">
		        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				    <!-- Wrapper for slides -->
				    <div class="carousel-inner">
					    <?php 
					    	$data = clone $post ;
					    ?>

					    <div class="item active">
					    @for($i = 0; $i < 4; $i++)
					    	<?php 
					    		$p = $data->shift();
					    		while ($p->slide == 0) {
					    			$p = $data->shift();
					    		}
					    	?>
					            <div class="thumbnail"> 
					                <img src="upload/{{$p->image}}">
					                <a href="" title="{{$p->title}}">
					                	<div class="opacity"></div>
					                </a>
					                <a href="" title="{{$p->category->name}}">
					                	<p>{{mb_strtoupper($p->category->name, 'utf8')}}</p>
					                </a>
					                <a href="" title="{{$p->title}}">
					                	<span>{{$p->title}}</span>
					                </a>
					            </div>

					    @endfor
					    </div>
					    @for($i = 0; $i < 4; $i++)
					    	<?php 
						    	$data = clone $post ;
						    	for($k = 0; $k <= $i; $k++)
						    	{
						    		$p = $data->shift();
						    		while ($p->slide == 0) {
						    			$p = $data->shift();
						    		}
						    	}
						    ?>
					    	<div class="item">
					    		@for($j = 0; $j < 4; $j++)
					    			<?php 
							    		$p = $data->shift();
								    		while ($p->slide == 0) {
						    			$p = $data->shift();
						    		}
							    	?>

							    	<div class="thumbnail"> 
						                <img src="upload/{{$p->image}}">
						                <a href="" title="{{$p->title}}">
						                	<div class="opacity"></div>
						                </a>
						                <a href="" title="{{$p->category->name}}">
						                	<p>{{mb_strtoupper($p->category->name, 'utf8')}}</p>
						                </a>
						                <a href="" title="{{$p->title}}">
						                	<span>{{$p->title}}</span>
						                </a>
						            </div>
					    		@endfor
					    	</div>
					    @endfor     
    				</div>
    		<!-- Controls -->
		    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> </a> <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span></a>
		  </div>
		   	</div>
	    </div><!-- end of silderbar -->

	    <div id="banner">
	    	<div class="center">
	    		<div class="bannerBg"><img src="images/banner.jpg"></div>
	    	</div>
	          
	    </div><!-- end of banner -->

	    <div id="content">
	    	<div class="center">
	    		<div class="section">
	    			<div class="linkList">
	    				<?php 
	                        $data = clone $topView;
	                        	for($i = 0; $i < 3; $i++)
	                        	{
	                        		$p = $data->shift();
	                        	}
	                    ?>
	    				@for($i = 0; $i < 8; $i++)
	                        <div class="listItem">
	                        	<?php 
	                        		$p = $data->shift();
	                        	?>
	                            <div class="itemLeft">
	                                <a href="" title="{{$p->title}}"><img src="upload/{{$p->image}}"></a>
	                            </div>
	                            <div class="itemRight">
	                                <a href="" title="{{$p->title}}">{{$p->title}}</a><br>
	                                <span>{{$p->created_at}}</span>
	                            </div>
	                       	</div>
	                    @endfor   	
                    </div>

                    <div class="news">
                    <?php 
                    	$data = clone $topView;
                    	$p = $data->shift();
                    ?>
                        <a href="" title="{{$p->title}}"><img src="upload/{{$p->image}}"></a>
                        <a class="heading1" href="" title="{{$p->title}}">{{$p->title}}</a>
                        <p>{{$p->summary}}</p>
                        <div class="row newss">
                            <div class="newssLeft">
                            	<?php
                            		$p = $data->shift();
                            	?>
                                <a href="" title="{{$p->title}}"><img src="upload/{{$p->image}}"></a>

                                <a href="" title="{{$p->title}}" class="newssLeftBot">{{$p->title}}</a> 
                            </div>

                            <div class="newssRight">
                            	<?php
                            		$p = $data->shift();
                            	?>
                                <a href="" title="{{$p->title}}"><img src="upload/{{$p->image}}"></a>

                                <a href="" title="{{$p->title}}" class="newssRightBot">{{$p->title}}</a> 
                            </div> 
                        </div>
                    </div>
                </div>

                        <div class="aside">
                        	<div class="navv">
	                            <img src="images/nav.jpg">
                        	</div>

                        	<div>
                        		<img src="images/photo05.jpg">
                        	</div> 
                        </div>

                        <div class="mainNews">
                        	<?php 
                        		$cate = clone $category;
                        	?>
	                        @for($i = 0; $i < 5; $i++)
	                        	<?php 
	                        		$c = $cate->shift();
	                        		while ($c->parent_cate_id != NULL) {
	                        			$c = $cate->shift();
	                        		}
	                        	?>
		    					<div class="newsLeft">
		    						<div class="heading">
		    							<a href="" title="{{$c->name}}">{{$c->name}}</a>
		    						</div>
		    						<div class="endHeading">
		    							<img src="images/photo28.jpg">
		    						</div>
		    						<?php
		    							$data = $c->post()->orderBy('updated_at', 'DESC')->get();
		    							$p = $data->shift();
		    						?>
		    						<div class="newsLeftTop">
		    							<a href="" title="{{$p->title}}"><img src="upload/{{$p->image}}"></a>
		    							<a href="" title="{{$p->title}}">{{$p->title}}</a>	
		    						</div>
		    						<div class="newsBot">
		    							<ul>
		    								@for($j = 0; $j < 3; $j++)
		    									<?php
		    										$p = $data->shift();
		    									?>
		    									<li><a href="" title="{{$p->title}}">{{$p->title}}</a></li>
		    								@endfor
		    							</ul>
		    						</div>
		    					</div>
		    					<?php 
	                        		$c = $cate->shift();
	                        		while ($c->parent_cate_id != NULL) {
	                        			$c = $cate->shift();
	                        		}
	                        	?>
		    					<div class="newsRight">
		    						<div class="heading">
		    							<a href="" title="{{$c->name}}">{{$c->name}}</a>
		    						</div>
		    						<div class="endHeading">
		    							<img src="images/photo28.jpg">
		    						</div>
		    						<?php
		    							$data = $c->post()->orderBy('updated_at', 'DESC')->get();
		    							$p = $data->shift();
		    						?>
		    						<div class="newsLeftTop">
		    							<a href="" title="{{$p->title}}"><img src="upload/{{$p->image}}"></a>
		    							<a href="" title="{{$p->title}}">{{$p->title}}</a>	
		    						</div>
		    						<div class="newsBot">
		    							<ul>
		    								@for($j = 0; $j < 3; $j++)
		    									<?php
		    										$p = $data->shift();
		    									?>
		    									<li><a href="" title="{{$p->title}}">{{$p->title}}</a></li>
		    								@endfor
		    							</ul>
		    						</div>
		    					</div>
		    				@endfor
	    				</div>
                    </div>        
	    	</div><!-- end of content  -->
@stop