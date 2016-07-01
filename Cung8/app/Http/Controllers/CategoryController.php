<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

use App\Post;

class CategoryController extends Controller
{
    //
    public function getList()
    {	
    	$category = Category::all();
    	return view('admin.category.list', [
    			'category' => $category
    		]);
    }

    public function getAdd()
    {   
        $category = Category::all();
    	return view('admin.category.add', [
                'category' => $category
            ]);
    }

    public function getEdit($id)
    {   
        $categories = Category::all();
        $category = Category::find($id);
    	return view('admin.category.edit', [
                'categories' => $categories,
                'category' => $category
            ]);
    }

    public function postAdd(Request $request)
    {	
    	$this->validate($request,
            [
                'name' => 'required|unique:categories,name|min:3|max:30'
            ],
            [   'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.unique' => 'Tên thể loại đã tồn tại',
                'name.min' => 'Tên thể loại phải có độ dài từ 3 đến 30 ký tự',
                'name.max' => 'Tên thể loại phải có độ dài từ 3 đến 30 ký tự',
            ]);
        $category = new Category;
        $category->name = $request->name;
        $category->unsigned_name = changeTitle($request->name);
        if($request->parent != -1)
        {
            $category->parent_cate_id = $request->parent;
        }
        $category->save();

        return redirect('admin/category/add')->with('thongbao', 'Thêm thành công');
    }

    public function postEdit(Request $request, $id)
    {   
        $category = Category::find($id);
        $this->validate($request,
            [
                'name' => 'required|min:3|max:30|unique:categories,name,'.$category->id,
            ],
            [   'name.required' => 'Bạn chưa nhập tên thể loại',
                'name.unique' => 'Tên thể loại đã tồn tại',
                'name.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
                'name.max' => 'Tên thể loại phải có độ dài từ 3 đến 100 ký tự',
            ]);
       
        $category->name = $request->name;
        $category->unsigned_name = changeTitle($request->name);
        if($request->parent != -1)
        {
            $category->parent_cate_id = $request->parent;
        }
        $category->save();

        return redirect('admin/category/edit/'.$id)->with('thongbao', 'Sửa thành công');
    }

    // public function getDelete($id)
    // {   
    //     $category = Category::find($id);
    //     //xu ly cac bai post lien quan
    //     $post = $category->post();
    //     $post->delete();

    //     $category->delete();

    //     return redirect('admin/category/list')->with('thongbao', 'Bạn đã xóa thành công');
    // }
}
