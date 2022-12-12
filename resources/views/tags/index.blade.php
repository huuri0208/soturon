<!DOCTYPE html>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('○○市観光SNS') }}
        </h2>
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
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <div class='posts'>
          @foreach ($posts as $post)
          <hr>
          <div class='post'>

             <p class="created_at">{{$post->created_at}} </p>
             
             <h2 class='title'>{{ $post->title}}</h2> 
             <h3 class=tag>
                 @foreach($post->tags as $tag)
                {{$tag->title}}
                 @endforeach
                 </h3>
             <p class='body'>{{$post->body}}</p>
             
              <div>
  @if($post->is_liked_by_auth_user())
    <a href="{{ route('post.unlike', ['id' => $post->id]) }}" class="btn btn-success btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
  @else
    <a href="{{ route('post.like', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm">いいね<span class="badge">{{ $post->likes->count() }}</span></a>
  @endif
</div>
          </div>
            
            
          <details>
            <summary>コメント</summary>  
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
        
    </body>
    </x-app-layout>
</html>