<?php

namespace Modules\About\Entities;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table ="about";
    
    protected $fillable = [
        'heading',
        'description',
        'attachment',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $hidden = ['created_at', 'updated_at'];
}
