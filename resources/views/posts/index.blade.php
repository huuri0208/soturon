<!DOCTYPE html>
<x-app-layout>
    
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>○○市観光SNSサイト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
    </head>
    <body>
   
        
 <br>
       
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-center items-center">
            <div class="text-stone-500">{{ Auth::user()->name }}</div>
        <a href='/posts/create' class="px-2 py-1 ml-2  rounded bg-blue-100 text-indigo-500 font-bold link-hover cursor-pointer">投稿する</a>    
          </div>
          
          
           
          <div class="my-4 flex font-semibold text-stone-500 justify-around items-center">
        <a href='/'>最新順</a> <a href='/posts/likepage'>いいね順</a> <a href='/posts/referencepage'>参考順</a>
       </div>
          
          
          @foreach ($posts as $post)
          <hr class="my-4">
          <div class='bg-white rounded-md mt-1 mb-5 p-3'>
              
            <div class=justify-between> 
             <a href="/User/{{ $post->user->id }}">{{ $post->user->name }}</a>
             <a class="mb-2 text-xs">{{$post->created_at}} </a> 
             </div>
              <h3 class="px-2 py-1 ml-2 mb-4 inline-flex items-center border-b-2 border-emerald-400 text-xl ">
                 @foreach($post->tags as $tag)
                 <a href="/tags/{{ $tag->id }}">○{{$tag->title}}</a>
                 @endforeach
                 </h3>
             <h2 class="px-2 py-1 ml-2 text-xl font-bold">{{ $post->title}}</h2> 
            
             <p class="px-2 py-1 ml-2">{{$post->body}}</p>
             
             <div class="mb-4 flex justify-around items-center">
              @foreach ($post->images as $image)
                 <input type="hidden" name="image[post_id]" value={{$post->id}}>
                 
               <a href="{{$image->image_path}}"data-lightbox="abc">  <img  class="w-[500px]" src="{{$image->image_path}}"></a>
             
                 
              @endforeach
              </div>
  <div class=justify-between>          
  @if($post->is_liked_by_auth_user())
  
   
    <a href="{{ route('post.unlike', ['id' => $post->id]) }}" class="px-2 py-1 ml-2  rounded bg-pink-500 text-white font-bold link-hover cursor-pointer">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
    
  @else
  
    <a href="{{ route('post.like', ['id' => $post->id]) }}" class="px-2 py-1 ml-2 rounded bg-pink-200 text-white font-bold link-hover cursor-pointer">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
   
  @endif



  @if($post->is_referenced_by_auth_user())
    <a href="{{ route('post.unreference', ['id' => $post->id]) }}" class="px-2 py-1 ml-2 rounded bg-emerald-500 text-white font-bold link-hover cursor-pointer">参考になった！<span class="badge">{{ $post->references->count() }}</span></a>
  @else
    <a href="{{ route('post.reference', ['id' => $post->id]) }}" class="px-2 py-1 ml-2 rounded bg-emerald-200 text-white font-bold link-hover cursor-pointer">参考になった！<span class="badge">{{ $post->references->count() }}</span></a>
  @endif
</div>


         <br>
            @if($post->user->id == Auth::user()->id )
             <form action="/posts/{{$post->id}}" id="form_{{ $post->id }}" method="post">
                       @csrf
                       @method('DELETE')
                       <button type="submit"  class="px-2 py-1 ml-2 rounded bg-red-500 text-white font-bold  text-xs link-hover cursor-pointer" onclick="deletePost({{ $post->id }})" >削除</button>
                   </form>
            @endif
           </div>
          <details class="px-8">
            <summary class="text-stone-500">コメント<span class="badge">{{ $post->comments->count() }}</span></summary>  
        <div class="bg-white rounded-md mt-1 mb-5 p-3">
             <form action="/comments" method="POST">
               @csrf
               <div class='comment_create'>
                 <input type="hidden" name="comment[post_id]" value={{$post->id}}>
                 <textarea name="comment[body]" ></textarea> <input class="px-2 py-1 ml-2 rounded bg-green-600 text-white font-bold link-hover cursor-pointer" type="submit" value="返信"/>
                 
                 
               
                 
               </div>  
             </form>
             <div>
              @foreach ($post->comments as $comment)
                 <input type="hidden" name="comment[post_id]" value={{$post->id}}>
                 <p class="mt-2 text-xs">{{$comment->created_at}} </p>
                 <p class='my-2 text-sm'>{{$comment->body}}</p>
             
                 <hr class="mt-2 m-auto">
              @endforeach
             </div>
         
         </details>
        @endforeach
        
          <div class='mt-5'>
            {{ $posts->links('vendor.pagination.simple-tailwind') }}
        </div>
        
        </div>
    </div>
        
        
       
        
        
         <script>
       
        function deletePost(id) {
        'use strict'

        if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
            document.getElementById(`form_${id}`).submit();
        }
    }
   </script>
    </body>
    </x-app-layout>
</html>