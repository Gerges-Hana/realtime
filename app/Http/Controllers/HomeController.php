<?php

namespace App\Http\Controllers;

use App\Events\NewNotification;
use App\Models\comments;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=posts::with(['comments'])->get();
        return view('home',compact('posts'));
    }
    public function saveComment(Request $request)
    {
        // return $request;
        comments::create([
            'post_id'=>$request->post_id,
            'user_id'=>$request->user_id,
            'comments'=>$request->comment,
        ]);
        $data=[
            'post_id'=>$request->post_id,
            'user_id'=>$request->user_id,
            'user_name'=>Auth::user()->name,
            'comments'=>$request->comment,
        ];
        event(new NewNotification($data));
    return redirect()->back()->with(['success'=>'تم اضافه تعليقك بنجاح ']);
    }
}
