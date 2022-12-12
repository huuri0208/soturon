<!DOCTYPE HTML>

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
    </head>
    <body>
        
         <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <form action="/posts" method="POST">
            @csrf
            <div>
        <h2>タグ</h2>
        @foreach($tags as $tag)

            <label>
                
                <input type="checkbox" value="{{ $tag->id }}" name="tags_array[]">
                    {{$tag->title}}
                </input>
            </label>
            
        @endforeach         
    </div>
            <div class="title">
                <h2>タイトル</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('post.title') }}"/>
             <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="body">
                <h2>内容</h2>
                <textarea name="post[body]" placeholder="○○楽しかった！！">{{ old('post.body') }}</textarea>
             <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <input type="submit" value="保存"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        
    </div>
    </body>
      </x-app-layout>
</html>