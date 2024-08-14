<?php

namespace App\Http\Controllers;

use App\Events\GreetingSent;
use App\Events\MessageSend;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function chatShow(){
        $danhsach = Message::all();
        return view('chat.show',[
            'title' => 'Phòng chat',
            'danhsach' => $danhsach
        ]);
    }

    public function store(Request $request)
    {
        // Validate dữ liệu gửi từ form
        // $request->validate([
        //     'adminid' => 'required|exists:users,id',
        //     'message' => 'required|string',
        // ]);

        // Tạo và lưu trữ tin nhắn
        $message = Message::create([
            'adminid' => $request->$request->user()->id,
            'name' => $request->$request->user()->name, // Lấy tên từ bảng User
            'message' => $request->message,
        ]);

        // Trả về phản hồi (JSON) cho request AJAX hoặc chuyển hướng lại trang
        return response()->json($message, 201);
    }

    public function messageReceived(Request $request){
        // dd(123);
        $rules = [
            'message' => 'required',
        ];
        $id = $request->user()->id;
        $name = $request->user()->name;
        $messagesend = $request->message;
        $message = Message::create([
            'adminid' => $id,
            'name' => $name, // Lấy tên từ bảng User
            'message' => $messagesend,
        ]);

        $request->validate($rules);
        broadcast(new MessageSend($request->user(),$request->message));
        $x = $request->user()->id;
        Log::debug("Message sent".$x . ' ' . $request->message);
        return response()->json('Message broadcast');
    }

    public function greetReceived(Request $request, User $receiver){
        // dd($receiver);
        broadcast(new GreetingSent($receiver, "{$request->user()->name} đã chào bạn"));
        broadcast(new GreetingSent($request->user(), "Bạn đã chào {$receiver->name}"));
        // dd(1234);

        return "Lời chào từ {$request->user()->name} đến {$receiver->name}";
    }
}
