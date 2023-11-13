<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $primaryKey = 'location_id';
    protected $fillable = ['location_a', 'location_b', 'location_c', 'location_d'];
    use HasFactory;
}
