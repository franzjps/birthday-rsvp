<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RsvpSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_names',
        'guest_count',
        'contact_method',
        'contact_value',
    ];
}
