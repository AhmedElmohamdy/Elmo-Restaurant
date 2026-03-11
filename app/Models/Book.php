<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'phoneNumber',
        'email',
        'NumberOfPerson',
        'date',
        'booking_time',
    ];
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
