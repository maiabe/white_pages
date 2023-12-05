<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonRole extends Model
{
    use HasFactory;

    protected $table = 'Person_Role';

    protected $fillable = [
        'person_id',
        'role_id'
    ];
    
};