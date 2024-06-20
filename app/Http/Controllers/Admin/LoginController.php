<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    //
    //
    public function index(){
        return view('admin.login',[
            'title' => 'Đăng nhập hệ thống'
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'email' => 'required|email:filter',
            'password' => 'required'
        ]);
        // dd($request);
        if(Auth::attempt([
            'email' => $request->input('email'), 
            'password' =>  $request->input('password')
        ], $request->has('remember'))){
            // dd($request);
            return redirect()-> route('admin');
        }
        Session::flash('error','Tài khoản hoặc mật khẩu không đúng!');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login'); // Redirect to the login page or any other page you prefer
    }

    public function forgotPass(){
        return view('admin.quenmatkhau.forgotpass',[
            'title'=>'Quên mật khẩu',
        ]);
    }

    public function sendMailCofirm(Request $req){
        $req->validate([
            'email' => 'required|exists:users'
        ],[
            'email.required' => 'Vui lòng nhập địa chỉ email hợp lệ',
            'email.exists' => 'Email này không tồn tại trong hệ thống',
        ]);

        $mailkh = $req->input('email');

        $user = User::where('email', $mailkh)->first();
        $token = Str::random(40);
        $user->update(['token' => $token]);
        Mail::send('emails.yeucaudoipass', compact('mailkh','user'), function($email) use($mailkh){
            $email->subject('Yêu cầu đổi mật khẩu');
            $email->to($mailkh);
        });

        // Chuyển hướng đến route 'yeucauthanhcong' với thông báo thành công
        return redirect()->route('login')->with('message', 'Email yêu cầu đổi mật khẩu đã được gửi!');
    }

    public function sendMailCofirmapi(Request $req){
        $req->validate([
            'email' => 'required|exists:users'
        ],[
            'email.required' => 'Vui lòng nhập địa chỉ email hợp lệ',
            'email.exists' => 'Email này không tồn tại trong hệ thống',
        ]);

        $mailkh = $req->input('email');

        $user = User::where('email', $mailkh)->first();
        $token = Str::random(40);
        $user->update(['token' => $token]);
        Mail::send('emails.yeucaudoipass', compact('mailkh','user'), function($email) use($mailkh){
            $email->subject('Yêu cầu đổi mật khẩu');
            $email->to($mailkh);
        });

        // Chuyển hướng đến route 'yeucauthanhcong' với thông báo thành công
        return response()->json([
            'message'=>'gửi mail lấy lại mật khẩu thành công',
            'Email'=>$mailkh,
        ],201);
    }

    public function accept(User $id, $token){
        if ($id->token === $token){
            $title='Reset pass';
            return view('emails.formdoipass',compact('id','title'));
        }else{
            return abort(404);
        }
    }

    public function changPass(Request $req, User $id){
        $req->validate([
            'password' => 'required',
            'confirm-password' => 'required|same:password',
        ]);
        // dd($req->password);
        $pass_new = bcrypt($req->password);
        $id->update([
            'password'=>$pass_new,
            'token' => null,
        ]);
        return redirect()->route('login')->with('message', 'Đặt lại mật khẩu thành công');
    }
}
