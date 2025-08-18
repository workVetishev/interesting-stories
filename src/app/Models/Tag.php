<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Story;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function stories()
    {
        return $this->belongsToMany(Story::class);
    }

}
