<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function mypage(User $user)
{
    return view('User.mypage')->with(['own_posts' => $user->getOwnPaginateByLimit()]);
}

public function show(User $user)
{
    
    return view('User.show')->with([
        'posts' => $user->getByUser(),
        'name'=> $user->name]);
}



}
