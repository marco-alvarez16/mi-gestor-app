<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'token_hash',
        'expires_at',
    ];

    protected $hidden = [
        'password',
        'token_hash',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}