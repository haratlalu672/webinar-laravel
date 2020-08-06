<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class article extends Model
{
    protected $fillable = [
        'title',
        'user_id',
        'slug',
        'content',
        'thumbnail',
        'is_published',
    ];
    protected $casts = [
        'is_published' => 'article',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
