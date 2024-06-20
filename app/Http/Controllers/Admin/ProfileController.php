<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MatchStaffOldPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $hopdongs = User::all();
        return view('admin.profile.view',[
            'title' => 'Profile',
            // 'hopdongs' => $hopdongs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // sửa danh mục
    // laravel tự tìm theo cái id truyền vào luôn nên $id này lưu dữ liệu đã selec theo mã
    public function edit(){
        // dd($id);
        return view('admin.profile.edit',[
            "title"=> "Edit profile",
        ]);
    }

    public function editPass(){
        return view('admin.profile.editpass',[
            "title"=> "Edit Pass",
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{
            $user = User::find(Auth::user()->id);
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
            ]);
            // dd($user);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();
            return response()->json(['message' => 'Update oke',
                                    'url' => '/profile'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }

    public function authPass(Request $request){
        try{
            $user = User::find(Auth::user()->id);
            $passold=$request->password;
            $validatedData = $request->validate([
                'password' => 'required',
            ]);
            if(Hash::check($passold, $user->password)){
                $validatedData = $request->validate([
                    'password_new' => 'required',
                    'password_confirm' => 'required|same:password_new',
                ]);
                $password_new = $request->password_new;
                $pass_new = bcrypt($password_new);
                $user->update([
                    'password'=>$pass_new,
                ]);
                return response()->json(['message' => 'Đổi mật khẩu thành công!',
                                        'url' => '/admin'
                                        ], 
                                        201);
            }else{
                return response()->json(['message' => 'Sai mật khẩu!'], 500);
            }
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
        
    }

    public function changImage(){
        return view('admin.profile.changeimg',[
            "title"=> "Edit IMG",
        ]);
    }

    public function updateImage(Request $req){
        if($req->has('img')){
            // dd($req->all());
            // cập nhật img
            $user = User::find(Auth::user()->id);
            // Lấy đường dẫn ảnh cũ
            $oldImagePath = public_path($user->image); // Tạo đường dẫn đầy đủ tới ảnh cũ

            // Kiểm tra xem ảnh cũ có tồn tại và xóa nó
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); // Xóa ảnh cũ khỏi hệ thống file
            }

            $file = $req->img;
            $ext = $req->img->extension();//đuôi file
            $filename= time().'-'.'admin.'.$ext;
            $file->move(public_path('uploads'),$filename);


            $user->update([
                'image'=>'/uploads/'.$filename,
            ]);
            return response()->json(['message' => 'Cập nhật ảnh thành công', 'url' => '/profile'], 201);
        }else{
            return response()->json(['message' => 'Không có ảnh được tải lên'], 400);
        }

    }
}
