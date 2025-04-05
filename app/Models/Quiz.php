<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'id',
        'title',
        'image_url',
        'correct_world_id',
    ];

    public $incrementing = false;
    protected $keyType = 'string';
}