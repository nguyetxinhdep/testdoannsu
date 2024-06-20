<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct() {
        $this->middleware('auth:api',['except'=>['login','register']]);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }
        $user = User::create(array_merge(
            $validator->validate(),
            ['password'=>bcrypt($request->password)],
        ));
        return response()->json([
            'message'=>'User successsully register',
            'user'=>$user,
        ],201);
    }
    

    // Hàm đăng nhập
    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $credentials = $request->only('email', 'password');

        try {
            // Tạo token JWT nếu xác thực thành công
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            // Xử lý lỗi nếu có vấn đề trong quá trình tạo token
            return response()->json(['error' => 'Could not create token'], 500);
        }

        // Trả về token JWT
        return response()->json(['token' => $token]);
    }

    // Phương thức đăng xuất
    public function logout(Request $request)
    {
        try {
            // Lấy token từ request
            $token = JWTAuth::parseToken();

            // Vô hiệu hóa token
            $token->invalidate();

            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not log out'], 500);
        }
    }
}
