<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = ['summary', 'description', 'code', 'slug', 'category'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
