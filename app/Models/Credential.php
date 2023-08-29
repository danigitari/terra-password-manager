<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    use HasFactory;
    protected $fillable = [
        'organization',
        'password',
        'notes',
        'department',
        'username',
        'otherInfo'

    ];

    protected $casts = [
        'department' => 'array',
    ];

}
