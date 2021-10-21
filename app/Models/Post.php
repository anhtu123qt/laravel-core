<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','title','body'];
    protected $table = 'posts';

    public function users()
    {
        return $this->belongsTo(Post::class);
    }   
}