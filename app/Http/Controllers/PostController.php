<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);  
       //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    }
    
    public function create()
{
    return view('posts/create');
}

public function store(Post $post, PostRequest $request)
{
    $input = $request['post'];
    $post->fill($input)->save();
    return redirect('/');
}
}

