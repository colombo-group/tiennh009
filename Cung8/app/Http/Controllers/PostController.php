<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use App\User;

use App\Category;

use App\Comment;

use Auth;

class PostController extends Controller
{
    //
    public function getList()
    {	
    	$post = Post::all();
    	return view('admin.post.list', [
    			'post' => $post
    		]);
    }

    public function getAdd()
    {	
    	$category = Category::all();
    	return view('admin.post.add', [
    			'category' => $category,
    		]);
    }

    public function getEdit($id)
    {   
        $post = Post::find($id);
        $category = Category::all();
  
    	return view('admin.post.edit', [
    			'post' => $post,
                'category' => $category,
            ]);
    }

    public function postAdd(Request $request)
    {	
    	$this->validate($request,
            [
                'category' => 'required',
                'title' => 'required|min:3|max:80|unique:posts,title',
                'summary' => 'required',
                'content' => 'required'
            ],
            [   
            	'category.required' => 'Bạn chưa chọn thể loại',
            	'title.required' => 'Bạn chưa nhập tiêu đề',
            	'title.min' => 'Tiêu đề phải có ít nhất 3 kí tự',
            	'title.max' => 'Tiêu đề phải ngắn hơn 80 kí tự',
            	'title.unique' => 'Tiêu đề đã tồn tại',
            	'summary.required' => 'Bạn chưa nhập tóm tắt',
            	'content.required' => 'Bạn chưa nhập nội dung', 
            ]);

        $post = new Post;
        $post->title = $request->title;
        $post->unsigned_title = changeTitle($request->title);
        $post->cate_id = $request->category;
        $post->summary = $request->summary;
        $post->slide = $request->slide;
        $post->user_id = Auth::user()->id;
        $post->content = $request->content;

        if($request->hasFile('image'))
        {
        	$file = $request->file('image');
        	$ext = $file->getClientOriginalExtension();
        	if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
        		$name = changeTitle($file->getClientOriginalName());
	        	$name = str_random(4)."_".$name;
	        	while (file_exists("upload/".$name)) 
	        	{
	        		$name = str_random(4)."_".$name;
	        	}

	        	$file->move("upload/", $name);
	        	$post->image = $name;
        	}
        	else
        	{
        		return redirect('admin/post/add')->with('loi', 'Bạn chỉ được chọn file có đuôi jpg, png, gif');
        	}
        	
        }
        else
       	{
       		return redirect('admin/post/add')->with('loi', 'Bạn chưa chọn hình');
       	}

        $post->save();

        return redirect('admin/post/add')->with('thongbao', 'Thêm thành công');
    }

    public function postEdit(Request $request, $id)
    {	
    	$post = Post::find($id);
        $this->validate($request,
            [
                'title' => 'required|min:3|max:80|unique:posts,title,'.$post->id,
                'summary' => 'required',
                'content' => 'required',
            ],
            [   
            	'title.required' => 'Bạn chưa nhập tiêu đề',
            	'title.min' => 'Tiêu đề phải có ít nhất 3 kí tự',
            	'title.max' => 'Tiêu đề phải ngắn hơn 80 kí tự',
            	'title.unique' => 'Tiêu đề đã tồn tại',
            	'summary.required' => 'Bạn chưa nhập tóm tắt',
            	'content.required' => 'Bạn chưa nhập nội dung', 
            ]);

        $post->title = $request->title;
        $post->unsigned_title = changeTitle($request->title);
        $post->cate_id = $request->category;
        $post->summary = $request->summary;
        $post->slide = $request->slide;
        $post->user_id = Auth::user()->id;
        $post->content = $request->content;

        if($request->hasFile('image'))
        {
        	$file = $request->file('image');
        	$ext = $file->getClientOriginalExtension();
        	if($ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
        		$name = $file->getClientOriginalName();
	        	$name = str_random(4)."_".$name;
	        	while (file_exists("upload/".$name)) 
	        	{
	        		$name = str_random(4)."_".$name;
	        	}
	        	unlink("upload/".$post->image);
	        	$file->move("upload/", $name);
	        	$post->image = $name;
        	}
        	else
        	{
        		return redirect('admin/post/edit/'.$id)->with('loi', 'Bạn chỉ được chọn file có đuôi jpg, png, gif');
        	}
        	
        }
      
        $post->save();

        return redirect('admin/post/edit/'.$id)->with('thongbao', 'Sửa thành công');
    }

    // public function getDelete($id)
    // {
    //     $post = Post::find($id);
    //     //xoa cac cmt lien quan
    //     $comment = $post->comment();
    //     $comment->delete();
    //     $post->delete();

    //     return redirect('admin/post/list')->with('thongbao', 'Bạn đã xóa thành công');
    // }
}
