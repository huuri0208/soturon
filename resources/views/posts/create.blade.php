<!DOCTYPE HTML>
<x-app-layout>
   
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        
    </head>
    <body>
        
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             
              
          <div class="my-6 flex font-semibold text-stone-500 justify-around items-center">
        <p>投稿する</p>
       </div>
       <hr>
        <a  class="px-2 py-1 ml-2  rounded  text-stone-500 text-sm font-bold link-hover cursor-pointer" href="/">←戻る</a>
       
             <div class="bg-white rounded-md mt-5 mb-5 p-3">
        
        <form action="/posts" method="POST"  enctype="multipart/form-data">
            @csrf
            <div>
        <h2 class="my-2 text-xl font-bold">タグ</h2>
        @foreach($tags as $tag)

            <label>
                
                <input type="checkbox" value="{{ $tag->id }}" name="tags_array[]">
                    {{$tag->title}}
                </input>
            </label>
            
        @endforeach         
    </div>
            <div class="title">
                <h2 class="my-2 text-xl font-bold">タイトル</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
             <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2 class="my-2 text-xl font-bold">内容</h2>
                <textarea name="post[body]" placeholder="○○楽しかった！！">{{ old('post.body') }}</textarea>
             <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            
            <div class="my-4">
              <input type="file"  name="image[0]" id="image"/>
               <input type="file"  name="image[1]" id="image" />
               </div>
               
            <input class="px-2 py-1 ml-2  rounded bg-blue-100 text-indigo-500 font-bold link-hover cursor-pointer" type="submit" value="保存"/>
        </form>
        <br>
           
        
        </div>
    </body>
      </x-app-layout>
</html>