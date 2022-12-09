<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>○○市観光SNSサイト</title>
    </head>
    <body>
         <h1>○○市観光SNS</h1>
        <hr>
        
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
    </body>
</html>