<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'image',
    ];
    protected $table = 'posts';

    public function users()
    {
        return $this->belongsTo(Post::class);
    }

    const STATUS_ACTIVE = 1; 
    const STATUS_INACTIVE = 0;
}
