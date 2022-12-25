<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Models\Tag;
use App\Models\Like;
use App\Models\Reference;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Cloudinary;


class PostController extends Controller
{
    public function index(Post $post)
    {
      $images = Image::all();
        return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);  
       //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    }
    
    
     public function likepage(Post $post)
    {
    
        return view('posts/index')->with(['posts' => $post->getlike()]);  
       //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    }
    
    
     public function referencepage(Post $post)
    {
    
        return view('posts/index')->with(['posts' => $post->getreference()]);  
       //blade内で使う変数'posts'と設定。'posts'の中身にgetを使い、インスタンス化した$postを代入。
    }
    
    public function create(Tag $tag)
{
    return view('posts/create')->with(['tags' => $tag->get()]);
}


public function delete(Post $post)
{
    $post->delete();
    return redirect('/');
}

public function store(Request $request, Post $post )
{
  
  DB::beginTransaction();
  
  try{
     $user_id = Auth::id();   
    $input_post = $request['post'];
     $input_post += ['user_id' => $request->user()->id];
    $post->fill($input_post)->save();
    $input_tags = $request->tags_array; 
    $post->tags()->attach($input_tags); 
    
    
    $images = $request->file('image');
    
    if($images !=null){
    foreach($images as $image){
       
            $data =[
                'image_path' => Cloudinary::upload($image->getRealPath())->getSecurePath(),
                'post_id' => $post->id
                ];
                
                  $image = Image::insert($data);   
        
    }
    
    }
}catch(Exception $e){
    DB::rollback();
    return back()->withInput();
}
DB::commit();
    
  

   
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
  
  
   public function search(Request $request)
    {
         $search = '%' . addcslashes($request->search, '%_\\') . '%';
        $posts = Post::where('body', 'LIKE', $search)->orderBy('created_at', 'desc')->Paginate(5);

        
        return view('posts/search', compact('posts'));
    }
  
}

