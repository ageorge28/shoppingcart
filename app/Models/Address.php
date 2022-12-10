<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'name',
        'email',
        'phone',
        'address1',
        'address2',
        'landmark',
        'district',
        'city',
        'state',
        'country'
    ];
}
