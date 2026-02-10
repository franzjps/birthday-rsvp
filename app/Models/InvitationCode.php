<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'max_guests',
        'is_used',
    ];

    protected $casts = [
        'is_used' => 'boolean',
    ];
}
