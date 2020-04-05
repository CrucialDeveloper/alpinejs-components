<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = ['summary', 'description', 'code', 'slug', 'category', 'approved_at'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('summary', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%');
    }
}
