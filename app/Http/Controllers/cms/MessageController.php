<?php

namespace App\Http\Controllers\cms;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    //

    public function index(){
        $messages  = Message::with('user')->where('status' , '=', 'unread')->paginate(1);
        return response()->view('cms.messages.index', ['messages' => $messages]);
    }

    public function markRead($id){
        $message = Message::find($id);
        $message->status = 'read';
        $message->save();
        return response()->json(['message' => 'تم تعين السرالة كمقرؤءة']);
    }
}
