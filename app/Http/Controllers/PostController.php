<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Tag;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);  
       //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    }
    
    public function create(Tag $tag)
{
    return view('posts/create')->with(['tags' => $tag->get()]);
}




public function store(Request $request, Post $post)
{
    $input_post = $request['post'];
    $input_tags = $request->tags_array;  
    
   
    $post->fill($input_post)->save();
    
 
    $post->tags()->attach($input_tags); 
    return redirect('/');
}
}

