<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Story extends Model
{

    protected $fillable = ['title', 'content', 'approved'];



    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

}
