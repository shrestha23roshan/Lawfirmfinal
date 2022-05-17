<?php

namespace Modules\News\Entities;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'author',
        'date',
        'description',
        'attachment',
        'file',
        'meta_title',
        'meta_tags',
        'meta_description',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $hidden = ['created_at', 'updated_at'];
    
}
