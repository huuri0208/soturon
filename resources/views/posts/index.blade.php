<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>○○市観光SNSサイト</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>○○市観光SNS</h1>
        <hr>
        <div class='posts'>
              @foreach ($posts as $post)
            <div class='post'>
                <h2 class='title'>{{ $post->title}}</h2>
                <p class='body'>{{$post->body}}</p>
            </div>
              @endforeach
        </div>
        
         <div class='paginate'>
            {{ $posts->links() }}
        </div>
        
    </body>
</html>