<!DOCTYPE html>
<x-app-layout>
    <x-slot name="header">
        
    </x-slot>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>○○市観光SNSサイト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
       
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
         <h2>{{$tag_title}}</h2>
         <h3>{{$tag_body}}</h3>
        <a href='/posts/create'>投稿する</a>
        <br>
        <a href='/tags/{{$tag_id}}'>最新順</a>   <a href='/tags/{{$tag_id}}/likepage'>いいね順</a>　　<a href='/tags/{{$tag_id}}/referencepage'>参考順</a>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <div class='posts'>
          @foreach ($posts as $post)
          <hr>
          <div class='post'>

             <p class="created_at">{{$post->created_at}} </p> <p>{{ $post->user->name }}</p>
             
             <h2 class='title'>{{ $post->title}}</h2> 
             <h3 class=tag>
                 @foreach($post->tags as $tag)
                {{$tag->title}}
                 @endforeach
                 </h3>
             <p class='body'>{{$post->body}}</p>
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
            <summary>コメント<span class="badge">{{ $post->comments->count() }}</summary>  
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