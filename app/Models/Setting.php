<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'logo',
        'address',
        'phone',
        'email',
        'facebook',
        'twitter',
        'instagram',
        'about_us',
        'opening_days',
        'opening_hours',
    ];
}
