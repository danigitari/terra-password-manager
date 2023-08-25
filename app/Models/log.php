<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'last_login',
        'all_logins',
        'last_credential_copied',
        'all_credentials_copied'
    ];

    public function user(){
        return $this->belongsTo( \App\Models\User::class);
    }

    protected $casts = [
        'all_logins' => 'array',
        'all_credentials_copied' => 'array',
    ];
}
