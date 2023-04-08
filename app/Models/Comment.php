<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'commentContent',
        'commentable_type',
        'commentable_id'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
