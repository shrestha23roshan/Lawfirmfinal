<?php

namespace Modules\Services\Entities;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'heading',
        'description',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
