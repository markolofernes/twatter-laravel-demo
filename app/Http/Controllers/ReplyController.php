<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function create(Request $request){
        $reply = new Reply();
        $reply->content = $request->content;
        $reply->user_id = $request->user_id;
        $reply->twat_id = $request->twat_id;

        $reply->save();

        return redirect()->route('home')->with('success', "Reply posted!");
    }
}
