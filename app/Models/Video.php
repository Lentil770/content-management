<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'video_url', 'category_id', 'description', 'series_id', 'course_id', 'reference_video_id', 'class_number', 'tags'];
}
