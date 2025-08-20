<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\User;

class Story extends Model
{
    public const STATUS_PUBLISHED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_PENDING = 'pending';

    protected $fillable = ['title', 'content', 'status', 'user_id'];



    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
