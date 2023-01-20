<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Twat;

use Auth;

class TwatController extends Controller
{
    public function create(Request $request){
        $twat = new Twat;
        $twat->content = $request->content;
        $twat->user_id = $request->user_id;
        $twat->save();
        return redirect()->route('home')->with('success', "New twat posted!");
    }

    public function delete($id){
        $twat = Twat::find($id);

        if(Auth::user()->id == $twat->user->id){
            $twat->delete();
            return redirect()->route('home')->with('success', "Twat deleted!");
        }else{
            return redirect()->route('home');
        }
    }
}
