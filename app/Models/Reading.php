<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
    protected $primaryKey = 'reading_id';
    protected $fillable = ['location_id', 'reading_text', 'translation', 'english_location_full', 'hebrew_location_full', 'org_book_id', 'org_book_page'];
    use HasFactory;
}
