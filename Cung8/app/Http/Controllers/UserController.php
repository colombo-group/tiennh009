<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Comment;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function getList()
    {	
    	$user = User::all();
    	return view('admin.user.list', [
    			'user' => $user
    		]);
    }

    public function getAdd()
    {
    	return view('admin.user.add');
    }

    public function getEdit($id)
    {   
        $user = User::find($id);
    	return view('admin.user.edit', [
                'user' => $user
            ]);
    }

    public function postAdd(Request $request)
    {	
    	$this->validate($request,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'            
            ],
            [   'name.required' => 'Bạn chưa nhập tên người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
                'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
            ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = $request->level;

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            if($ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
                $name = $file->getClientOriginalName();
                $name = str_random(4)."_".$name;
                while (file_exists("upload/".$name)) 
                {
                    $name= str_random(4)."_".$name;
                }

                $file->move("upload/", $name);
                $user->avatar = $name;
            }
            else
            {
                return redirect('admin/user/add')->with('loi', 'Bạn chỉ được chọn file có đuôi jpg, png, gif');
            }
            
        }
        else
        {
            $user->avatar = "";
        }

        $user->save();

        return redirect('admin/user/add')->with('thongbao', 'Thêm thành công');
    }

    public function postEdit(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate($request,
            [
                'name' => 'required|min:3',            
            ],
            [   'name.required' => 'Bạn chưa nhập tên người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
            ]);

        $user->name  = $request->name;
        $user->level = $request->level;

        if($request->changePassword == 'on')
        {
        	$this->validate($request,
            [
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'            
            ],
            [   
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
                'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
            ]);

            $user->password = bcrypt($request->password);
        }
        
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            if($ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
                $name = $file->getClientOriginalName();
                $name = str_random(4)."_".$name;
                while (file_exists("upload/".$name)) 
                {
                    $name= str_random(4)."_".$name;
                }
                if($user->avatar != "")
                    unlink("upload/".$user->avatar);
                $file->move("upload/", $name);
                $user->avatar = $name;
            }
            else
            {
                return redirect('admin/user/edit')->with('loi', 'Bạn chỉ được chọn file có đuôi jpg, png, gif');
            }
            
        }

        $user->save();

        return redirect('admin/user/edit/'.$id)->with('thongbao', 'Bạn đã sửa thành công');
    }

    // public function getDelete($id)
    // {
    //     $user = User::find($id);
    //     //xoa cac cmt lien quan cua nguoi dung
    //     $comment = $user->comment();
    //     $comment->delete();
    //     //xoa cac bai viet lien quan cua nguoi dung
    //     $post = $user->post();
    //     $post->delete();
    //     if($user->avatar != "")
    //         unlink("upload/".$user->avatar);
    //     $user->delete();

    //     return redirect('admin/user/list')->with('thongbao', 'Bạn đã xóa thành công');
    // }

    public function getLoginAdmin()
    {
    	return view('admin.login');
    }

    public function postLoginAdmin(Request $request)
    {
    	$this->validate($request, 
    		[
    			'email' => 'required|email',
    			'password' => 'required|min:3|max:32'
    		], 
    		[	'email.required' => 'Bạn chưa nhập email',
    			'email.email' => 'Email không đúng định dạng',
    			'password.required' => 'Bạn chưa nhập password',
    			'password.min' => 'Độ dài password không được nhỏ hơn 3',
    			'password.max' => 'Độ dài password không được lớn hơn 32'
    		]);

    	if(Auth::attempt(['email' => $request->email, 'password'=>$request->password]))
    	{
    		return redirect('admin/user/list');
    	}
    	else
    	{
    		return redirect('admin/login')->with('loi', 'Đăng nhập thất bại'); 
    	}

    }

    public function getLogoutAdmin()
    {
    	Auth::logout();
    	return redirect('admin/login');
    }

    public function getLogin() 
    {
        return view('pages.login');   
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, 
            [
                'email' => 'required|email',
                'password' => 'required|min:3|max:32'
            ], 
            [   'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Email không đúng định dạng',
                'password.required' => 'Bạn chưa nhập password',
                'password.min' => 'Độ dài password không được nhỏ hơn 3',
                'password.max' => 'Độ dài password không được lớn hơn 32'
            ]);

        if(Auth::attempt(['email' => $request->email, 'password'=>$request->password]))
        {
            return redirect('home');
        }
        else
        {
            return redirect('login')->with('loi', 'Đăng nhập thất bại'); 
        }

    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('home');
    }

    public function getSignup()
    {
        return view('pages.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'            
            ],
            [   'name.required' => 'Bạn chưa nhập tên người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 3 ký tự',
                'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
            ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 0;

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            if($ext == 'jpg' || $ext == 'png' || $ext == 'gif') {
                $name = $file->getClientOriginalName();
                $name = str_random(4)."_".$name;
                while (file_exists("upload/".$name)) 
                {
                    $name= str_random(4)."_".$name;
                }

                $file->move("upload/", $name);
                $user->avatar = $name;
            }
            else
            {
                return redirect('signup')->with('loi', 'Bạn chỉ được chọn file có đuôi jpg, png, gif');
            }
            
        }
        else
        {
            $user->avatar = "";
        }

        $user->save();

        return redirect('signup')->with('thongbao', 'Đăng kí thành công');
    }
    
}
