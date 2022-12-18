<!DOCTYPE html>
<x-app-layout>
    
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>○○市観光SNSサイト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    @vite('resources/css/app.css')

    </head>
    <body>
     
        <hr>
        <br>
       
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class"mb-2 text-xl font-bold">{{ Auth::user()->name }}</p>
        <a href='/posts/create'>投稿するよ</a>    
        <br>
        <a href='/'>最新順</a> <a href='/posts/likepage'>いいね順</a> <a href='/posts/referencepage'>参考順</a>
          @foreach ($posts as $post)
          <hr>
          <div class='bg-white px-8'>

             <p class="mb-2 text-xs">{{$post->created_at}} </p> <p>{{ $post->user->name }}</p>
             
             <h2 class="mb-2 text-xl font-bold">{{ $post->title}}</h2> 
             <h3 class="mb-2 text-xl">
                 @foreach($post->tags as $tag)
                 <a href="/tags/{{ $tag->id }}">{{$tag->title}}</a>
                 @endforeach
                 </h3>
             <p class="mb-2">{{$post->body}}</p>
             
              @foreach ($post->images as $image)
                 <input type="hidden" name="image[post_id]" value={{$post->id}}>
                 
                 <img src="{{$image->image_path}}">
             
                 
              @endforeach
             <div>
  @if($post->is_liked_by_auth_user())
    <a href="{{ route('post.unlike', ['id' => $post->id]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
  @else
    <a href="{{ route('post.like', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
  @endif
</div>

<div>
  @if($post->is_referenced_by_auth_user())
    <a href="{{ route('post.unreference', ['id' => $post->id]) }}" class="btn btn-success btn-sm">参考になった！<span class="badge">{{ $post->references->count() }}</span></a>
  @else
    <a href="{{ route('post.reference', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">参考になった！<span class="badge">{{ $post->references->count() }}</span></a>
  @endif
</div>


         
            @if($post->user->id == Auth::user()->id )
             <form action="/posts/{{$post->id}}" id="form_{{ $post->id }}" method="post">
                       @csrf
                       @method('DELETE')
                       <button type="submit" onclick="deletePost({{ $post->id }})" >削除</button>
                   </form>
            @endif
           </div>
          <details>
            <summary>コメント<span class="badge">{{ $post->comments->count() }}</span></summary>  
             <form action="/comments" method="POST">
               @csrf
               <div class='comment_create'>
                 <input type="hidden" name="comment[post_id]" value={{$post->id}}>
                 <textarea name="comment[body]" ></textarea> <input type="submit" value="返信"/>
                 
                 
               
                 
               </div>  
             </form>
        
             <div class="comment">
              @foreach ($post->comments as $comment)
                 <input type="hidden" name="comment[post_id]" value={{$post->id}}>
                 <p class="created_at">{{$comment->created_at}} </p>
                 <p class='body'>{{$comment->body}}</p>
             
                 <hr>
              @endforeach
             </div>
         
         </details>
        @endforeach
        </div>
        
         <div class='paginate'>
            {{ $posts->links() }}
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