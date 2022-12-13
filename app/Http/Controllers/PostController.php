<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Tag;
use App\Models\Like;
use App\Models\Reference;
use Illuminate\Support\Facades\Auth;

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

  public function __construct()
  {
    $this->middleware(['auth', 'verified'])->only(['like', 'unlike','reference', 'unreference']);
   
  }

  

 /**
  * 引数のIDに紐づくリプライにLIKEする
  *
  * @param $id リプライID
  * @return \Illuminate\Http\RedirectResponse
  */
  public function like($id)
  {
    Like::create([
      'post_id' => $id,
      'user_id' => Auth::id(),
    ]);

    session()->flash('success', 'You Liked the Post.');

    return redirect()->back();
  }

  /**
   * 引数のIDに紐づくリプライにUNLIKEする
   *
   * @param $id リプライID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function unlike($id)
  {
    $like = Like::where('post_id', $id)->where('user_id', Auth::id())->first();
    $like->delete();

    session()->flash('success', 'You Unliked the Post.');

    return redirect()->back();
  }
  
  
  
  //参考
 
  

 /**
  * 引数のIDに紐づくリプライにLIKEする
  *
  * @param $id リプライID
  * @return \Illuminate\Http\RedirectResponse
  */
  public function reference($id)
  {
    Reference::create([
      'post_id' => $id,
      'user_id' => Auth::id(),
    ]);

    session()->flash('success', 'You referenced the Post.');

    return redirect()->back();
  }

  /**
   * 引数のIDに紐づくリプライにUNLIKEする
   *
   * @param $id リプライID
   * @return \Illuminate\Http\RedirectResponse
   */
  public function unreference($id)
  {
    $reference = Reference::where('post_id', $id)->where('user_id', Auth::id())->first();
    $reference->delete();

    session()->flash('success', 'You Unreferenced the Reply.');

    return redirect()->back();
  }
}

