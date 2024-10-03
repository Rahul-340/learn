<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        if (Auth::user()->roll == 'admin') {
            // $users = User::all();
            // $posts = Post::get();
            return view('admin.home');
        } else {
            if (Auth::user()->status == 1) {
                $posts = Post::get();
                return view('home', compact('posts'));
            } else {
                session()->flash('deactivate', 'Your account has been deactivated!');
                Auth::logout();
                return redirect()->route('login');
            }
        }
    }

    public function userlist(){
        $users = User::all();
        return view('admin.user-list', compact('users'));
    }

    public function userPostlist(){
        $posts = Post::get();
        return view('admin.post-list', compact('posts'));
    }

    public function showPosts()
    {
        $posts = Post::with('user')->get();
        return view('posts.index', compact('posts'));
    }
}
