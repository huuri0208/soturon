<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
    'title',
    'body',
    'user_id'
];
    
    public function getPaginateByLimit(int $limit_count = 5)
{
    // updated_atで降順に並べたあと、limitで件数制限をかける
    return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
}

 public function getmypage(int $limit_count = 5)
{
    // updated_atで降順に並べたあと、limitで件数制限をかける
    return $this->orderBy('updated_at', 'DESC')->paginate($limit_count);
}
    public function getlike(int $limit_count = 5)
{
    // updated_atで降順に並べたあと、limitで件数制限をかける
    return $this->withCount('likes')->orderBy('likes_count', 'desc')->paginate($limit_count);
}

 public function getreference(int $limit_count = 5)
{
    // updated_atで降順に並べたあと、limitで件数制限をかける
    return $this->withCount('references')->orderBy('references_count', 'desc')->paginate($limit_count);
}

 public function comments()
   {
       return $this->hasMany(Comment::class);
   }
   
   public function tags(){
    return $this->belongsToMany(Tag::class);
}


//いいね
 public function likes()
  {
    return $this->hasMany(Like::class, 'post_id');
  }

 public function is_liked_by_auth_user()
  {
    $id = Auth::id();

    $likers = array();
    foreach($this->likes as $like) {
      array_push($likers, $like->user_id);
    }

    if (in_array($id, $likers)) {
      return true;
    } else {
      return false;
    }
  }
  
  
  //参考
    public function references()
  {
    return $this->hasMany(Reference::class, 'post_id');
  }
  
   public function is_referenced_by_auth_user()
  {
    $id = Auth::id();

    $referencers = array();
    foreach($this->references as $reference) {
      array_push($referencers, $reference->user_id);
    }

    if (in_array($id, $referencers)) {
      return true;
    } else {
      return false;
    }
  }
   public function images()
    {
        return $this->hasMany(Image::class);
    }
  
  
  public function user()
    {
        return $this->belongsTo(User::class);
    }
}