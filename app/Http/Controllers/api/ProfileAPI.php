<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileAPI extends Controller
{
    public function updateImage(Request $req){
        // dd($req->img);
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

    public function updateinfo(Request $request)
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
            return response()->json(['message' => 'Update thông ti thành công',
                                    'url' => '/profile'
                                    ], 
                                    201);
        }catch (\Exception $e) {
            return response()->json(['message' => 'Đã có lỗi xảy ra:' . $e->getMessage()], 500);
        }
    }
}
