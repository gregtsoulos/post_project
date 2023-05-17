<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'title',
        'post_text',
        'publish_date',
        'approval',
        'hashtags',
        'brand',
        'photo',
    ];
}
