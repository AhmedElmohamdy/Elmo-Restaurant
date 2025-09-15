<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offers extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image_name',
        'discount',
        'start_date',
        'end_date',
    ];

    // Additional model methods can be defined here
}
