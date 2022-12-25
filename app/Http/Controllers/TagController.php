<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;


class TagController extends Controller
{
    
public function index(Tag $tag)
{
    return view('tags.index')->with([
        'posts' => $tag->getByTag(),
        'tag_title'=> $tag->title,
        'tag_body'=>$tag->body,
        'tag_id'=>$tag->id]);
}

public function likepage(Tag $tag)
{
    return view('tags.index')->with([
        'posts' => $tag->getlike(),
        'tag_title'=> $tag->title,
        'tag_body'=>$tag->body,
        'tag_id'=>$tag->id]);
}

public function referencepage(Tag $tag)
{
    return view('tags.index')->with([
        'posts' => $tag->getreference(),
        'tag_title'=> $tag->title,
        'tag_body'=>$tag->body,
        'tag_id'=>$tag->id]);
}



}
