<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlacklistDomain extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
    ];
}
