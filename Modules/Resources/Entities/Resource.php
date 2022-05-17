<?php

namespace Modules\Resources\Entities;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'title',
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
