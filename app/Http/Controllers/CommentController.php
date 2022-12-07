<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Comment $comment)
   {
       //
       // フォームに入力されたリプライ情報をデータベースへ登録
       $input = $request['comment'];
       $comment->fill($input)->save();
       return redirect('/');
   }
}
