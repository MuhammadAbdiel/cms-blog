<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use VanOns\Laraberg\Models\Gutenbergable;

class Template extends Model
{
    use HasFactory, Gutenbergable;

    protected $guarded = ['id'];

    public function authors()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
