<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::group(['middleware' => ['auth']], function(){
Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/User/mypage', [UserController::class, 'mypage'])->name('mypage');
Route::get('/tags/{tag}',  [TagController::class, 'index']);
Route::post('/search', [PostController::class, 'search']);
Route::get('/posts/create',  [PostController::class, 'create']);
Route::get('/posts/likepage',  [PostController::class, 'likepage']);
Route::get('/posts/referencepage',  [PostController::class, 'referencepage']);
Route::get('/tags/{tag}/likepage',  [TagController::class, 'likepage']);
Route::get('/tags/{tag}/referencepage',  [TagController::class, 'referencepage']);
Route::post('/posts',  [PostController::class, 'store']);
Route::delete('/posts/{post}', [PostController::class,'delete']);
Route::post('/comments',  [CommentController::class, 'store']);
Route::get('/post/like/{id}',  [PostController::class, 'like'])->name('post.like');
Route::get('/post/unlike/{id}',  [PostController::class, 'unlike'])->name('post.unlike');
Route::get('/post/reference/{id}',  [PostController::class, 'reference'])->name('post.reference');
Route::get('/post/unreference/{id}',  [PostController::class, 'unreference'])->name('post.unreference');
Route::get('/User/{user}', [UserController::class,'show']);


});