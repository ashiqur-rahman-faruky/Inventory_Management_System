<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'DOB', 'phone', 'email', 'address', 'joining_date',
    ];
}
